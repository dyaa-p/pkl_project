@extends('layouts.backend')

@section('content')
<div class="container-fluid">
  <div class="row">

    <!-- AKUN -->
    <div class="col">
      <div class="card border-0 zoom-in bg-primary-subtle shadow-none"
           role="button" data-bs-toggle="modal" data-bs-target="#modalAkun">
        <div class="card-body text-center">
          <img src="{{ asset('/assets/backend/images/svgs/icon-user-male.svg') }}" width="50" class="mb-3">
          <p class="fw-semibold fs-3 text-primary mb-1">Akun</p>
          <h5 class="fw-semibold text-primary mb-0">{{ $totalUser }}</h5>
        </div>
      </div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="col">
      <div class="card border-0 zoom-in bg-warning-subtle shadow-none"
           role="button" data-bs-toggle="modal" data-bs-target="#modalPembayaran">
        <div class="card-body text-center">
          <img src="{{ asset('/assets/backend/images/svgs/icon-briefcase.svg') }}" width="50" class="mb-3">
          <p class="fw-semibold fs-3 text-warning mb-1">Pembayaran</p>
          <h5 class="fw-semibold text-warning mb-0">
            Rp. {{ number_format($totalPembayaran,0,'.','.') }}
          </h5>
        </div>
      </div>
    </div>

    <!-- PENGELUARAN -->
    <div class="col">
      <div class="card border-0 zoom-in bg-danger-subtle shadow-none"
           role="button" data-bs-toggle="modal" data-bs-target="#modalPengeluaran">
        <div class="card-body text-center">
          <img src="{{ asset('/assets/backend/images/svgs/danger.svg') }}" width="50" class="mb-3">
          <p class="fw-semibold fs-3 text-danger mb-1">Pengeluaran</p>
          <h5 class="fw-semibold text-danger mb-0">
            Rp. {{ number_format($totalPengeluaran,0,'.','.') }}
          </h5>
        </div>
      </div>
    </div>

    <!-- PEMASUKKAN -->
    <div class="col">
      <div class="card border-0 zoom-in bg-success-subtle shadow-none"
           role="button" data-bs-toggle="modal" data-bs-target="#modalPemasukkan">
        <div class="card-body text-center">
          <img src="{{ asset('/assets/backend/images/svgs/icon-speech-bubble.svg') }}" width="50" class="mb-3">
          <p class="fw-semibold fs-3 text-success mb-1">Pemasukkan</p>
          <h5 class="fw-semibold text-success mb-0">
            Rp. {{ number_format($totalPemasukkan,0,'.','.') }}
          </h5>
        </div>
      </div>
    </div>

    <!-- TOTAL KAS -->
    <div class="col">
      <div class="card border-0 zoom-in bg-info-subtle shadow-none"
           role="button" data-bs-toggle="modal" data-bs-target="#modalKas">
        <div class="card-body text-center">
          <img src="{{ asset('/assets/backend/images/svgs/icon-dd-invoice.svg') }}" width="50" class="mb-3">
          <p class="fw-semibold fs-3 text-info mb-1">Total Uang Kas</p>
          <h5 class="fw-semibold text-info mb-0">
            Rp. {{ number_format($saldoKas,0,'.','.') }}
          </h5>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ================= MODAL ================= -->

<!-- MODAL AKUN -->
<div class="modal fade" id="modalAkun" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="fw-semibold text-primary">Menu Akun</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul>
          <li>Menampilkan data seluruh anggota kelas</li>
          <li>Mengetahui jumlah anggota terdaftar</li>
          <li>Mengelola akun kas kelas</li>
        </ul>
        <div class="alert alert-primary mt-3">
          Total anggota: <b>{{ $totalUser }} orang</b>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PEMBAYARAN -->
<div class="modal fade" id="modalPembayaran" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="fw-semibold text-warning">Menu Pembayaran</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul>
          <li>Melihat riwayat pembayaran kas</li>
          <li>Mengetahui total pembayaran anggota</li>
        </ul>
        <div class="alert alert-warning mt-3">
          Total pembayaran: <b>Rp. {{ number_format($totalPembayaran,0,'.','.') }}</b>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PENGELUARAN -->
<div class="modal fade" id="modalPengeluaran" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="fw-semibold text-danger">Menu Pengeluaran</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul>
          <li>Mencatat penggunaan uang kas</li>
          <li>Mengetahui total pengeluaran</li>
        </ul>
        <div class="alert alert-danger mt-3">
          Total pengeluaran: <b>Rp. {{ number_format($totalPengeluaran,0,'.','.') }}</b>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PEMASUKKAN -->
<div class="modal fade" id="modalPemasukkan" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="fw-semibold text-success">Menu Pemasukkan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul>
          <li>Mencatat uang yang masuk ke kas</li>
          <li>Mengetahui total pemasukkan</li>
        </ul>
        <div class="alert alert-success mt-3">
          Total pemasukkan: <b>Rp. {{ number_format($totalPemasukkan,0,'.','.') }}</b>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL TOTAL KAS -->
<div class="modal fade" id="modalKas" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header border-0">
        <h5 class="fw-semibold text-info">Total Uang Kas</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>
          Menampilkan sisa uang kas setelah pemasukkan dikurangi pengeluaran.
        </p>
        <div class="alert alert-info mt-3">
          Saldo kas saat ini: <b>Rp. {{ number_format($saldoKas,0,'.','.') }}</b>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
