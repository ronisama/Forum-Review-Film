@extends('mainlayout')

@section('maincontent')

<div class="container-fluid">
    <div class="row vh-100">

        <!-- LEFT: FORM -->
        <section class="col-md-6 d-flex align-items-center justify-content-center">
                <form method="POST" action="/register" class="glass-card-login w-75">
                    <h2 class="mb-4 text-white">Register</h2>
                    @csrf

                    <div class="mb-3">
                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Username">
                    </div>

                    <div class="mb-3">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Email">
                    </div>

                    <div class="mb-3">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Register
                    </button>
                    <p class="mt-3 text-white">
                        Sudah punya akun?
                        <a href="/login">Login</a>
                    </p>
    
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                
            

        </section>

        <!-- RIGHT: IMAGE / CAROUSEL -->
        <section class="col-md-6 p-0 h-100">

            <div id="heroCarousel"
                 class="carousel slide h-100"
                 data-bs-ride="carousel"
                 data-bs-interval="3000">

                <div class="carousel-inner h-100">
                    @foreach ($films as $key => $film)
                    <!-- carousel-->
                        <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                            <img src="https://image.tmdb.org/t/p/original{{ $film->poster }}"
                                class="d-block w-100 h-100 object-fit-cover">

                            <div class="carousel-caption">
                                <h1>Hail Mary Project</h1>
                                <p>Perjalanan epik di planet Arrakis.</p>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section>

    </div>
</div>

@endsection