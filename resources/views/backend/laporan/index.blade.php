@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<style>
.card-modern{
    border-radius:20px;
    border:none;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
}

.badge-modern{
    padding:6px 14px;
    border-radius:50px;
    font-weight:500;
}

.badge-lunas{
    background:#1abc9c;
    color:white;
}

.badge-belum{
    background:#e74c3c;
    color:white;
}

.jumlah-badge{
    background:#e8f0ff;
    color:#4e73df;
    padding:6px 12px;
    border-radius:10px;
    font-weight:500;
}
</style>
@endsection


@section('content')
<div class="container-fluid">

{{-- ================= FILTER LAPORAN ================= --}}
<div class="card card-modern mb-4">
<div class="card-body">

<h5 class="fw-semibold mb-3">📊 Laporan</h5>

<form method="GET" action="{{ route('backend.export.index') }}" class="row g-3">

<div class="col-md-3">
<label class="form-label">Jenis Laporan</label>
<select name="jenis" class="form-select">
<option value="">-- Pilih Jenis --</option>
<option value="pengeluaran" {{ request('jenis')=='pengeluaran'?'selected':'' }}>Pengeluaran</option>
<option value="pemasukkan" {{ request('jenis')=='pemasukkan'?'selected':'' }}>Pemasukkan</option>
<option value="kas" {{ request('jenis')=='kas'?'selected':'' }}>Kas</option>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Tanggal Awal</label>
<input type="date" name="awal" class="form-control" value="{{ request('awal') }}">
</div>

<div class="col-md-3">
<label class="form-label">Tanggal Akhir</label>
<input type="date" name="akhir" class="form-control" value="{{ request('akhir') }}">
</div>

<div class="col-md-6 d-flex align-items-end gap-2">
<button class="btn btn-primary">
<i class="bi bi-search"></i> Cari
</button>

<a href="{{ route('backend.export.index') }}" class="btn btn-secondary">
Reset
</a>

@if(request('jenis'))
<a href="{{ route('backend.export.index', array_merge(request()->all(), ['export'=>'excel'])) }}"
class="btn btn-success">
<i class="bi bi-file-earmark-excel"></i> Export Excel
</a>
@endif
</div>

</form>
</div>
</div>



{{-- ================= TRANSAKSI ================= --}}
@if($jenis == 'pengeluaran' || $jenis == 'pemasukkan')

<div class="card card-modern mb-4">
<div class="card-body">

<h5 class="fw-semibold mb-3">💰 Saldo Kas</h5>

<div class="alert alert-info">
Saldo Kas : <b>Rp {{ number_format($saldoKas,0,'.','.') }}</b>
</div>

</div>
</div>



<div class="card card-modern">
<div class="card-body">

<h5 class="fw-semibold mb-3">📑 Laporan Transaksi</h5>

<div class="table-responsive">
<table class="table align-middle" id="dataTransaksi">

<thead class="table-dark">
<tr>
<th>#</th>
<th>Jenis</th>
<th>Jumlah</th>
<th>Keterangan</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>
@php $no=1; @endphp

@foreach($transaksi as $data)
<tr>

<td>{{ $no++ }}</td>
<td>{{ ucfirst($data->jenis) }}</td>

<td>
<span class="jumlah-badge">
Rp {{ number_format($data->jumlah,0,'.','.') }}
</span>
</td>

<td>{{ $data->keterangan }}</td>

<td>
{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}
</td>

</tr>
@endforeach

</tbody>
</table>
</div>

</div>
</div>

@endif



{{-- ================= KAS ================= --}}
@if($jenis == 'kas')

{{-- REKAP --}}
<div class="card card-modern mb-4">
<div class="card-body">

<h5 class="fw-semibold mb-3">📊 Rekap Saldo Kas</h5>

<div class="row">

<div class="col-md-6">
<div class="alert alert-success">
Saldo Kas : <b>Rp {{ number_format($saldoKas,0,'.','.') }}</b>
</div>
</div>

<div class="col-md-6">
<div class="alert alert-warning">
Saldo Tunggakan : <b>Rp {{ number_format($saldoNunggak,0,'.','.') }}</b>
</div>
</div>

</div>

</div>
</div>



{{-- DATA KAS --}}
<div class="card card-modern">
<div class="card-body">

<h5 class="fw-semibold mb-3">📑 Data Kas</h5>

<div class="table-responsive">
<table class="table align-middle" id="dataKas">

<thead class="table-dark">
<tr>
<th>#</th>
<th>Nama</th>
<th>Jabatan</th>
<th>Status</th>
<th>Minggu</th>
<th>Bulan</th>
<th>Jumlah</th>
<th>Tanggal Lunas</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@php $no=1; @endphp

@foreach($kas as $data)
<tr>

<td>{{ $no++ }}</td>

<td class="fw-semibold">{{ $data->user->name }}</td>

<td>
{{ $data->user->isAdmin ? 'Bendahara' : 'Siswa' }}
</td>

<td>
@if($data->status=='lunas')
<span class="badge-modern badge-lunas">Lunas</span>
@else
<span class="badge-modern badge-belum">Belum</span>
@endif
</td>

<td>{{ $data->minggu_ke }}</td>

<td>
{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}
</td>

<td>
<span class="jumlah-badge">
Rp {{ number_format($data->jumlah,0,'.','.') }}
</span>
</td>

<td>{{ $data->tanggal_bayar->format('d M Y') }}</td>

<td>
<a href="{{ route('backend.kas.show',$data->id) }}"
class="btn btn-info btn-sm rounded-circle">
<i class="bi bi-eye"></i>
</a>

<a href="{{ route('backend.kas.destroy',$data->id) }}"
class="btn btn-danger btn-sm rounded-circle"
data-confirm-delete="true">
<i class="bi bi-trash"></i>
</a>
</td>

</tr>
@endforeach

</tbody>
</table>
</div>

</div>
</div>

@endif


</div>
@endsection



@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script>
new DataTable('#dataKas',{
language:{ url:'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'}
});

new DataTable('#dataTransaksi',{
language:{ url:'https://cdn.datatables.net/plug-ins/2.0.0/i18n/id.json'}
});
</script>
@endpush
