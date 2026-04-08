@extends('layouts.frontend')
@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 align-items-center">

            <!-- Text -->
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2 class="fw-bold">Sistem Kas <span style="color:#71c55d;">Kelas</span></h2>
                <p class="text-muted">
                    Halaman profil digunakan untuk melihat informasi akun Anda,
                    termasuk nama, email, serta jumlah uang kas yang sudah Anda setorkan.
                </p>
            </div>

            <!-- Image -->
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('assets/frontend/img/hero-img.png')}}" 
                     class="img-fluid" 
                     style="max-height:300px;"
                     alt="">
            </div>

        </div>
    </div>

    <!-- Profile Card -->
    <div class="icon-boxes position-relative mt-5" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6">

                    <div class="card shadow-lg border-0 rounded-4">

                        <!-- Header -->
                        <div class="card-header text-white rounded-top-4"
                             style="background: linear-gradient(45deg,#71c55d,#4CAF50);">
                            <h5 class="mb-0">👤 Profil Anda</h5>
                        </div>

                        <!-- Body -->
                        <div class="card-body p-4">

                            <!-- Keterangan -->
                            <div class="alert alert-success">
                                <small>
                                    Halaman ini menampilkan data pribadi akun Anda.
                                    Pastikan data yang tertera sudah benar.
                                </small>
                            </div>

                            <div class="row">

                                <!-- Data User -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted">Nama</label>
                                        <h6 class="fw-bold">
                                            {{ Auth::user()->name}}
                                        </h6>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-muted">Email</label>
                                        <h6 class="fw-bold">
                                            {{ Auth::user()->email }}
                                        </h6>
                                    </div>
                                </div>

                                <!-- Saldo -->
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 text-center"
                                         style="background-color:#f5fff2; border:1px solid #71c55d;">

                                        <label class="text-muted">Jumlah Uang Kas Kamu</label>

                                        <h4 class="fw-bold mt-2"
                                            style="color:#4CAF50;">
                                            Rp {{ number_format($jumlahUang,0,'.','.') }}
                                        </h4>

                                    </div>
                                </div>

                            </div>

                            <!-- Button -->
                            <div class="text-end mt-4">
                                <a href="{{ url('/') }}" 
                                   class="btn btn-secondary btn-sm rounded-pill px-4">
                                    ← Kembali
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</section>

@endsection
