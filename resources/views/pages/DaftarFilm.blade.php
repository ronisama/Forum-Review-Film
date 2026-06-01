@extends('mainlayout')

@section('maincontent')

<div class="container-fluid custom-padding">

    <div class="row">

        <!-- SIDEBAR kurang ini yak -->
        <div class="col-md-2">
            <div class="sidebar p-3">

                <h5 class="font-color font">Genre</h5>
            
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label font-color font">
                        Action
                    </label>
                </div>
            
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label font-color font">
                        Horror
                    </label>
                </div>
            
                <button class="btn btn-primary w-100 mt-3">
                    Terapkan
                </button>
            
            </div>
        </div>

        <!-- CONTENT -->
        <div class="row g-4">

            @foreach($films as $film)
        
            <a href="/film/{{ $film->id }}"
                class="text-decoration-none text-white">
        
                <div class="movie-card-list">
        
                    <img src="{{ asset('images/' . ($film->poster ?? 'default-movie.jpg')) }}" class="img-fluid">
        
                    <div class="p-2">
        
                        <h6>{{ $film->title }}</h6>
        
                        <small>
                            {{ $film->release_year }} • {{ $film->type }}
                        </small>
        
                    </div>
        
                </div>
        
            </a>
        
            @endforeach
        
        </div>
        
    </div>

</div>