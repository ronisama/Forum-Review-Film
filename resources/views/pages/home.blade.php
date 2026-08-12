@extends('mainlayout')

@section('maincontent')
<div id="heroCarousel"
     class="carousel slide"
     data-bs-ride="carousel">

    <div class="carousel-inner">

        

            @foreach ($trendingFilms as $key => $film)
        
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                    <div class="carousel-img-wrapper">
                
                        <img src="https://image.tmdb.org/t/p/original{{ $film->banner }}"
                            class="carousel-img">
                
                </div>
                    <div class="carousel-caption custom-caption">
        
                        <h1>{{ $film->judul }}</h1>
        
                        <p>
                            {{ Str::limit($film->sinopsis, 100) }}
                        </p>
        
                        <a href="{{ url('/listFilm/' . $film->id) }}"
                           class="btn btn-warning">
        
                            Lihat Detail
        
                        </a>
        
                    </div>
        
                </div>
        
            @endforeach
        
        

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
{{-- <div>
poster list ke kanan atau kebawah 5 atau 6 film untuk film yang sedang tayang
</div> --}}

<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="text-white">TRENDING</h4>

        <a href="/listFilm" class="text-primary">See All →</a>

    </div>

    <div class="movie-scroll">
        @foreach ($trendingFilms as $key => $film)
        <!-- CARD -->
            <div class="movie-card">
                <a href="{{ url('/listFilm/' . $film->id) }}" class="text-decoration-none">
                    <img src="https://image.tmdb.org/t/p/original{{ $film->poster }}">
                    <h6>{{ $film->judul }}</h6>
                    <div class="movie-info ms-2 font-color">
                        <h6>{{ Str::limit($film->nama_film, 30) }}</h6>
                        <small>
                            {{ $film->release_year }} • {{ $film->type }}
                        </small>
                    </div>
                </a>
            </div>
        @endforeach  
    </div>

</section>
<hr>
{{-- about us --}}
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

{{-- artikel --}}
<section class="container my-5">
    <h4 class="text-white">
        Artikel
    </h4>
    @foreach($articles as $key =>$article)
    <!-- berita 1 -->
    <div class="row article-card align-items-center">

        <!-- GAMBAR -->
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $article->gambar_cover) }}">
        </div>

        <!-- TEXT -->
        <div class="col-md-8 font-color">

            <h3>{{$article->judul}}</h3>

            <p>
                {{ Str::limit($article->isi_awal, 100) }}
            </p>

            <a href="{{url('/articles/' . $article->id)}}" class="btn btn-primary">
                Baca Selengkapnya
            </a>

        </div>

    </div>
    @endforeach 

</section>

<script>
    const container = document.querySelector('.movie-scroll');
    
    container.addEventListener('wheel', function (e) {
        e.preventDefault(); // stop scroll vertikal halaman
    
        container.scrollLeft += e.deltaY;
    });
    </script>
@endsection