@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

<style>
.badge-custom {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
}

.badge-pemasukan {
    background-color: #20c997;
    color: white;
}

.badge-pengeluaran {
    background-color: #ff7b54;
    color: white;
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 4px 10px;
    font-size: 13px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
<div class="card border-0 shadow-sm">
    <div class="card-body">

      <a href="{{ route('backend.transaksi.create')}}" 
         class="btn btn-primary btn-sm float-end">
        Tambah
      </a>

      <h4 class="card-title mb-3">Kelola Uang Kas</h4>

      <div class="table-responsive border rounded-4 p-2">
        <table class="table table-hover mb-0" id="dataTransaksi">

          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th width="180">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @php $no = 1; @endphp

            @foreach($transaksi as $data)
            <tr>
              <td>{{ $no++ }}</td>

              {{-- JENIS --}}
              <td>
                @if($data->jenis == 'pengeluaran')
                  <span class="badge badge-custom badge-pengeluaran">
                    Pengeluaran
                  </span>
                @else
                  <span class="badge badge-custom badge-pemasukan">
                    Pemasukan
                  </span>
                @endif
              </td>

              {{-- JUMLAH --}}
              <td>
                @if($data->jenis == 'pengeluaran')
                  <span class="text-danger fw-semibold">
                    - Rp {{ number_format($data->jumlah,0,'.','.') }}
                  </span>
                @else
                  <span class="text-success fw-semibold">
                    + Rp {{ number_format($data->jumlah,0,'.','.') }}
                  </span>
                @endif
              </td>

              <td>{{ Str::limit($data->keterangan, 50) }}</td>

              <td>{{ $data->tanggal->format('d M Y') }}</td>

              {{-- AKSI --}}
              <td>
                <a href="{{ route('backend.transaksi.edit', $data->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <a href="{{ route('backend.transaksi.show', $data->id) }}"
                   class="btn btn-primary btn-sm">Detail</a>

                <a href="{{ route('backend.transaksi.destroy', $data->id) }}"
                   class="btn btn-danger btn-sm"
                   data-confirm-delete="true">Hapus</a>
              </td>

            </tr>
            @endforeach
          </tbody>

        </table>
      </div>

    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script>
new DataTable('#dataTransaksi', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'
    }
});
</script>
@endpush
