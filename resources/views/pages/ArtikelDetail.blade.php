@extends('mainlayout')

@section('maincontent')

<div class="container custom-padding font-color">

    <div class="row">

        <!-- ARTIKEL -->
        <div class="col-lg-8">

            <!-- KATEGORI -->
            <div class="mb-2">

                @foreach($article->categories as $category)

                    <span class="badge bg-primary">

                        {{ $category->nama_kategori }}

                    </span>

                @endforeach

            </div>

            <!-- JUDUL -->
            <h1 class="mb-3">

                {{ $article->judul }}

            </h1>

            <!-- TANGGAL -->
            <small class="text-secondary">

                {{ $article->created_at->format('d M Y') }}

            </small>

            <!-- COVER -->
            <div class="mt-4">

                <img
                    src="{{ asset('storage/' . $article->gambar_cover) }}"
                    class="img-fluid rounded">

            </div>

            <!-- ISI AWAL -->
            <div class="article-content mt-4">

                {!! nl2br(e($article->isi_awal)) !!}

            </div>

            <!-- GAMBAR TENGAH -->
            <div class="my-4">

                <img
                    src="{{ asset('storage/' . $article->gambar_tengah) }}"
                    class="img-fluid rounded">

            </div>

            <!-- ISI TENGAH -->
            <div class="article-content">

                {!! nl2br(e($article->isi_tengah)) !!}

            </div>

            <!-- ISI AKHIR -->
            <div class="article-content mt-4">

                {!! nl2br(e($article->isi_akhir)) !!}

            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">

            <div class="sticky-top">

                <h4>

                    Trending Film

                </h4>

                @foreach($trendingFilms as $film)

                    <div class="mb-3">

                        <a href="/listFilm/{{ $film->id }}"
                            class="text-decoration-none">
                            <img src="https://image.tmdb.org/t/p/w500{{ $film->poster }}"
                                class="img-fluid">

                        </a>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    <!-- ARTIKEL TERKAIT -->

    <div class="mt-5">

        <h3>

            Artikel Lainnya

        </h3>

        <div class="row">

            @foreach($relatedArticles as $item)

                <div class="col-md-3">

                    <div class="card h-100">

                        <img
                            src="{{ asset('storage/' . $item->gambar_cover) }}"
                            class="card-img-top">

                        <div class="card-body">

                            <h6>

                                {{ Str::limit($item->judul, 50) }}

                            </h6>

                            <a
                                href="{{ route('articles.show', $item->id) }}">

                                Baca

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection