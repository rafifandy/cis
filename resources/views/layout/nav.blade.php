        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
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
                      <a class="nav-link" href="/pengadaan">Data Penjualan</a>
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
              </li>
              <li class="nav-item">
                <a href="https://www.bootstrapdash.com/demo/plus-free/documentation/documentation.html" class="nav-link" target="_blank">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Docs</span></a>
              </li>
              <li class="nav-item">
              </li>
            </ul>
          </div>
        </nav>