@extends('layouts.admin')

@section('content')
  <div class="px-4 pt-6 pb-12">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Meja</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola meja kafe, kapasitas, denah lokasi, dan QR Code.</p>
      </div>
      <div>
        <button type="button" onclick="openAddModal()"
          class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
          <i class="fa-solid fa-plus"></i>
          Tambah Meja
        </button>
      </div>
    </div>

    <!-- Tabs -->
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
      <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="table-tabs" role="tablist">
        <li class="mr-2" role="presentation">
          <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors" 
            id="map-tab" data-tabs-target="#map-view" type="button" role="tab" aria-controls="map-view" aria-selected="true">
            <i class="fa-solid fa-map-location-dot mr-2"></i>Denah Meja Interaktif
          </button>
        </li>
        <li class="mr-2" role="presentation">
          <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors" 
            id="list-tab" data-tabs-target="#list-view" type="button" role="tab" aria-controls="list-view" aria-selected="false">
            <i class="fa-solid fa-list mr-2"></i>Daftar Meja
          </button>
        </li>
      </ul>
    </div>

    <!-- Tab Content -->
    <div id="tab-content">
      
      <!-- Denah Meja View -->
      <div class="hidden rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" id="map-view" role="tabpanel" aria-labelledby="map-tab">
        <div class="mb-4 flex items-center justify-between">
          <p class="text-sm text-gray-500 dark:text-gray-400">Geser (drag) meja ke posisi yang diinginkan. Posisi akan tersimpan secara otomatis.</p>
          <div class="flex items-center gap-4 text-xs font-medium">
            <div class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-500 block"></span> Kosong</div>
            <div class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500 block"></span> Terisi</div>
            <div class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-yellow-500 block"></span> Direservasi</div>
          </div>
        </div>

        <div class="relative w-full overflow-auto bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg" style="height: 600px; min-width: 800px;">
          <!-- Area Denah (Canvas) -->
          <div id="map-container" class="relative w-full h-full" style="background-image: radial-gradient(#d1d5db 1px, transparent 1px); background-size: 20px 20px;">
            
            <!-- Pintu Masuk / Ornamen Dasar -->
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-32 h-8 border-t-2 border-l-2 border-r-2 border-gray-400 rounded-t-full bg-gray-200 dark:bg-gray-700 opacity-50 flex items-center justify-center text-xs font-bold text-gray-500">PINTU MASUK</div>
            
            <div class="absolute top-0 bottom-0 left-1/3 border-r-2 border-dashed border-gray-300 dark:border-gray-700 opacity-50"></div>

            @foreach($tables as $table)
              @php
                // Tentukan warna berdasarkan status
                $bgColor = match($table->status) {
                    'empty' => 'bg-green-500 text-white border-green-700',
                    'occupied' => 'bg-red-500 text-white border-red-700',
                    'reserved' => 'bg-yellow-500 text-white border-yellow-700',
                    default => 'bg-gray-500 text-white border-gray-700'
                };

                // Tentukan bentuk meja (bulat untuk capacity <= 2, persegi untuk >= 3)
                $shapeClass = ($table->capacity <= 2) ? 'rounded-full w-12 h-12 flex items-center justify-center' : 'rounded-md w-24 h-16 flex flex-col items-center justify-center';
                
                // Koordinat
                $x = $table->coord_x ?? rand(20, 700);
                $y = $table->coord_y ?? rand(20, 500);
              @endphp

              <div class="table-draggable absolute cursor-move border-2 shadow-md select-none {{ $shapeClass }} {{ $bgColor }}"
                   style="left: {{ $x }}px; top: {{ $y }}px;"
                   data-id="{{ $table->id }}"
                   title="{{ $table->number }} (Kap: {{ $table->capacity }})">
                <span class="font-bold text-sm">{{ $table->number }}</span>
                @if($table->capacity > 2)
                  <span class="text-[10px] opacity-80">{{ $table->capacity }} pax</span>
                @endif
              </div>
            @endforeach

          </div>
        </div>
      </div>

      <!-- DataTables View -->
      <div class="hidden rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800" id="list-view" role="tabpanel" aria-labelledby="list-tab">
        <div class="overflow-x-auto">
          <table id="tables-table" class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-4 py-3">No</th>
                <th scope="col" class="px-4 py-3">Nomor Meja</th>
                <th scope="col" class="px-4 py-3">Kapasitas</th>
                <th scope="col" class="px-4 py-3">Lokasi</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3">QR Code</th>
                <th scope="col" class="px-4 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- DataTables -->
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal Tambah/Edit -->
  <div id="table-modal" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 bg-gray-900/50 dark:bg-gray-900/80">
    <div class="relative max-h-full w-full max-w-md p-4">
      <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
        <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600">
          <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">Tambah Meja</h3>
          <button type="button" onclick="closeModal()"
            class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form id="table-form" class="space-y-4">
            <input type="hidden" id="table-id" name="id">
            
            <div>
              <label for="number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nomor Meja</label>
              <input type="text" name="number" id="number"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="T01" required>
            </div>
            
            <div>
              <label for="capacity" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kapasitas</label>
              <input type="number" name="capacity" id="capacity" min="1"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="4" required>
            </div>

            <div>
              <label for="location" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
              <select name="location" id="location"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                <option value="indoor">Indoor</option>
                <option value="outdoor">Outdoor</option>
                <option value="vip">VIP</option>
              </select>
            </div>
            
            <div id="status-group" class="hidden">
              <label for="status" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Status</label>
              <select name="status" id="status"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                <option value="empty">Kosong</option>
                <option value="occupied">Terisi</option>
                <option value="reserved">Direservasi</option>
                <option value="maintenance">Maintenance</option>
              </select>
            </div>

            <button type="submit"
              class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Simpan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  let table;
  
  $(document).ready(function() {
    // ==== TABS LOGIC ====
    const tabs = [
      { id: 'map-tab', target: 'map-view' },
      { id: 'list-tab', target: 'list-view' }
    ];

    function activateTab(tabId) {
      tabs.forEach(t => {
        if(t.id === tabId) {
          $('#' + t.id).removeClass('border-transparent').addClass('text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500');
          $('#' + t.target).removeClass('hidden');
        } else {
          $('#' + t.id).addClass('border-transparent').removeClass('text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500');
          $('#' + t.target).addClass('hidden');
        }
      });
    }

    // Default tab
    activateTab('map-tab');

    $('#map-tab, #list-tab').on('click', function() {
      activateTab($(this).attr('id'));
    });

    // ==== DATATABLES LOGIC ====
    table = $('#tables-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.tables.data') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'number', name: 'number' },
        { data: 'capacity', name: 'capacity' },
        { data: 'location', name: 'location', render: function(data) { return data.toUpperCase(); } },
        { data: 'status_badge', name: 'status', orderable: false, searchable: false },
        { data: 'qr_code_url', name: 'qr_code' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
      language: {
        search: "Cari Meja:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        zeroRecords: "Tidak ada data yang cocok",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Selanjutnya",
          previous: "Sebelumnya"
        }
      }
    });

    $('#table-form').on('submit', function(e) {
      e.preventDefault();
      
      let id = $('#table-id').val();
      let url = id ? `/admin/tables/${id}` : "{{ route('admin.tables.store') }}";
      let method = id ? 'PUT' : 'POST';
      let data = $(this).serialize();

      $.ajax({
        url: url,
        method: method,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            closeModal();
            table.ajax.reload();
            showToast(response.message, 'success');
            setTimeout(() => location.reload(), 1500); // Reload to update map
          }
        },
        error: function(xhr) {
          if (xhr.responseJSON && xhr.responseJSON.errors) {
            let errors = xhr.responseJSON.errors;
            let firstError = Object.values(errors)[0][0];
            showToast(firstError, 'error');
          } else {
            showToast('Terjadi kesalahan', 'error');
          }
        }
      });
    });

    // ==== DRAG AND DROP LOGIC ====
    let isDragging = false;
    let currentDraggable = null;
    let offsetX = 0;
    let offsetY = 0;

    $('.table-draggable').on('mousedown touchstart', function(e) {
      isDragging = true;
      currentDraggable = $(this);
      currentDraggable.css('z-index', 10);
      
      let clientX = e.type.includes('mouse') ? e.clientX : e.originalEvent.touches[0].clientX;
      let clientY = e.type.includes('mouse') ? e.clientY : e.originalEvent.touches[0].clientY;
      
      offsetX = clientX - currentDraggable.offset().left;
      offsetY = clientY - currentDraggable.offset().top;
    });

    $(document).on('mousemove touchmove', function(e) {
      if (!isDragging || !currentDraggable) return;
      e.preventDefault();

      let clientX = e.type.includes('mouse') ? e.clientX : e.originalEvent.touches[0].clientX;
      let clientY = e.type.includes('mouse') ? e.clientY : e.originalEvent.touches[0].clientY;

      let containerOffset = $('#map-container').offset();
      
      let newX = clientX - containerOffset.left - offsetX;
      let newY = clientY - containerOffset.top - offsetY;

      // Boundaries
      let containerWidth = $('#map-container').width();
      let containerHeight = $('#map-container').height();
      let elemWidth = currentDraggable.outerWidth();
      let elemHeight = currentDraggable.outerHeight();

      if(newX < 0) newX = 0;
      if(newY < 0) newY = 0;
      if(newX + elemWidth > containerWidth) newX = containerWidth - elemWidth;
      if(newY + elemHeight > containerHeight) newY = containerHeight - elemHeight;

      currentDraggable.css({
        left: newX + 'px',
        top: newY + 'px'
      });
    });

    $(document).on('mouseup touchend', function() {
      if (isDragging && currentDraggable) {
        currentDraggable.css('z-index', 1);
        
        // Save to DB via AJAX
        let id = currentDraggable.data('id');
        let x = parseInt(currentDraggable.css('left'));
        let y = parseInt(currentDraggable.css('top'));

        $.ajax({
          url: `/admin/tables/${id}/coordinates`,
          method: 'PUT',
          data: { coord_x: x, coord_y: y },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
             showToast('Posisi meja disimpan!', 'success', 1500);
          },
          error: function(xhr) {
             console.error('Gagal menyimpan posisi meja:', xhr.responseText);
             showToast('Gagal menyimpan posisi meja!', 'error');
          }
        });

        isDragging = false;
        currentDraggable = null;
      }
    });
  });

  function openAddModal() {
    $('#modal-title').text('Tambah Meja');
    $('#table-id').val('');
    $('#table-form')[0].reset();
    $('#status-group').addClass('hidden');
    $('#table-modal').removeClass('hidden').addClass('flex');
  }

  function editTable(id) {
    $.get(`/admin/tables/${id}/edit`, function(data) {
      $('#modal-title').text('Edit Meja');
      $('#table-id').val(data.id);
      $('#number').val(data.number);
      $('#capacity').val(data.capacity);
      $('#location').val(data.location);
      $('#status').val(data.status);
      $('#status-group').removeClass('hidden');
      $('#table-modal').removeClass('hidden').addClass('flex');
    });
  }

  function closeModal() {
    $('#table-modal').removeClass('flex').addClass('hidden');
  }

  function deleteTable(id) {
    if (confirm('Apakah Anda yakin ingin menghapus meja ini?')) {
      $.ajax({
        url: `/admin/tables/${id}`,
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            table.ajax.reload();
            showToast(response.message, 'success');
            setTimeout(() => location.reload(), 1500); // Reload to update map
          }
        }
      });
    }
  }

  function printQr(qrCode) {
    let printWindow = window.open('', '', 'height=400,width=600');
    printWindow.document.write('<html><head><title>Print QR</title>');
    printWindow.document.write('</head><body style="display:flex;justify-content:center;align-items:center;height:100vh;text-align:center;">');
    printWindow.document.write('<div><h2>Kode QR Meja</h2><h1>' + qrCode + '</h1><p>Silakan gunakan kode ini untuk scan di aplikasi kasir.</p></div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  }
</script>
@endpush
