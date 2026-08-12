<nav class="navbar navbar-expand-lg custom-navbar fixed-top"
     style="border-bottom:5px solid #01285e;">

    <div class="container-fluid">

        <!-- LEFT: LOGO -->
        <a href="{{ url('/') }}" class="navbar-logo">
            <img src="{{ asset('images/logo frf v2.png') }}" alt="logo">
        </a>

        <!-- RIGHT SECTION WRAPPER -->
        <div class="d-flex align-items-center ms-auto">

            @auth
                <!-- USER LOGIN -->
                <a href="/dashboard"
                   class="nav-link rounded-circle p-2 d-flex align-items-center justify-content-center me-2">
        
                    @if(Auth::user()->foto_profil)
        
                        <img src="{{ asset('images/' . Auth::user()->foto_profil) }}"
                             width="40"
                             height="40"
                             class="rounded-circle object-fit-cover">
        
                    @else
        
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                             style="width:40px; height:40px;">
        
                            <i class="bi bi-person text-white"></i>
        
                        </div>
        
                    @endif
        
                </a>
                <a href="/notifications" class="position-relative">

                    <i class="bi bi-bell"></i>
                
                    @if($jumlahNotif > 0)
                
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                
                            {{ $jumlahNotif }}
                
                        </span>
                
                    @endif
                
                </a>
        
            @endauth
        
        
            @guest
                <!-- USER BELUM LOGIN -->
                <a href="/login" class="btn btn-primary btn-sm me-2">
                    Login
                </a>
        
                <a href="/register" class="btn btn-outline-light btn-sm">
                    Register
                </a>
            @endguest
        
        
            <!-- HAMBURGER -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
        
                <span class="navbar-toggler-icon"></span>
        
            </button>
        
        </div>
        <!-- MENU -->
        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto">
            @auth
                @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link font font-color" href="/admin/films/search">Tambah Film</a>
                    </li>
                @endif
            @endauth
                <li class="nav-item">
                    <a class="nav-link font font-color" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font font-color" href="/listFilm">Daftar Film</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font font-color" href="/feeds">Feeds</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link font font-color" href="/articles">Artikel</a>
                </li>
            @auth
                @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link font font-color" href="/admin/articles/tambah">Tambah Artikel</a>
                    </li>
                @endif
            @endauth

            </ul>

            <!-- SEARCH -->
            <form method="GET" action="{{ url('/listFilm') }}" class="mb-4">

                <div class="input-group">
            
                    <input
                        type="search"
                        name="search"
                        class="form-control rounded-start-pill"
                        placeholder="Cari film..."
                        value="{{ request('search') }}">
            
                    <button class="btn btn-primary rounded-end-pill">
            
                        <i class="bi bi-search"></i>
                        Cari
            
                    </button>
            
                </div>
            
            </form>

        </div>

    </div>

</nav>