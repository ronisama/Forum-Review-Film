@extends('mainlayout')

@section('maincontent')

<div class="container-fluid custom-padding">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="sidebar p-3">
                <h5>Genre</h5>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">
                        Action
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">
                        Horror
                    </label>
                </div>
            </div>
        </div>

        <!-- Daftar Film -->
        <div class="col-md-10">
            <div class="row g-4">

                @foreach($films as $film)

                <div class="col-lg-2 col-md-3 col-sm-4 col-6">

                    <a href="/listFilm/{{ $film->id }}"
                        class="text-decoration-none text-white">

                        <div class="movie-card">

                            <img src="{{ asset('images/' . ($film->poster ?? 'default-movie.jpg')) }}"
                                class="img-fluid">

                                <div class="movie-info">
                                    <h6>{{ Str::limit($film->nama_film, 30) }}</h6>
                                    <small>
                                        {{ $film->release_year }} • {{ $film->type }}
                                    </small>
                                </div>

                        </div>

                    </a>

                </div>

                @endforeach

            </div>
        </div>

    </div>
</div>