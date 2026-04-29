<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Invoice {{ $order->order_code }}</title>
  <style>
    body {
      font-family: 'DejaVu Sans', sans-serif;
      margin: 30px;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 2px solid #BC430D;
      padding-bottom: 10px;
    }

    .header h1 {
      color: #BC430D;
      margin: 0;
    }

    .header p {
      margin: 5px 0;
      color: #555;
    }

    .info-table {
      width: 100%;
      margin-bottom: 30px;
    }

    .info-table td {
      padding: 5px 0;
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .items-table th,
    .items-table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    .items-table th {
      background-color: #f2f2f2;
    }

    .total {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
      border-top: 1px solid #ddd;
      padding-top: 15px;
    }

    .footer {
      margin-top: 50px;
      text-align: center;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>Vianos Cafe</h1>
    <p>Jl. Contoh No. 123, Kota</p>
    <p>Telp: 0812-3456-7890</p>
  </div>

  <h3>INVOICE PESANAN</h3>
  <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
  <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
  <p><strong>Nomor Antrian:</strong> {{ $order->queue_number ?? '-' }}</p>

  <table class="info-table">
    <tr>
      <td width="20%"><strong>Pelanggan:</strong></td>
      <td>{{ $order->user->name ?? 'Guest' }}</td>
    </tr>
    <tr>
      <td><strong>Email:</strong></td>
      <td>{{ $order->user->email ?? '-' }}</td>
    </tr>
    @if ($order->notes)
      <tr>
        <td><strong>Catatan:</strong></td>
        <td>{{ $order->notes }}</td>
      </tr>
    @endif
  </table>

  <table class="items-table">
    <thead>
      <tr>
        <th>Menu</th>
        <th width="100">Harga</th>
        <th width="50">Qty</th>
        <th width="120">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($order->items as $item)
        <tr>
          <td>{{ $item->product_name_snapshot }}</td>
          <td>Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
          <td>{{ $item->quantity }}</td>
          <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total">
    Total : Rp {{ number_format($order->total, 0, ',', '.') }}
  </div>

  <div class="footer">
    Terima kasih telah berbelanja di Vianos Cafe.<br>
    Harap tunjukkan invoice ini saat mengambil pesanan.
  </div>

</body>

</html>
