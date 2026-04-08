@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
<style>
    .card-custom {
        border-radius: 20px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 13px;
    }

    .badge-lunas {
        background: #1abc9c;
        color: white;
    }

    .badge-belum {
        background: #e74c3c;
        color: white;
    }

    .jumlah-badge {
        background: #e8f0ff;
        color: #4e73df;
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 500;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">

    <div class="card card-custom">
        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-semibold mb-0">
                        💳 Catatan Kas
                    </h4>
                    <small class="text-muted">
                        Daftar pembayaran kas siswa
                    </small>
                </div>

                <!-- ✅ FIX: arahkan ke pembayaran -->
                <a href="{{ route('backend.pembayaran.create') }}" class="btn btn-primary rounded-pill px-4">
                    + Tambah Pembayaran
                </a>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table align-middle" id="dataKas">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Minggu</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Tanggal Lunas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @foreach($kas as $data)
                        <tr>

                            <td>{{ $no++ }}</td>

                            <td class="fw-semibold">
                                {{ $data->users->name ?? '-' }}
                            </td>

                            <!-- STATUS -->
                            <td>
                                @if($data->status == 'belum')
                                    <span class="badge-status badge-belum">
                                        Belum
                                    </span>
                                @else
                                    <span class="badge-status badge-lunas">
                                        Lunas
                                    </span>
                                @endif
                            </td>

                            <td>{{ $data->minggu_ke }}</td>

                            <td>
                                {{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}
                            </td>

                            <!-- JUMLAH -->
                            <td>
                                <span class="jumlah-badge">
                                    Rp {{ number_format($data->jumlah,0,'.','.') }}
                                </span>
                            </td>

                            <td>
                                {{ $data->tanggal_bayar ? $data->tanggal_bayar->format('d M Y') : '-' }}
                            </td>

                            <!-- AKSI -->
                            <td>

                                <!-- DETAIL -->
                                <a href="{{ route('backend.kas.show',$data->id) }}"
                                   class="btn btn-sm btn-info rounded-circle">
                                   i
                                </a>

                                <!-- ✅ FIX DELETE -->
                                <form action="{{ route('backend.kas.destroy',$data->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-circle"
                                            onclick="return confirm('Yakin hapus?')">
                                        🗑
                                    </button>
                                </form>

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
new DataTable('#dataKas', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'
    }
});
</script>
@endpush