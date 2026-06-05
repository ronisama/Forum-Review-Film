@extends('mainlayout')

@section('maincontent')

<div class="container-fluid custom-padding">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="sidebar p-3">
                <h5 class="font-color">Genre</h5>
                <form method="GET" action="{{ url('/listFilm') }}">
                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="Cari film..."
                        value="{{ request('search') }}">
                        @foreach($genres as $genre)

                        <div class="form-check">
                        
                            <input
                                class="form-check-input"
                                type="radio"
                                name="genre"
                                value="{{ $genre->id }}"
                                {{ request('genre') == $genre->id ? 'checked' : '' }}>
                        
                            <label class="form-check-label font-color">
                                
                                {{ $genre->genre }}
                                
                            </label>
                        
                        </div>
                        
                        @endforeach
                        
                        <button
                            type="submit"
                            class="btn btn-primary btn-sm mt-3 w-100">
                        
                            Filter
                        
                        </button>
                        <a href="{{ url('/listFilm') }}"
                            class="btn btn-secondary btn-sm mt-2 w-100">

                            Reset
                        </a>
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

                            <img src="https://image.tmdb.org/t/p/w500{{ $film->poster }}"
                                class="img-fluid">

                                <div class="movie-info ms-2">
                                    <h6>{{ Str::limit($film->nama_film, 30) }}</h6>
                                    <small>
                                        {{ $film->release_year }} • {{ $film->type }}
                                    </small>
                                </div>

                        </div>

                    </a>
                    @auth
                    @if(Auth::user()->role === 'admin')

                        <form
                            action="{{ route('films.destroy', $film->id) }}"
                            method="POST"
                            class="position-relative bottom-0 end-0 m-3">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus film ini?')">

                                <i class="bi bi-trash"></i>
                                Hapus

                            </button>

                        </form>

                    @endif
                    @endauth

                </div>
                
                @endforeach
            </div>
            <div class="mt-4">
                {{ $films->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
</div>
@endsection