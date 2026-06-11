@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <div class="row">

        <div class="col-md-4">

            @if($film->poster)

                <img
                    src="https://image.tmdb.org/t/p/w500{{ $film->poster }}"
                    class="img-fluid rounded">

            @endif

        </div>

        <div class="col-md-8">

            <h1 class="font-color">{{ $film->nama_film }}</h1>
            
            <p class="font-color">
                {{ $film->release_year }}
            </p>
            <h5 class="font-color">
                ⭐ {{ number_format($film->rating, 1) }}/10
            </h5>
            
            <p class="font-color">
                {{ $film->runtime }} menit
            </p>
            <div class="mb-3">
                @foreach($film->genres as $genre)
            
                    <span class="badge bg-secondary me-1">
                        {{ $genre->genre }}
                    </span>
            
                @endforeach
            
            </div>
            <hr>

            <p class="font-color">
                {{ $film->sinopsis ?: 'Sinopsis belum tersedia.' }}
            </p>
            @if($director)

                <p class="font-color">
                    <strong>Director:</strong>
                    {{ $director['name'] }}
                </p>

            @endif
            @if(isset($credits['cast']))

                <h5 class="font-color">Pemeran :</h5>

                <div class="row font-color">

                    @foreach(array_slice($credits['cast'], 0, 5) as $actor)

                        <div class="col-md-4 mb-2">

                            {{ $actor['name'] }}
                            <br>

                            <small>
                                sebagai {{ $actor['character'] }}
                            </small>

                        </div>

                    @endforeach

                </div>
                
            @endif
            @if($trailer)

                <hr>

                <h2 class="font-color">Trailer</h2>

                <div class="ratio ratio-16x9 mx-0"
                    style="max-width: 500px;">

                    <iframe
                        src="https://www.youtube.com/embed/{{ $trailer['key'] }}"
                        allowfullscreen>
                    </iframe>

                </div>

            @endif
        </div>

    </div>

    <hr class="my-5">
    {{-- @if(isset($recommendations['results']))
            <h3 class="font-color">Film Serupa</h3>

            <div class="d-flex overflow-auto gap-3 py-3">

                @foreach(array_slice($recommendations['results'], 0, 8) as $movie)

                    <div class="flex-shrink-0"
                        style="width:180px;">

                        @if($movie['poster_path'])

                            <img
                                src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}"
                                class="img-fluid rounded">

                        @endif

                        <h6 class="mt-2 font-color">

                            {{ $movie['title'] }}

                        </h6>

                        <small class="font-color">

                            ⭐ {{ number_format($movie['vote_average'], 1) }}

                        </small>

                    </div>

                @endforeach

            </div>

    @endif --}}
    <h3 class="font-color">Diskusi Tentang Film Ini</h3>
    {{-- foreach thread--}}
    @forelse($threads as $thread)

            <a href="/feeds/{{ $thread->id }}"
               class="text-decoration-none text-white">
            
                <div class="feed-item">
            
                    <div class="d-flex">
            
                        {{-- avatar --}}
                        <div class="me-3">
            
                            @if($thread->user->foto_profil)
            
                                <img
                                    src="{{ asset('images/' . $thread->user->foto_profil) }}"
                                    width="50"
                                    height="50"
                                    class="rounded-circle object-fit-cover">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                                    style="width:40px; height:40px;">
            
                                    <i class="bi bi-person text-white"></i>
            
                                </div>
                            @endif
            
                        </div>
            
                        <div class="flex-grow-1">
            
                            <div>
            
                                <strong>
                                    {{ $thread->user->username }}
                                </strong>
            
                                <span class="ms-2">
            
                                    {{ $thread->created_at->diffForHumans() }}
            
                                </span>
            
                            </div>
                            <p>
            
                                {{ Str::limit($thread->isi_thread, 180) }}
            
                            </p>
                            <div class="mt-2 small">
    
                                <i class="bi bi-chat"></i>
                            
                                {{ $thread->count() }}
                            
                            </div>
                        </div>
            
                    </div>
            
                </div>
            
            </a>
        @empty

            <p class="font-color">
                Belum ada thread yang membahas film ini.
            </p>
        
        @endforelse
        <div class="mt-3">
            {{ $threads->links() }}
        </div>
    
@endsection