<nav class="navbar navbar-expand-lg custom-navbar fixed-top"
     style="border-bottom:5px solid #01285e;">

    <div class="container-fluid">

        <!-- LEFT: LOGO -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="" alt="logo">
        </a>

        <!-- RIGHT SECTION WRAPPER -->
        <div class="d-flex align-items-center ms-auto">

            <!-- ACCOUNT -->
            <a class="nav-link border border-2 border-light rounded-circle p-2 d-flex align-items-center justify-content-center me-2"
               href="/dashboard">

                <img src=""
                     width="40"
                     height="40"
                     class="rounded-circle">

            </a>

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

                <li class="nav-item">
                    <a class="nav-link font font-color" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font font-color" href="/daftarfilm">Daftar Film</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link font font-color" href="/feeds"> Feeds</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link font font-color" href="/artikelfilm">Artikel</a>
                </li>

            </ul>

            <!-- SEARCH -->
            <form class="d-flex me-3">

                <div class="input-group shadow-sm">

                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="Cari film..."
                        value="{{ request('search') }}">

                    <button class="btn btn-dark rounded-end-pill">
                        <i class="bi bi-search"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>

</nav>