@extends('layouts.admin')

@section('content')
  <x-admin.card title="Detail Pesanan #{{ $order->id_pesanan }}" subtitle="Informasi lengkap pesanan">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Pelanggan</h3>
        <div class="space-y-2 text-gray-600 dark:text-gray-400">
          <p><strong>Nama:</strong> {{ $order->user->name ?? 'Guest' }}</p>
          <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
          <p><strong>Telepon:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
          @if ($order->notes)
            <p><strong>Catatan Pesanan:</strong> <span class="italic">{{ $order->notes }}</span></p>
          @endif
        </div>
      </div>

      <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Pesanan</h3>
        <div class="space-y-3">
          <span
            class="order-status-badge inline-block px-4 py-2 text-sm font-medium rounded-full
                    @if ($order->order_status === 'pending_confirmation') bg-amber-100 text-amber-800
                    @elseif ($order->order_status === 'processing') bg-blue-100 text-blue-800
                    @elseif ($order->order_status === 'ready_for_pickup') bg-indigo-100 text-indigo-800
                    @elseif ($order->order_status === 'completed') bg-emerald-100 text-emerald-800
                    @else bg-rose-100 text-rose-800 @endif">
            {{ str_replace('_', ' ', strtoupper($order->order_status)) }}
          </span>

          @if (!in_array($order->order_status, ['completed', 'cancelled']))
            <select id="order_status_select" data-order-id="{{ $order->id_pesanan }}"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700">
              <option value="pending_confirmation" @selected($order->order_status === 'pending_confirmation')>Pending Confirmation</option>
              <option value="processing" @selected($order->order_status === 'processing')>Processing</option>
              <option value="ready_for_pickup" @selected($order->order_status === 'ready_for_pickup')>Ready for Pickup</option>
              <option value="completed" @selected($order->order_status === 'completed')>Completed</option>
              <option value="cancelled" @selected($order->order_status === 'cancelled')>Cancelled</option>
            </select>
          @endif
        </div>
      </div>

      <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Pembayaran</h3>
        <div class="space-y-3">
          <span
            class="payment-status-badge inline-block px-4 py-2 text-sm font-medium rounded-full
                    @if ($order->payment_status === 'pending') bg-amber-100 text-amber-800
                    @elseif ($order->payment_status === 'paid') bg-emerald-100 text-emerald-800
                    @elseif ($order->payment_status === 'failed') bg-rose-100 text-rose-800
                    @elseif ($order->payment_status === 'refunded') bg-gray-100 text-gray-800
                    @else bg-gray-100 text-gray-800 @endif">
            {{ str_replace('_', ' ', strtoupper($order->payment_status)) }}
          </span>

          @if (!in_array($order->order_status, ['completed', 'cancelled']))
            <select id="payment_status_select" data-order-id="{{ $order->id_pesanan }}"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700">
              <option value="pending" @selected($order->payment_status === 'pending')>Pending</option>
              <option value="paid" @selected($order->payment_status === 'paid')>Paid</option>
              <option value="failed" @selected($order->payment_status === 'failed')>Failed</option>
              <option value="refunded" @selected($order->payment_status === 'refunded')>Refunded</option>
            </select>
          @endif
        </div>
      </div>
    </div>

    <div class="mb-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Item Pesanan</h3>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
          <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
            <tr>
              <th class="px-6 py-3 font-semibold">Menu</th>
              <th class="px-6 py-3 font-semibold">Harga Satuan</th>
              <th class="px-6 py-3 font-semibold">Qty</th>
              <th class="px-6 py-3 font-semibold">Subtotal</th>
              <th class="px-6 py-3 font-semibold">Catatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->items as $item)
              <tr class="bg-white border-b dark:bg-gray-800">
                <td class="px-6 py-4 font-medium">
                  {{ $item->product_name_snapshot }}
                  @if ($item->product)
                    <span class="text-xs text-gray-400 block">(ID: {{ $item->id_produk }})</span>
                  @endif
                </td>
                <td class="px-6 py-4">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">{{ $item->quantity }}</td>
                <td class="px-6 py-4 font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                  @if ($item->notes)
                    <span class="text-sm">{{ $item->notes }}</span>
                  @else
                    <span class="text-sm">-</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-4 text-right">
        <p class="text-xl font-bold text-gray-900 dark:text-white">
          Total: Rp {{ number_format($order->total, 0, ',', '.') }}
        </p>
      </div>
    </div>

    <div class="flex gap-3">
      <a href="{{ route('admin.orders.index') }}"
        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Kembali</a>
      <a href="{{ route('admin.orders.print', $order->id_pesanan) }}" target="_blank"
        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cetak Invoice</a>
      @if (in_array($order->order_status, ['pending_confirmation', 'processing', 'ready_for_pickup']))
        <form method="POST" action="{{ route('admin.orders.destroy', $order->id_pesanan) }}"
          onsubmit="return confirm('Batalkan pesanan ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Batalkan
            Pesanan</button>
        </form>
      @endif
    </div>
  </x-admin.card>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle order status change
    const orderStatusSelect = document.getElementById('order_status_select');
    if (orderStatusSelect) {
      orderStatusSelect.addEventListener('change', function() {
        updateOrderStatus(this.value, this.dataset.orderId);
      });
    }

    // Handle payment status change
    const paymentStatusSelect = document.getElementById('payment_status_select');
    if (paymentStatusSelect) {
      paymentStatusSelect.addEventListener('change', function() {
        updatePaymentStatus(this.value, this.dataset.orderId);
      });
    }

    function updateOrderStatus(status, orderId) {
      const select = document.getElementById('order_status_select');
      const originalValue = select.getAttribute('data-original-value') || select.value;

      // Disable select during update
      select.disabled = true;

      fetch(`{{ url('/admin/orders') }}/${orderId}/status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            order_status: status
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update badge
            updateStatusBadge('order', status);
            select.setAttribute('data-original-value', status);

            // Show success message
            showToast('Status pesanan berhasil diperbarui', 'success');

            // If status is completed or cancelled, hide the selects
            if (['completed', 'cancelled'].includes(status)) {
              hideStatusControls();
            }
          } else {
            // Revert select value
            select.value = originalValue;
            showToast('Gagal memperbarui status pesanan', 'error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          select.value = originalValue;
          showToast('Terjadi kesalahan saat memperbarui status', 'error');
        })
        .finally(() => {
          select.disabled = false;
        });
    }

    function updatePaymentStatus(status, orderId) {
      const select = document.getElementById('payment_status_select');
      const originalValue = select.getAttribute('data-original-value') || select.value;

      // Disable select during update
      select.disabled = true;

      fetch(`{{ url('/admin/orders') }}/${orderId}/payment-status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            payment_status: status
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update badge
            updateStatusBadge('payment', status);
            select.setAttribute('data-original-value', status);

            // Show success message
            showToast('Status pembayaran berhasil diperbarui', 'success');
          } else {
            // Revert select value
            select.value = originalValue;
            showToast('Gagal memperbarui status pembayaran', 'error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          select.value = originalValue;
          showToast('Terjadi kesalahan saat memperbarui status pembayaran', 'error');
        })
        .finally(() => {
          select.disabled = false;
        });
    }

    function updateStatusBadge(type, status) {
      const badgeSelector = type === 'order' ? '.order-status-badge' : '.payment-status-badge';
      const badge = document.querySelector(badgeSelector);

      if (badge) {
        // Update badge text
        badge.textContent = status.replace('_', ' ').toUpperCase();

        // Update badge classes
        const classes = getBadgeClasses(type, status);
        badge.className = `inline-block px-4 py-2 text-sm font-medium rounded-full ${classes}`;
      }
    }

    function getBadgeClasses(type, status) {
      if (type === 'order') {
        const classes = {
          'pending_confirmation': 'bg-amber-100 text-amber-800',
          'processing': 'bg-blue-100 text-blue-800',
          'ready_for_pickup': 'bg-indigo-100 text-indigo-800',
          'completed': 'bg-emerald-100 text-emerald-800',
          'cancelled': 'bg-rose-100 text-rose-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
      } else {
        const classes = {
          'pending': 'bg-amber-100 text-amber-800',
          'paid': 'bg-emerald-100 text-emerald-800',
          'failed': 'bg-rose-100 text-rose-800',
          'refunded': 'bg-gray-100 text-gray-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
      }
    }

    function hideStatusControls() {
      const orderSelect = document.getElementById('order_status_select');
      const paymentSelect = document.getElementById('payment_status_select');

      if (orderSelect) orderSelect.style.display = 'none';
      if (paymentSelect) paymentSelect.style.display = 'none';
    }

    function showToast(message, type) {
      // Create toast element
      const toast = document.createElement('div');
      toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white text-sm font-medium z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
      toast.textContent = message;

      document.body.appendChild(toast);

      // Remove toast after 3 seconds
      setTimeout(() => {
        toast.remove();
      }, 3000);
    }

    // Set initial original values
    if (orderStatusSelect) {
      orderStatusSelect.setAttribute('data-original-value', orderStatusSelect.value);
    }
    if (paymentStatusSelect) {
      paymentStatusSelect.setAttribute('data-original-value', paymentStatusSelect.value);
    }
  });
</script>
