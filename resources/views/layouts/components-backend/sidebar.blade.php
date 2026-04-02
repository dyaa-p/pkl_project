<aside class="left-sidebar with-vertical sidebar-modern">
  <div>

    <!-- Logo -->
    <div class="brand-logo d-flex align-items-center justify-content-between px-3 py-3">
      <a href="{{ url('admin')}}" class="text-nowrap logo-img">
        <h2 class="logo-text">SIKA<span>S</span></h2>
      </a>

      <a href="javascript:void(0)" class="sidebartoggler d-block d-xl-none">
        <i class="ti ti-x text-white"></i>
      </a>
    </div>

    <!-- Sidebar Menu -->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">

        <li class="nav-small-cap">Beranda</li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{url('admin')}}">
            <i class="ti ti-aperture"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="nav-small-cap">Menu</li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.siswa.index') }}">
            <i class="ti ti-user-circle"></i>
            <span>Akun</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.transaksi.index') }}">
            <i class="ti ti-currency-dollar"></i>
            <span>Kelola Uang Kas</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.pembayaran.index') }}">
            <i class="ti ti-credit-card"></i>
            <span>Pembayaran</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('backend.kas.index') }}">
            <i class="ti ti-notebook"></i>
            <span>Catatan Kas</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('admin/export') }}">
            <i class="ti ti-file-description"></i>
            <span>Laporan</span>
          </a>
        </li>

      </ul>
    </nav>

    <!-- Profile -->
    <div class="fixed-profile-modern">
      <div class="profile-content">

        <img src="{{ asset('assets/backend/images/profile/admin sikas.jpg') }}"
             class="profile-img">

        <div>
          <h6>{{ Auth::user()->name }}</h6>
          <small>{{ Auth::user()->isAdmin == 1 ? 'Bendahara' : ''}}</small>
        </div>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-btn">
          <i class="ti ti-power"></i>
        </a>

        <form action="{{ route('logout') }}" method="post" id="logout-form">
          @csrf
        </form>

      </div>
    </div>

  </div>
</aside>


<style>

/* ===== SIDEBAR BACKGROUND ===== */
.sidebar-modern {
    background: linear-gradient(180deg,#3b82f6,#1e40af);
    color: white;
    width: 260px;
}

/* ===== LOGO ===== */
.logo-text {
    color: white;
    font-weight: bold;
}

.logo-text span {
    color: #fde047;
}

/* ===== MENU TITLE ===== */
.nav-small-cap {
    color: #dbeafe;
    font-size: 12px;
    padding: 15px 20px 5px;
    text-transform: uppercase;
}

/* ===== MENU ITEM ===== */
.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: #e0f2fe;
    border-radius: 12px;
    margin: 4px 12px;
    transition: 0.3s;
    text-decoration: none;
    font-weight: 500;
}

.sidebar-link i {
    font-size: 18px;
}

/* Hover */
.sidebar-link:hover {
    background: rgba(255,255,255,0.2);
    color: white;
    transform: translateX(4px);
}

/* Active Menu */
.sidebar-link.active {
    background: white;
    color: #1e40af;
    font-weight: 600;
}

/* ===== PROFILE CARD ===== */
.fixed-profile-modern {
    padding: 15px;
}

.profile-content {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid white;
}

.profile-content h6 {
    margin: 0;
    font-size: 14px;
    color: white;
}

.profile-content small {
    color: #e0f2fe;
}

/* Logout Button */
.logout-btn {
    margin-left: auto;
    color: white;
    font-size: 18px;
    transition: 0.3s;
}

.logout-btn:hover {
    transform: scale(1.2);
}


</style>
