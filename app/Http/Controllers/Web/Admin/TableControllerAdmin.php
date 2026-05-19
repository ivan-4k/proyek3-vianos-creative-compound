<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeTable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TableControllerAdmin extends Controller
{
    public function index()
    {
        $tables = CafeTable::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function updateCoordinates(Request $request, string $id)
    {
        $table = CafeTable::findOrFail($id);
        $table->update([
            'coord_x' => $request->coord_x,
            'coord_y' => $request->coord_y,
        ]);

        return response()->json(['success' => true, 'message' => 'Posisi meja disimpan']);
    }

    public function data()
    {
        $tables = CafeTable::query();

        return DataTables::of($tables)
            ->addIndexColumn()
            ->addColumn('qr_code_url', function ($row) {
                return $row->qr_code ?: '-';
            })
            ->addColumn('status_badge', function ($row) {
                $badges = [
                    'empty' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Kosong</span>',
                    'occupied' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terisi</span>',
                    'reserved' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Direservasi</span>',
                    'maintenance' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Maintenance</span>',
                ];
                return $badges[$row->status] ?? $row->status;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="flex items-center gap-2">';
                $btn .= '<button onclick="editTable(' . $row->id . ')" class="p-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>';
                $btn .= '<button onclick="deleteTable(' . $row->id . ')" class="p-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors" title="Hapus"><i class="fa-solid fa-trash"></i></button>';
                
                if ($row->qr_code) {
                    $btn .= '<button onclick="printQr(\'' . $row->qr_code . '\')" class="p-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition-colors" title="Print QR"><i class="fa-solid fa-qrcode"></i></button>';
                }
                
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['status_badge', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:20|unique:cafe_tables,number',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|in:indoor,outdoor,vip',
        ]);

        $table = CafeTable::create([
            'number' => $request->number,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'status' => 'empty',
            'qr_code' => CafeTable::generateQrCode($request->number),
        ]);

        return response()->json(['success' => true, 'message' => 'Meja berhasil ditambahkan']);
    }

    public function edit(string $id)
    {
        $table = CafeTable::findOrFail($id);
        return response()->json($table);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'number' => 'required|string|max:20|unique:cafe_tables,number,' . $id,
            'capacity' => 'required|integer|min:1',
            'location' => 'required|in:indoor,outdoor,vip',
            'status' => 'required|in:empty,occupied,reserved,maintenance',
        ]);

        $table = CafeTable::findOrFail($id);
        $table->update([
            'number' => $request->number,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'status' => $request->status,
            'qr_code' => CafeTable::generateQrCode($request->number),
        ]);

        return response()->json(['success' => true, 'message' => 'Meja berhasil diperbarui']);
    }

    public function destroy(string $id)
    {
        $table = CafeTable::findOrFail($id);
        $table->delete();

        return response()->json(['success' => true, 'message' => 'Meja berhasil dihapus']);
    }
}
