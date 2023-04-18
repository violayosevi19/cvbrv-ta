 <header>
  <nav class="navbar navbar-expand-lg fixed-top navbar-scroll shadow-0 bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand text-white" style="font-size: 25px;" href="#">C V. B R V</a>
      <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
      aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="d-flex justify-content-start align-items-center">
        <i class="fas fa-bars"></i>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarExample01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link px-3" href="/home">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link px-3" href="/pegawai-home">Pegawai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="/toko-home">Toko</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="/supplier-home">Supplier</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link px-3" href="/produk-home">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="/jenisproduk-home">Jenis Produk</a>
        </li>
        <li class="nav-item">
         <div class="btn-group">
          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Penjualan
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/faktur-home">Faktur</a></li>
            <li><a class="dropdown-item" href="/penjualan-home">Penjualan</a></li>
            <li><a class="dropdown-item" href="/pembayaran-home">Pembayaran</a></li>
            <li><a class="dropdown-item" href="/detailpesanan-home">Detail Pesanan</a></li>
          </ul>
        </div>
      </li>
    </ul>
    @auth
    <ul class="navbar-nav d-flex row">
      <li class="nav-item">
        <a class="nav-link ps-3" href="/logout">Logout</a>
      </li>
    </ul>
    @else
    <ul class="navbar-nav d-flex row">
      <form>
       <li class="nav-item">
         <a class="nav-link ps-3" href="/login">Login</a>
       </li>
     </form>
   </ul>
   @endauth
 </div>
</div>
</nav>
</header>