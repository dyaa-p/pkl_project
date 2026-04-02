@extends('layouts.backend')

@section('styles')
<style>
.card-custom {
    border-radius: 18px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.08);
}

.form-label {
    font-weight: 500;
}

textarea {
    resize: none;
}

.btn-save {
    border-radius: 10px;
    padding: 8px 20px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">

<div class="card card-custom border-0">
<div class="card-body p-4">

<h4 class="card-title mb-1">Edit Data</h4>
<p class="text-muted mb-4">
Untuk edit data Kelola (Pemasukan / Pengeluaran)
</p>

<form action="{{route('backend.transaksi.update', $transaksi->id)}}" method="post">
@csrf
@method('put')

{{-- JENIS --}}
<div class="mb-4">
<label class="form-label">Pilih Jenis Transaksi</label>

<select name="jenis"
class="form-select @error('jenis') is-invalid @enderror">

<option value="">Pilih</option>

<option value="pemasukkan"
{{ $transaksi->jenis == 'pemasukkan' ? 'selected' : '' }}>
Pemasukkan
</option>

<option value="pengeluaran"
{{ $transaksi->jenis == 'pengeluaran' ? 'selected' : '' }}>
Pengeluaran
</option>

</select>

@error('jenis')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

{{-- JUMLAH & TANGGAL --}}
<div class="row">

<div class="col-md-6 mb-4">
<label class="form-label">Jumlah Uang</label>

<input type="number"
name="jumlah"
value="{{$transaksi->jumlah}}"
class="form-control @error('jumlah') is-invalid @enderror"
placeholder="Masukkan jumlah uang">

@error('jumlah')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="col-md-6 mb-4">
<label class="form-label">Tanggal</label>

<input type="date"
name="tanggal"
value="{{$transaksi->tanggal}}"
class="form-control @error('tanggal') is-invalid @enderror">

@error('tanggal')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

</div>

{{-- KETERANGAN --}}
<div class="mb-4">
<label class="form-label">Keterangan</label>

<textarea name="keterangan"
rows="5"
class="form-control @error('keterangan') is-invalid @enderror"
placeholder="Masukkan keterangan transaksi">{{$transaksi->keterangan}}</textarea>

@error('keterangan')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

{{-- BUTTON --}}
<div class="text-end">
<button type="submit" class="btn btn-primary btn-save">
<i class="ti ti-send me-1"></i>
Simpan
</button>
</div>

</form>

</div>
</div>

</div>
@endsection
