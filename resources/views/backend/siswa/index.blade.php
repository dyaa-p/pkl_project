@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .table thead {
        border-radius: 12px;
        overflow: hidden;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.2s;
    }

    .btn-custom {
        border-radius: 10px;
        padding: 4px 12px;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 12px;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">

<div class="card card-custom">
    <div class="card-body">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0">📊 Data Akun</h4>
                <small class="text-muted">Daftar akun siswa dan bendahara</small>
            </div>

            <a href="{{ route('backend.siswa.create')}}" class="btn btn-primary btn-custom">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-middle" id="dataSiswa">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Status Bayar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @php $no = 1; @endphp

                @foreach($users as $data)
                <tr>
                    <td>{{ $no++ }}</td>

                    <td class="fw-semibold">{{ $data->name }}</td>

                    <td>
                        @if ($data->isAdmin == 1)
                            <span class="badge bg-success">Bendahara</span>
                        @else
                            <span class="badge bg-secondary">Siswa</span>
                        @endif
                    </td>

                    <td>{{ $data->email }}</td>

                    <td>
                        @php
                            $status = $data->status_semester;
                        @endphp

                        @if($status == 'Lunas')
                            <span class="badge bg-success badge-status">Lunas</span>
                        @elseif($status == 'Jarang')
                            <span class="badge bg-warning text-dark badge-status">Jarang</span>
                        @elseif($status == 'Tidak Pernah')
                            <span class="badge bg-danger badge-status">Tidak Pernah</span>
                        @else
                            <span class="badge bg-secondary badge-status">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('backend.siswa.edit', $data->id) }}"
                           class="btn btn-warning btn-sm btn-custom">
                           <i class="fas fa-pen"></i>
                        </a>

                        @if($data->isAdmin != 1)
                        <a href="{{ route('backend.siswa.destroy', $data->id) }}"
                           class="btn btn-danger btn-sm btn-custom"
                           data-confirm-delete="true">
                           <i class="fas fa-trash"></i>
                        </a>
                        @endif
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
new DataTable('#dataSiswa', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'
    }
});
</script>
@endpush
