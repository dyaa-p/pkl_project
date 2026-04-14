@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"> Riwayat Kas {{ $kas->user->name }} </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Nama : </strong></label>
                                <div>{{$kas->user->name}}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Bulan : </strong></label>
                                <div>{{\Carbon\Carbon::create()->month($kas->bulan)->translatedFormat('F')}} (Minggu ke : {{$kas->minggu_ke}})</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Jumlah : </strong></label>
                                <div>Rp. {{number_format($totalJumlah,'0', '.', '.',)}}</div>
                            </div>
                            <div class="mb-3">
                                <label><strong>Tanggal Pembayaran (Minggu ini): </strong></label>
                                <ul class="mb-0">
                                    @foreach($tanggalList as $tanggal)
                                        <li>{{ $tanggal }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Status : </strong></label>
                                <div>{{ $kas->status }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('backend.kas.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection