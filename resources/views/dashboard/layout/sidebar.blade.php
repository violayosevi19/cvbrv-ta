
<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">CV.BERKAT REZEKI YOSEV</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('dashboard') ? 'active' : ''}} " href="{{ url('dashboard')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
      @if(auth()->user()->role == "admin")
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Pegawai</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('pegawai-dash') ? 'active' : ''}}" href="{{ url('pegawai-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-id-card-o text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pegawai</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Produk</h6>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('jenisproduk-dash') ? 'active' : ''}} " href="{{ url('jenisproduk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Jenis Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk-dash') ? 'active' : ''}} " href="{{ url('produk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-shopping-basket text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('stock-dash') ? 'active' : ''}} " href="{{ url('stock-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-database text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Stok</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Toko</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('toko-dash') ? 'active' : ''}} " href="{{ url('toko-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Toko</span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('supplier-dash') ? 'active' : ''}} " href="{{ url('supplier-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-building text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Transaksi</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('detailorderan-dash') ? 'active' : ''}} " href="{{ url('detailorderan-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-shopping-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Detail Orderan</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link  {{ Request::is('faktur-dash') ? 'active' : ''}}" href="{{ url('faktur-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Faktur</span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('barangmasuk-dash') ? 'active' : ''}} " href="{{ url('barangmasuk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-money text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Barang Masuk</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Penjualan</h6>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('penjualan-dash') ? 'active' : ''}} " href="{{ url('penjualan-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-database text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Penjualan dan Report</span>
          </a>
        </li>
        @elseif(auth()->user()->role == "fakturis")
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Produk</h6>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('jenisproduk-dash') ? 'active' : ''}} " href="{{ url('jenisproduk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Jenis Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk-dash') ? 'active' : ''}} " href="{{ url('produk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-shopping-basket text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('stock-dash') ? 'active' : ''}} " href="{{ url('stock-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-database text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Stok</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Toko</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('toko-dash') ? 'active' : ''}} " href="{{ url('toko-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Toko</span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('supplier-dash') ? 'active' : ''}} " href="{{ url('supplier-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-building text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Transaksi</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('detailorderan-dash') ? 'active' : ''}} " href="{{ url('detailorderan-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-shopping-cart text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Detail Orderan</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link  {{ Request::is('faktur-dash') ? 'active' : ''}}" href="{{ url('faktur-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Faktur</span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('barangmasuk-dash') ? 'active' : ''}} " href="{{ url('barangmasuk-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-money text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Barang Masuk</span>
          </a>
        </li>
        @elseif(auth()->user()->role == "manajer penjualan")
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Penjualan</h6>
        </li>
        <li class="nav-item">
         <a class="nav-link {{ Request::is('penjualan-dash') ? 'active' : ''}} " href="{{ url('penjualan-dash') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-database text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Penjualan dan Report</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="/assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Success</h6>
            <p class="text-xs font-weight-bold mb-0">Be the best distributor</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">CV BERKAT REZEKI YOSEV</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">PADANG</a>
    </div>
  </aside>