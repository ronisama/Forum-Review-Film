@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <h2 class="font-color">Cari Film dari TMDB</h2>

    <form action="/admin/films/result" method="GET">

        <div class="input-group mb-4">

            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Cari film, anime, series...">

            <button class="btn btn-primary">

                Cari

            </button>

        </div>

    </form>

    @isset($results)

        @foreach($results as $item)

            <div class="glass-card p-3 mb-3">

                <div class="d-flex">

                    @if(isset($item['poster_path']))

                        <img
                            src="https://image.tmdb.org/t/p/w200{{ $item['poster_path'] }}"
                            width="100"
                            class="rounded">

                    @endif

                    <div class="ms-3">

                        <h5>

                            {{ $item['title'] ?? $item['name'] }}

                        </h5>

                        <p>

                            {{ $item['release_date'] ?? $item['first_air_date'] ?? '-' }}

                        </p>

                        <form
                            action="/admin/films/store"
                            method="POST">

                            @csrf

                            <input
                                type="hidden"
                                name="tmdb_id"
                                value="{{ $item['id'] }}">

                            <input
                                type="hidden"
                                name="nama_film"
                                value="{{ $item['title'] ?? $item['name'] }}">

                            <input
                                type="hidden"
                                name="type"
                                value="{{ $item['media_type'] ?? 'movie' }}">

                            <button
                                class="btn btn-success">

                                Tambahkan ke Database

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    @endisset

</div>

@endsection