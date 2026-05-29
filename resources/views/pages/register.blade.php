@extends('mainlayout')

@section('maincontent')

<div class="container-fluid">
    <div class="row vh-100">

        <!-- LEFT: FORM -->
        <section class="col-md-6 d-flex align-items-center justify-content-center">

            

                

                <form method="POST" action="/register" class="glass-card w-75">
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
        <section class="col-md-6 p-0">

            <div id="heroCarousel"
                 class="carousel slide h-100"
                 data-bs-ride="carousel"
                 data-bs-interval="3000">

                <div class="carousel-inner h-100">

                    <!-- SLIDE 1 -->
                    <div class="carousel-item active h-100">
                        <img src="{{ asset('images/hail-mary-wallpaper.jpg') }}"
                             class="d-block w-100 h-100 object-fit-cover">

                        <div class="carousel-caption">
                            <h1>Hail Mary Project</h1>
                            <p>Perjalanan epik di planet Arrakis.</p>
                        </div>
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="carousel-item h-100">
                        <img src="{{ asset('images/batman.jpg') }}"
                             class="d-block w-100 h-100 object-fit-cover">

                        <div class="carousel-caption">
                            <h1>THE BATMAN</h1>
                            <p>Gotham dalam bayangan gelap.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
</div>

@endsection