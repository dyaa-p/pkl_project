@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

<style>

/* ===== Background halaman ===== */
body {
    background: linear-gradient(135deg, #eef2ff, #e0e7ff);
}

/* ===== Card Modern Glass ===== */
.card {
    border-radius: 20px;
    border: none;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-3px);
}

/* ===== Header tabel ===== */
.table thead {
    background: linear-gradient(90deg,#4f46e5,#6366f1);
    color: white;
}

/* ===== Hover Row ===== */
.table tbody tr {
    transition: 0.2s;
}

.table tbody tr:hover {
    background: #eef2ff;
}

/* ===== Tombol Tambah ===== */
.btn-tambah {
    background: linear-gradient(90deg,#4f46e5,#6366f1);
    color: white;
    border-radius: 12px;
    padding: 7px 16px;
    font-size: 14px;
    border: none;
}

.btn-tambah:hover {
    opacity: 0.9;
    color: white;
}

/* ===== Tombol Aksi ===== */
.btn-edit {
    background: #f59e0b;
    border: none;
    border-radius: 8px;
    color: white;
}

.btn-hapus {
    background: #ef4444;
    border: none;
    border-radius: 8px;
    color: white;
}

.btn-edit:hover {
    background: #d97706;
}

.btn-hapus:hover {
    background: #dc2626;
}

/* Badge jumlah */
.badge-jumlah {
    background: #dbeafe;
    color: #1e40af;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 13px;
}

</style>
@endsection


@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body p-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">
                        💳 Data Pembayaran Kas
                    </h4>
                    <small class="text-muted">
                        Daftar transaksi pembayaran kas siswa
                    </small>
                </div>

                <a href="{{ route('backend.pembayaran.create')}}" class="btn btn-tambah">
                    + Tambah Data
                </a>
            </div>

            {{-- Table --}}
            <div class="table-responsive border rounded-4 overflow-hidden">
                <table id="dataBayar" class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th width="170" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @foreach($pembayaran as $data)
                        <tr>
                            <td>{{ $no++ }}</td>

                            <td class="fw-semibold">
                                {{ $data->users->name }}
                            </td>

                            <td>
                                <span class="badge-jumlah">
                                    Rp {{ number_format($data->jumlah, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                {{ $data->tanggal->format('d M Y') }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('backend.pembayaran.edit', $data->id) }}"
                                       class="btn btn-edit btn-sm">
                                       ✏
                                    </a>

                                    <a href="{{ route('backend.pembayaran.destroy', $data->id) }}"
                                       class="btn btn-hapus btn-sm"
                                       data-confirm-delete="true">
                                       🗑
                                    </a>

                                </div>
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
new DataTable('#dataBayar', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'
    }
});
</script>
@endpush
