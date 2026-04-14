@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pembayaran</h4>
            <p class="card-subtitle mb-3">
                Untuk mengedit data pembayaran kas
            </p>

            <form action="{{ route('backend.pembayaran.update', $pembayaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    
                    <!-- PILIH SISWA -->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Pilih Nama Siswa</label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">Pilih</option>
                                @foreach($users as $data)
                                    <option value="{{ $data->id }}" 
                                        {{ $data->id == $pembayaran->user_id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('user_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Tanggal</label>
                            <input 
                                type="date" 
                                name="tanggal" 
                                value="{{ $pembayaran->tanggal ? date('Y-m-d', strtotime($pembayaran->tanggal)) : '' }}"
                                class="form-control @error('tanggal') is-invalid @enderror"
                            >

                            @error('tanggal')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- JUMLAH -->
                <div class="form-group mb-4">
                    <label>Jumlah</label>
                    <input 
                        type="number" 
                        name="jumlah" 
                        value="{{ $pembayaran->jumlah }}"
                        class="form-control @error('jumlah') is-invalid @enderror"
                    >

                    @error('jumlah')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- KETERANGAN -->
                <div class="form-group mb-4">
                    <label>Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        class="form-control @error('keterangan') is-invalid @enderror"
                    >{{ $pembayaran->keterangan }}</textarea>

                    @error('keterangan')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('backend.pembayaran.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>
@endsection