@extends('mainlayout')

@section('maincontent')
<div class="container-fluid overflow-hidden login-page">
    <div class="row vh-100">

        <!-- KIRI: CAROUSEL BAWAH KALAU MOBILE-->
        <section class="col-md-6 p-0 vh-100  login-carousel">

            <div id="heroCarousel"
                 class="carousel slide h-100"
                 data-bs-ride="carousel"
                 data-bs-interval="3000">

                <div class="carousel-inner h-100">
                    @foreach ($films as $key => $film)
                    <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                        <img src="https://image.tmdb.org/t/p/original{{ $film->poster }}"
                             class="d-block w-100 h-100 object-fit-cover">
                    </div>
                    @endforeach 
                </div>

            </div>

        </section>

        <!-- KANAN: LOGIN, ATAS KALAU MOBILE-->
        <section class="col-md-6 d-flex align-items-center justify-content-center login-form-wrapper">
            
            <form method="POST" action="/login" class="glass-card-login">
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