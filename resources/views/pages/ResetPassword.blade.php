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
                    <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                        <img src="https://image.tmdb.org/t/p/original{{ $film->poster }}">

                        <div class="carousel-caption">
                            <h1>Hail Mary Project</h1>
                            <p>Perjalanan epik di planet Arrakis.</p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <!-- KANAN: LOGIN -->
        <section class="col-md-6 d-flex align-items-center justify-content-center">
            
            <form method="POST" action="{{ route('password.update') }}"  class="glass-card-login">
                @csrf
                <h2 class="mb-4 text-white text-center">Masukkan Password Baru</h2>
                <input 
                    type="hidden"
                    name="token"
                    value="{{ $token }}">
            
                <input
                    class="form-control mb-3"
                    type="password"
                    name="password"
                    placeholder="Password Baru">
            
                <input
                    class="form-control mb-3"
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi Password">
                
                <button class="btn btn-primary w-100" type="submit">Simpan Password</button>
            </form>
        
        </section>

    </div>
</div>
@endsection
