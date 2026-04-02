<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon -->
  <link href="{{ asset ('assets/frontend/img/kdmAdmin.png')}}" rel="icon">

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('/assets/backend/css/styles.css')}}" />

  <title>Sistem Kas Kelas</title>

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="{{ asset('/assets/backend/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}" />

  @yield('styles')

  <!-- ⭐ STYLE BARU -->
  <style>

    /* ===== Background Gradient ===== */
    body {
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
    }

    .page-wrapper,
    .body-wrapper {
        background: transparent !important;
    }

    /* ===== Card ===== */
    .card {
        border-radius: 18px;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        padding: 10px;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    /* ===== Table Header ===== */
    .table thead {
        background: #4f46e5;
        color: white;
    }

    .table thead th {
        border: none;
    }

    /* ===== Table Hover ===== */
    .table tbody tr {
        transition: 0.2s;
    }

    .table tbody tr:hover {
        background: #f1f5ff;
    }

    /* ===== Badge ===== */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    /* ===== Button ===== */
    .btn-primary {
        background: #4f46e5;
        border: none;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    /* ===== Pagination ===== */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 3px;
        border: none;
    }

  </style>

</head>

<body>

  <!-- Preloader -->
  <div class="preloader">
    <img src="{{ asset ('assets/frontend/img/kdmAdmin.png')}}" alt="loader" class="lds-ripple img-fluid" />
  </div>

  <div id="main-wrapper">

    <!-- Sidebar -->
    @include('layouts.components-backend.sidebar')

    <div class="page-wrapper">

      <!-- Header -->
      @include('layouts.components-backend.header')

      <!-- Content -->
      <div class="body-wrapper">
        @yield('content')
      </div>

    </div>
  </div>

  <div class="dark-transparent sidebartoggler"></div>

  <!-- Scripts -->
  <script src="{{ asset('/assets/backend/js/vendor.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/js/theme/app.init.js')}}"></script>
  <script src="{{ asset('/assets/backend/js/theme/theme.js')}}"></script>
  <script src="{{ asset('/assets/backend/js/theme/app.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/js/theme/sidebarmenu.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="{{ asset('/assets/backend/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{ asset('/assets/backend/js/dashboards/dashboard.js')}}"></script>

  @include('sweetalert::alert')
  @yield('js')
  @stack('scripts')

</body>
</html>
