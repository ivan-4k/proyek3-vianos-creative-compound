@extends('layouts.admin')

@section('content')
  <div class="px-4 pt-6">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Absensi</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pantau kehadiran staff secara real-time.</p>
      </div>
      <div>
        <input type="date" id="filter-date" 
          class="block w-full sm:w-auto rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
      </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="overflow-x-auto">
        <table id="attendances-table" class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
          <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-3">No</th>
              <th scope="col" class="px-4 py-3">Nama Staff</th>
              <th scope="col" class="px-4 py-3">Tanggal</th>
              <th scope="col" class="px-4 py-3">Clock In</th>
              <th scope="col" class="px-4 py-3">Clock Out</th>
              <th scope="col" class="px-4 py-3">Total Jam</th>
              <th scope="col" class="px-4 py-3">Status</th>
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

@endsection

@push('scripts')
<script>
  let table;
  
  $(document).ready(function() {
    table = $('#attendances-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ route('admin.attendances.data') }}",
        data: function(d) {
          d.date = $('#filter-date').val();
        }
      },
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'staff_name', name: 'user.name' },
        { data: 'date', name: 'date' },
        { data: 'clock_in', name: 'clock_in_time' },
        { data: 'clock_out', name: 'clock_out_time' },
        { data: 'work_hours', name: 'work_hours' },
        { data: 'status_badge', name: 'status', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
      language: {
        search: "Cari Absensi:",
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

    $('#filter-date').on('change', function() {
      table.ajax.reload();
    });
  });

  function deleteAttendance(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data absensi ini?')) {
      $.ajax({
        url: `/admin/attendances/${id}`,
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            table.ajax.reload();
            showToast(response.message, 'success');
          }
        }
      });
    }
  }
</script>
@endpush
