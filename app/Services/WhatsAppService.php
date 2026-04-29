<?php

namespace App\Services;

use App\Models\WhatsappLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
  protected $apiUrl;
  protected $apiKey;
  protected $senderNumber;

  public function __construct()
  {
    $this->apiUrl = config('services.whatsapp.api_url', env('WHATSAPP_API_URL'));
    $this->apiKey = config('services.whatsapp.api_key', env('WHATSAPP_API_KEY'));
    $this->senderNumber = config('services.whatsapp.sender_number', env('WHATSAPP_SENDER_NUMBER'));
  }

  /**
   * Kirim pesan WhatsApp
   */
  public function send(string $recipientNumber, string $message, ?int $orderId = null, ?int $userId = null): array
  {
    try {
      $log = WhatsappLog::create([
        'id_pesanan' => $orderId,
        'id_users' => $userId,
        'destination_number' => $recipientNumber,
        'message' => $message,
        'type' => $orderId ? 'order_notification' : 'system_message',
        'status' => 'pending',
        'sent_at' => null,
      ]);

      if (!$this->apiUrl || !$this->apiKey) {
        Log::warning('WhatsApp API not configured, message saved as pending', [
          'recipient' => $recipientNumber,
          'message' => $message
        ]);

        return [
          'success' => false,
          'message' => 'WhatsApp API not configured',
          'log_id' => $log->id_wa_log,
          'status' => 'pending'
        ];
      }

      // Kirim via HTTP API (contoh menggunakan Fonnte, Wablas)
      $response = Http::withHeaders([
        'Authorization' => $this->apiKey,
        'Content-Type' => 'application/json',
      ])->post($this->apiUrl . '/send-message', [
        'recipient' => $recipientNumber,
        'message' => $message,
        'sender' => $this->senderNumber,
      ]);

      if ($response->successful()) {
        $log->update([
          'status' => 'sent',
          'sent_at' => now(),
          'response' => $response->body(),
        ]);

        return [
          'success' => true,
          'message' => 'Message sent successfully',
          'log_id' => $log->id_wa_log,
          'status' => 'sent'
        ];
      } else {
        $log->update([
          'status' => 'failed',
          'response' => $response->body(),
        ]);

        return [
          'success' => false,
          'message' => 'Failed to send message: ' . $response->body(),
          'log_id' => $log->id_wa_log,
          'status' => 'failed'
        ];
      }
    } catch (\Exception $e) {
      Log::error('WhatsApp send error', [
        'recipient' => $recipientNumber,
        'message' => $message,
        'error' => $e->getMessage()
      ]);

      // Update log jika ada
      if (isset($log)) {
        $log->update([
          'status' => 'failed',
          'response' => $e->getMessage(),
        ]);
      }

      return [
        'success' => false,
        'message' => 'Error sending message: ' . $e->getMessage(),
        'log_id' => $log->id_wa_log ?? null,
        'status' => 'failed'
      ];
    }
  }

  /**
   * Kirim notifikasi pesanan
   */
  public function sendOrderNotification(int $orderId, string $status): array
  {
    $order = \App\Models\Order::with('user')->find($orderId);

    if (!$order || !$order->user) {
      return [
        'success' => false,
        'message' => 'Order or user not found'
      ];
    }

    $messages = [
      'pending' => "Halo {$order->user->name}, pesanan Anda #{$order->id_pesanan} sedang diproses. Terima kasih telah memesan di restoran kami!",
      'processing' => "Halo {$order->user->name}, pesanan Anda #{$order->id_pesanan} sedang disiapkan. Mohon tunggu sebentar ya!",
      'ready' => "Halo {$order->user->name}, pesanan Anda #{$order->id_pesanan} sudah siap diambil. Silakan datang ke restoran kami!",
      'completed' => "Halo {$order->user->name}, pesanan Anda #{$order->id_pesanan} telah selesai. Terima kasih atas kunjungannya!",
      'cancelled' => "Halo {$order->user->name}, maaf pesanan Anda #{$order->id_pesanan} telah dibatalkan. Silakan hubungi kami untuk informasi lebih lanjut.",
    ];

    $message = $messages[$status] ?? "Status pesanan Anda #{$order->id_pesanan} telah diupdate menjadi: " . ucfirst($status);

    return $this->send($order->user->phone ?? '', $message, $orderId, $order->user->id_users);
  }

  /**
   * Kirim pesan broadcast ke semua user
   */
  public function sendBroadcast(string $message, array $userIds = []): array
  {
    $query = \App\Models\User::whereNotNull('phone');

    if (!empty($userIds)) {
      $query->whereIn('id_users', $userIds);
    }

    $users = $query->get();
    $results = [];

    foreach ($users as $user) {
      $result = $this->send($user->phone, $message, null, $user->id_users);
      $results[] = [
        'user' => $user->name,
        'phone' => $user->phone,
        'result' => $result
      ];
    }

    return [
      'success' => true,
      'message' => "Broadcast sent to {$users->count()} users",
      'results' => $results
    ];
  }

  /**
   * Cek status pesan
   */
  public function checkStatus(int $logId): array
  {
    $log = WhatsappLog::find($logId);

    if (!$log) {
      return [
        'success' => false,
        'message' => 'Log not found'
      ];
    }

    // Jika ada API untuk cek status, implementasikan di sini
    // Untuk sementara return status dari database

    return [
      'success' => true,
      'status' => $log->status,
      'sent_at' => $log->sent_at,
      'response' => $log->response
    ];
  }
}
