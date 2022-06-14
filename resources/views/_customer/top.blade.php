        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <!--
              <a class="navbar-brand brand-logo" href="index.html">
                <span class="font-20 d-block font-weight-bold">Toko Rahayu</span>
                <span class="font-10 d-block font-weight-bold">Toko bahan kue dan bahan</span>
                <span class="font-10 d-block font-weight-bold">makanan kemasan</span>
              </a>
            -->
            <img src="{{ url('img/blyco2.png') }}" style='height:200px;width:200px; object-fit: contain;'>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <!--<ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                  <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                      <span class="input-group-text" id="search">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" aria-label="search" aria-describedby="search" />
                  </div>
                </li>
              </ul>-->
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <!-- <div class="nav-profile-img">
                      <img src="../assets/images/faces/face1.jpg" alt="image" />
                    </div> -->
                    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                    @else
                    <div class="nav-profile-text">
                      <p class="text-black font-weight-semibold m-0">{{ Auth::user()->name }}</p>
                      <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                    </div>
                    @endguest
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <!-- <a class="dropdown-item" href="#">
                      <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                    <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="mdi mdi-logout mr-2 text-primary"></i> {{ __('Logout') }} </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>