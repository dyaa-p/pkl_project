@extends('layouts.backend')

@section('styles')
<style>
.card-custom {
    border-radius: 18px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.08);
}

.detail-label {
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 4px;
}

.detail-value {
    font-size: 15px;
    font-weight: 500;
}

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
</style>
@endsection

@section('content')
<div class="container-fluid">

<div class="card card-custom border-0">
<div class="card-body p-4">

{{-- TITLE --}}
<h4 class="mb-4">
@if($transaksi->jenis == "pemasukkan")
Detail Pemasukan
@else
Detail Pengeluaran
@endif
</h4>

<div class="row">

{{-- KIRI --}}
<div class="col-md-6 mb-3">

<div class="mb-4">
<div class="detail-label">Jenis</div>

@if($transaksi->jenis == "pemasukkan")
<span class="badge badge-custom badge-pemasukan">
Pemasukan
</span>
@else
<span class="badge badge-custom badge-pengeluaran">
Pengeluaran
</span>
@endif
</div>

<div class="mb-4">
<div class="detail-label">Keterangan</div>
<div class="detail-value">
{{ $transaksi->keterangan }}
</div>
</div>

</div>

{{-- KANAN --}}
<div class="col-md-6 mb-3">

<div class="mb-4">
<div class="detail-label">Jumlah</div>
<div class="detail-value">
Rp {{ number_format($transaksi->jumlah,0,'.','.') }}
</div>
</div>

<div class="mb-4">
<div class="detail-label">Tanggal</div>
<div class="detail-value">
{{ $transaksi->tanggal->format('d M Y') }}
</div>
</div>

</div>

</div>

{{-- BUTTON --}}
<div class="text-start mt-3">
<a href="{{ route('backend.transaksi.index') }}"
class="btn btn-info btn-sm">
← Kembali
</a>
</div>

</div>
</div>

</div>
@endsection
