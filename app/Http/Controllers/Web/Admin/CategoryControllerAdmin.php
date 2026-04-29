<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryControllerAdmin extends Controller
{
  // Daftar kategori
  public function index(Request $request)
  {
    $query = Category::query();

    if ($search = $request->input('search')) {
      $query->where('name', 'like', "%{$search}%")
        ->orWhere('slug', 'like', "%{$search}%");
    }

    $categories = $query->orderBy('order')
      ->withCount('products')
      ->get();

    return view('admin.categories.index', compact('categories'));
  }

  // Sampah (soft deleted)
  public function trash()
  {
    $categories = Category::onlyTrashed()->orderBy('deleted_at')->get();
    return view('admin.categories.trash', compact('categories'));
  }

  public function create()
  {
    return view('admin.categories.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'        => 'required|string|max:255',
      'description' => 'required|string',
      'image'       => 'required|image|mimes:jpeg,png,jpg|max:1024',
      'is_active'   => 'boolean',
    ]);

    $slug = Str::slug($validated['name']) . '-' . time();
    $validated['slug'] = $slug;
    $validated['is_active'] = $request->has('is_active');

    $path = $request->file('image')->store('categories', 'public');
    $validated['image'] = $path;

    $maxOrder = Category::max('order');
    $validated['order'] = $maxOrder + 1;

    Category::create($validated);

    return redirect()->route('admin.categories.index')
      ->with('success', 'Kategori berhasil ditambahkan.');
  }

  public function edit(Category $category)
  {
    return view('admin.categories.edit', compact('category'));
  }

  public function update(Request $request, Category $category)
  {
    $validated = $request->validate([
      'name'        => 'required|string|max:255',
      'description' => 'required|string',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
      'is_active'   => 'boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');
    $slug = Str::slug($validated['name']) . '-' . time();
    $validated['slug'] = $slug;

    if ($request->hasFile('image')) {
      if ($category->image && Storage::disk('public')->exists($category->image)) {
        Storage::disk('public')->delete($category->image);
      }
      $path = $request->file('image')->store('categories', 'public');
      $validated['image'] = $path;
    }

    $category->update($validated);

    return redirect()->route('admin.categories.index')
      ->with('success', 'Kategori berhasil diperbarui.');
  }

  // Soft delete
  public function destroy(Category $category)
  {
    $category->delete();
    return redirect()->route('admin.categories.index')
      ->with('success', 'Kategori dipindahkan ke sampah.');
  }

  // Restore dari soft delete
  public function restore($id)
  {
    $category = Category::withTrashed()->findOrFail($id);
    $category->restore();
    return redirect()->route('admin.categories.trash')
      ->with('success', 'Kategori berhasil dipulihkan.');
  }

  // Force delete permanen, hanya jika tidak ada produk terkait
  public function forceDelete($id)
  {
    $category = Category::withTrashed()->findOrFail($id);

    $productsCount = $category->products()->count();
    if ($productsCount > 0) {
      return redirect()->route('admin.categories.trash')
        ->with('error', "Kategori '{$category->name}' tidak bisa dihapus permanen karena masih memiliki $productsCount produk. Hapus atau pindahkan produk terlebih dahulu.");
    }

    if ($category->image && Storage::disk('public')->exists($category->image)) {
      Storage::disk('public')->delete($category->image);
    }
    $category->forceDelete();

    return redirect()->route('admin.categories.trash')
      ->with('success', "Kategori '{$category->name}' dihapus permanen.");
  }

  // Bulk soft delete
  public function bulkDelete(Request $request)
  {
    $ids = $request->validate(['ids' => 'required|array'])['ids'];
    Category::whereIn('id_kategori', $ids)->delete();
    return response()->json(['success' => true, 'message' => count($ids) . ' kategori dipindahkan ke sampah.']);
  }

  // Bulk restore
  public function bulkRestore(Request $request)
  {
    $ids = $request->validate(['ids' => 'required|array'])['ids'];
    Category::onlyTrashed()->whereIn('id_kategori', $ids)->restore();
    return response()->json(['success' => true, 'message' => count($ids) . ' kategori dipulihkan.']);
  }

  // Bulk force delete (dengan pengecekan produk juga)
  public function bulkForceDelete(Request $request)
  {
    $ids = $request->validate(['ids' => 'required|array'])['ids'];
    $categories = Category::onlyTrashed()->whereIn('id_kategori', $ids)->get();
    $deleted = 0;
    $skipped = 0;
    $skippedNames = [];

    foreach ($categories as $category) {
      if ($category->products()->count() > 0) {
        $skipped++;
        $skippedNames[] = $category->name;
        continue;
      }
      if ($category->image) Storage::disk('public')->delete($category->image);
      $category->forceDelete();
      $deleted++;
    }

    $message = "$deleted kategori dihapus permanen.";
    if ($skipped) {
      $message .= " $skipped kategori dilewati karena masih memiliki produk: " . implode(', ', $skippedNames);
    }
    return response()->json(['success' => true, 'message' => $message]);
  }

  // AJAX reorder (drag-drop)
  public function reorder(Request $request)
  {
    $orderData = $request->validate([
      'order' => 'required|array',
      'order.*.id' => 'required|exists:categories,id_kategori',
      'order.*.position' => 'required|integer|min:0',
    ])['order'];

    foreach ($orderData as $item) {
      Category::where('id_kategori', $item['id'])->update(['order' => $item['position']]);
    }

    return response()->json(['success' => true]);
  }
}
