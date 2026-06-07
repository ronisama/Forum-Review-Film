@extends('mainlayout')

@section('maincontent')
<div class="container-fluid overflow-hidden">
    <div class="row vh-100">

        <!-- KIRI: CAROUSEL -->
        <section class="col-md-6 p-0">

            <div id="heroCarousel"
                 class="carousel slide h-100"
                 data-bs-ride="carousel"
                 data-bs-interval="3000">

                <div class="carousel-inner h-100">

                    <!-- SLIDE 1 -->
                    <div class="carousel-item active">
                        <img src="{{ asset('images/hail-mary-wallpaper.jpg') }}"
                             class="d-block w-100 h-100 object-fit-cover">

                        <div class="carousel-caption">
                            <h1>Hail Mary Project</h1>
                            <p>Perjalanan epik di planet Arrakis.</p>
                        </div>
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="carousel-item">
                        <img src="{{ asset('images/spiderman-brand-new-day.jpg') }}"
                             class="d-block w-100 h-100 object-fit-cover">

                        <div class="carousel-caption">
                            <h1>SPIDERMAN BRAND NEW DAY</h1>
                            <p>Perjalanan peter parker setelah dilupakan seluruh dunia bahwa dia spiderman.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        <!-- KANAN: LOGIN -->
        <section class="col-md-6 d-flex align-items-center justify-content-center">
            
            <form method="POST" action="/login" class="glass-card">
                @csrf
        
                <h2 class="mb-4 text-white">Login</h2>
        
                <input class="form-control mb-3" type="text" name="username" placeholder="Username">
                <input class="form-control mb-3" type="password" name="password" placeholder="Password">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember">

                <label
                    class="form-check-label"
                    for="remember">
                    Remember Me
                </label>
                <button class="btn btn-primary w-100" type="submit">Login</button>
                @if($errors->any()) <p style="color: red">{{ $errors->first() }}</p> @endif
                <a href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
                <div class="mt-3 text-center">
                    <p> Belum punya akun?  <a href="/register" class="text-white">Daftar</a></p>
                </div>
        
            </form>
        
        </section>

    </div>
</div>
@endsection