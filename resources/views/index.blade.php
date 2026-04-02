@extends('layouts.frontend')

@section('content')

<style>
    /* ===== SALDO CARD ===== */
    .saldo-card {
        transition: 0.3s;
        cursor: pointer;
        background: #ffffff;
    }

    .saldo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .saldo-card:active {
        transform: scale(0.97);
    }

    /* Warna aktif lebih soft */
    .saldo-active {
        background: #eaf7ea;
        color: #2e7d32 !important;
    }

    /* Highlight huruf */
    .kdm {
        color: #66bb6a;
        font-weight: bold;
    }

    /* Header tabel soft */
    .header-soft {
        background: #e8f5e9;
        color: #2e7d32;
    }

    /* Hover tabel */
    .table-hover tbody tr:hover {
        background-color: #f7fcf7;
    }

    /* Badge soft */
    .badge-soft {
        background: #fdeaea;
        color: #c62828;
        font-weight: 500;
    }

</style>

<!-- ================= HERO ================= -->
<section class="hero section light-background">

    <div class="container">
        <div class="row align-items-center">

            <!-- TEXT -->
            <div class="col-lg-6">
                <h2>
                    Sistem Kas <span class="kdm">K</span>elas
                </h2>

                <p class="text-muted">
                    SIKAS membantu pengelolaan keuangan kas kelas agar lebih
                    transparan, tertib, dan mudah dipantau oleh anggota kelas.
                </p>
            </div>

            <!-- IMAGE -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/frontend/img/hero-img.png') }}"
                     class="img-fluid">
            </div>

        </div>
    </div>

    <!-- ================= SALDO ================= -->
    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 text-center p-4 saldo-card"
                     onclick="toggleSaldo(this)">

                    <i class="bi bi-cash-stack fs-2 text-success"></i>

                    <h6 class="mt-3 text-muted">Saldo Kas Saat Ini</h6>

                    <h2 class="fw-semibold">
                        Rp {{ number_format($saldoKas,0,'.','.') }}
                    </h2>

                </div>

            </div>

        </div>
    </div>

</section>

<!-- ================= DATA PENGELUARAN ================= -->
<section class="section">

    <div class="container" style="max-width:900px">

        <div class="card border-0 shadow-sm rounded-4">

            <!-- HEADER -->
            <div class="card-header header-soft">

                <h6 class="mb-0">📊 Data Pengeluaran Kas</h6>

            </div>

            <!-- BODY -->
            <div class="card-body">

                <p class="text-muted small">
                    Daftar transaksi penggunaan uang kas kelas.
                </p>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="text-center small text-muted">
                            <tr>
                                <th>#</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">

                        @php $no = 1; @endphp

                        @foreach($transaksi as $data)

                            <tr>
                                <td>{{ $no++ }}</td>

                                <td>
                                    <span class="badge badge-soft px-3 py-2">
                                        {{ ucfirst($data->jenis) }}
                                    </span>
                                </td>

                                <td class="fw-semibold text-danger">
                                    Rp {{ number_format($data->jumlah,0,'.','.') }}
                                </td>

                                <td class="text-start">
                                    {{ $data->keterangan }}
                                </td>

                                <td class="text-muted">
                                    {{ $data->tanggal->format('d M Y') }}
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= SCRIPT ================= -->
<script>
    function toggleSaldo(element){
        element.classList.toggle("saldo-active");
    }
</script>

@endsection
