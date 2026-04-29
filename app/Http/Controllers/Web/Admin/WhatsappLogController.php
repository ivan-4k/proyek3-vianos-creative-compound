<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappLog;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class WhatsappLogController extends Controller
{
  public function index(Request $request)
  {
    $statuses = ['pending', 'sent', 'failed'];
    $types = WhatsappLog::select('type')->distinct()->pluck('type');

    return view('admin.whatsapp_logs.index', compact('statuses', 'types'));
  }

  // METHOD BARU KHUSUS UNTUK DATA API (SERVER SIDE)
  public function data(Request $request)
  {
    $query = WhatsappLog::with(['order', 'user'])->select('whatsapp_logs.*');

    // Terapkan Filter Dropdown Status & Tipe
    if ($request->has('status') && $request->status != '') {
      $query->where('status', $request->status);
    }
    if ($request->has('type') && $request->type != '') {
      $query->where('type', $request->type);
    }

    return DataTables::eloquent($query)
      ->editColumn('id_pesanan', function ($log) {
        return $log->id_pesanan
          ? '<span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded">#' . $log->id_pesanan . '</span>'
          : '-';
      })
      ->editColumn('destination_number', function ($log) {
        return '<span class="text-gray-900 dark:text-gray-200 font-medium">' . $log->destination_number . '</span>';
      })
      ->editColumn('message', function ($log) {
        return '<span title="' . htmlspecialchars($log->message) . '" class="text-gray-600 dark:text-gray-400 min-w-[200px] inline-block truncate">' .
          Str::limit($log->message, 60) .
          '</span>';
      })
      ->editColumn('type', function ($log) {
        return '<span class="text-gray-600 dark:text-gray-400 capitalize">' . str_replace('_', ' ', $log->type) . '</span>';
      })
      ->editColumn('status', function ($log) {
        $class = match ($log->status) {
          'sent' => 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800',
          'failed' => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800',
          default => 'bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:border-yellow-800'
        };
        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border ' . $class . '">' . ucfirst($log->status) . '</span>';
      })
      ->editColumn('created_at', function ($log) {
        return '<div class="text-xs text-gray-500 dark:text-gray-400">' .
          $log->created_at->format('d/m/Y') . '<br>' .
          $log->created_at->format('H:i:s') .
          '</div>';
      })
      ->addColumn('aksi', function ($log) {
        $url = route('admin.whatsapp-logs.show', $log->id_wa_log);
        return '
          <div class="flex justify-end">
              <a href="' . $url . '" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" title="Detail Log">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
              </a>
          </div>';
      })
      ->rawColumns(['id_pesanan', 'destination_number', 'message', 'type', 'status', 'created_at', 'aksi'])
      ->make(true);
  }

  public function show(WhatsappLog $whatsappLog)
  {
    $whatsappLog->load(['order', 'user']);
    return view('admin.whatsapp_logs.show', compact('whatsappLog'));
  }

  public function retry(WhatsappLog $whatsappLog, Request $request)
  {
    try {
      $whatsappService = new WhatsAppService();
      $result = $whatsappService->send(
        $whatsappLog->destination_number,
        $whatsappLog->message,
        $whatsappLog->id_pesanan,
        $whatsappLog->id_users
      );

      if ($result['success']) {
        return redirect()->back()->with('success', 'Pesan WhatsApp berhasil dikirim ulang.');
      } else {
        return redirect()->back()->with('error', 'Gagal mengirim ulang: ' . $result['message']);
      }
    } catch (\Exception $e) {
      Log::error('WhatsApp retry error: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim ulang pesan.');
    }
  }
}
