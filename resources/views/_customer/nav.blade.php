<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  position: relative;
  overflow: hidden;
  background-color: #824610;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.active {
  background-color: #ddd;
  color: black;
}

.topnav a:hover {
  color: grey;
}

.topnav-centered a {
  float: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.topnav-right {
  float: right;
}

/* Responsive navigation menu (for mobile devices) */
@media screen and (max-width: 600px) {
  .topnav a, .topnav-right {
    float: none;
    display: block;
  }
  
  .topnav-centered a {
    position: relative;
    top: 0;
    left: 0;
    transform: none;
  }
}
</style>        
        <nav class="topnav">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
              @if ($x == 'home')
                <a class="nav-link active" href="{{ url('/') }}">
              @else
                <a class="nav-link" href="{{ url('/') }}">
              @endif
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
              @if ($x == 'barang')
                <a href="{{ url('/cbarang') }}" class="nav-link active">
              @else
                <a href="{{ url('/cbarang') }}" class="nav-link">
              @endif
                  <i class="mdi mdi-cube-outline menu-icon"></i>
                  <span class="menu-title">Barang</span>
                </a>
              </li>
              <li class="nav-item">
              @if ($x == 'pemesanan')
                <a href="{{ url('/cpemesanan') }}" class="nav-link active">
              @else
                <a href="{{ url('/cpemesanan') }}" class="nav-link">
              @endif
                  <i class="mdi mdi-cart menu-icon"></i>
                  <span class="menu-title">Pemesanan</span>
                </a>
              </li>
              <li class="nav-item">
              @if ($x == 'pembelian')
                <a href="{{ url('/cpembelian') }}" class="nav-link active">
              @else
                <a href="{{ url('/cpembelian') }}" class="nav-link">
              @endif
                  <i class="mdi mdi-cart menu-icon"></i>
                  <span class="menu-title">Informasi Pembelian</span>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-cube-outline menu-icon"></i>
                  <span class="menu-title">Barang</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/barang') }}">List Barang</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/barang') }}">Tambah Barang</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-contacts menu-icon"></i>
                  <span class="menu-title">Pelanggan</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/pelanggan') }}">List Pelanggan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/pelanggan') }}">Tambah Pelanggan</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-cart menu-icon"></i>
                  <span class="menu-title">Penjualan</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/penjualan') }}">Data Penjualan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/penjualan/n') }}">Penjualan Baru</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-truck menu-icon"></i>
                  <span class="menu-title">Pengadaan</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="/pengadaan">Data Pengadaan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/pengadaan/tambah">Pengadaan Baru</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-file-document menu-icon"></i>
                  <span class="menu-title">Rekap</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="/rekap">Data Rekap</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/rekap/tambah">Rekap Baru</a>
                    </li>
                  </ul>
                </div>
              </li> -->
              <!-- <li class="nav-item">
                <a href="https://www.bootstrapdash.com/demo/plus-free/documentation/documentation.html" class="nav-link" target="_blank">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Docs</span></a>
              </li>
              <li class="nav-item"> -->
              </li>
            </ul>
          </div>
        </nav>