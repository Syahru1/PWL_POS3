<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Muhammad Syahrul Gunawan</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
              <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 'active' : ''}}">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Level User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user')?'active' : ''}}">
                <i class="nav-icon far fa-user"></i>
                <p>Data User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>Profile</p>
              </a>
          </li>
            <li class="nav-header">Data Barang</li>
            <li class="nav-item">
              <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori')? 'active' : ''}}">
                <i class="nav-icon far fa-bookmark"></i>
                <p>Kategori Barang</p>
              </a>
            </li>
        </li>
        <li class="nav-item">
          <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang')? 'active' : ''}}">
            <i class="nav-icon far fa-list-alt"></i>
            <p>Data Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/suplier') }}" class="nav-link {{ $activeMenu == 'suplier' ? 'active' : '' }}">
              <i class="nav-icon fas fa-truck"></i>
              <p>Data Suplier</p>
          </a>
        </li>
        <li class="nav-header">Data Transaksi</li>
        <li class="nav-item">
          <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok')? 'active' : ''}}">
            <i class="nav-icon fas fa-cubes"></i>
            <p>Stok Barang</p>
          </a>
          </li>
            <li class="nav-item">
              <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'penjualan')? 'active' : ''}}">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Transaksi Penjualan</p>
            </a>
        </li>
      </ul>
    </nav>

    <!-- Logout Button -->
    <br><br>
    <div class="mt-4 mb-3 text-center">
      <a href="javascript:void(0);" class="btn btn-danger btn-block" id="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>    
      <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;"></form>
    </div>

    <!-- Script Konfirmasi Logout -->
  <script>
    document.getElementById('logout-btn').addEventListener('click', function (e) {
        e.preventDefault();
        if (confirm('Yakin ingin logout?')) {
            document.getElementById('logout-form').submit();
        }
    });
  </script>
  </div>
    <!-- /.sidebar-menu -->
  </div>