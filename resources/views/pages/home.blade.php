@extends('mainlayout')

@section('maincontent')
<div id="heroCarousel"
     class="carousel slide"
     data-bs-ride="carousel">

    <div class="carousel-inner">

        <!-- SLIDE 1 -->
        <div class="carousel-item active">

            <img src="{{ asset('images/hail-mary-wallpaper.jpg') }}"
                 class="d-block w-100 hero-image">

            <div class="carousel-caption custom-caption">

                <h1>Hail Mary Project</h1>

                <p>
                    Perjalanan epik di planet Arrakis.
                </p>

                <button class="btn btn-warning">
                    Lihat Detail
                </button>

            </div>

        </div>

        <!-- SLIDE 2 -->
        <div class="carousel-item">

            <img src="{{ asset('images/batman.jpg') }}"
                 class="d-block w-100 hero-image">

            <div class="carousel-caption custom-caption">

                <h1>THE BATMAN</h1>

                <p>
                    Gotham dalam bayangan gelap.
                </p>

            </div>

        </div>

    </div>

    <!-- BUTTON PREV -->
    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>

    </button>

    <!-- BUTTON NEXT -->
    <button class="carousel-control-next"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>

    </button>

</div>
{{-- <div class="container-fluid">
    
<img src={{asset('images/hail-mary-wallpaper.jpg')}} class="img-fluid">
</div> --}}

<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="text-white">Trending Movies</h4>

        <a href="#" class="text-primary">See All →</a>

    </div>

    <div class="movie-scroll">

        <!-- CARD -->
        <div class="movie-card">
            <img src="{{ asset('images/movie1.jpg') }}">
            <h6>Project Hail Mary</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie2.jpg') }}">
            <h6>Mortal Kombat II</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>
        
        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>
        <!-- tambah lagi -->

    </div>

</section>
{{-- <div>
poster list ke kanan atau kebawah 5 atau 6 film untuk film yang sedang tayang
</div> --}}

<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="text-white">Now Playing</h4>

        <a href="#" class="text-primary">See All →</a>

    </div>

    <div class="movie-scroll">

        <!-- CARD -->
        <div class="movie-card">
            <img src="{{ asset('images/movie1.jpg') }}">
            <h6>Project Hail Mary</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie2.jpg') }}">
            <h6>Mortal Kombat II</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>
        
        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>

        <div class="movie-card">
            <img src="{{ asset('images/movie3.jpg') }}">
            <h6>Swapped</h6>
        </div>
        <!-- tambah lagi -->

    </div>

</section>
{{-- 
<div>
    poster list ke kanan atau kebawah 5 atau 6 film untuk film yang sedang trending
</div> --}}
<hr>
<section class="container px-5 my-5">
    <div class="font font-color my-5">
        <h3 class="text-center">
            About Us
        </h3>
        <p class="text-center">
            Forum Review Film hadir sebagai tempat berkumpulnya para pecinta film untuk berdiskusi, membagikan teori, memberikan ulasan, dan mengikuti perkembangan terbaru dunia perfilman. Mulai dari berita terkini, review dari para cinephile, hingga teori menarik antar semesta film, semuanya dapat ditemukan dan didiskusikan bersama di sini.
        </p>
    </div>
</section>
<hr>

<section class="container my-5">
    <h4 class="text-white">
        Artikel
    </h4>
    <!-- berita 1 -->
    <div class="row article-card align-items-center">

        <!-- GAMBAR -->
        <div class="col-md-4">
            <img src="{{ asset('images/hail-mary-wallpaper.jpg') }}"
                 class="img-fluid rounded">
        </div>

        <!-- TEXT -->
        <div class="col-md-8 font-color">

            <h3>Project Hail Mary</h3>

            <p>
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s.
            </p>

            <a href="#" class="btn btn-primary">
                Baca Selengkapnya
            </a>

        </div>

    </div>
    <!-- berita 2 -->
    <div class="row article-card align-items-center">

        <!-- GAMBAR -->
        <div class="col-md-4">
            <img src="{{ asset('images/hail-mary-wallpaper.jpg') }}"
                 class="img-fluid rounded">
        </div>

        <!-- TEXT -->
        <div class="col-md-8 font-color">

            <h3>Project Hail Mary</h3>

            <p>
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s.
            </p>

            <a href="#" class="btn btn-primary">
                Baca Selengkapnya
            </a>

        </div>

    </div>

</section>


@endsection