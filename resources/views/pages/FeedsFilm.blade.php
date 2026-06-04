@extends('mainlayout')

@section('maincontent')
<div class="container-fluid mt-5 pt-5">

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-lg-3">

            <!-- trending film -->
            <div class="glass-card p-3">

                <h5 class="mb-3">Trending Film</h5>

                {{-- loop film trending --}}
                @foreach($films as $film)

                <div class="d-flex mb-3">

                    <img src="{{ asset('images/' . $film->poster) }}"
                         width="70"
                         height="100"
                         class="rounded">

                    <div class="ms-2">

                        <h6 class="mb-1">
                            {{ Str::limit($film->nama_film, 25) }}
                        </h6>

                        <small>
                            {{ $film->release_year }}
                        </small>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- FEED -->
        <div class="glass-card-feed p-3 mb-0">

            <form action="/feeds" method="POST">
        
                @csrf
        
                <div class="d-flex">
        
                    {{-- avatar --}}
                    <div class="me-3">
        
                        @if(Auth::user()->foto_profil)
        
                            <img
                                src="{{ asset('images/' . Auth::user()->foto_profil) }}"
                                width="50"
                                height="50"
                                class="rounded-circle object-fit-cover">
        
                        @endif
        
                    </div>
        
                    <div class="flex-grow-1">
        
                        <textarea
                            name="isi_thread"
                            rows="1"
                            class="thread-input"
                            placeholder="Apa yang ingin kamu bahas hari ini?"></textarea>
            
                        <div class="d-flex justify-content-between mt-3">
        
                            <select
                                name="film_id"
                                class="form-select w-50">
        
                                @foreach($films as $film)
        
                                    <option value="{{ $film->id }}">
                                        {{ $film->nama_film }}
                                    </option>
        
                                @endforeach
        
                            </select>
        
                            <button
                                class="btn btn-primary">
        
                                Posting
        
                            </button>
        
                        </div>
        
                    </div>
        
                </div>
        
            </form>
            @foreach($threads as $thread)

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
            
                            @endif
            
                        </div>
            
                        <div class="flex-grow-1">
            
                            <div>
            
                                <strong>
                                    {{ $thread->user->username }}
                                </strong>
            
                                <span class="text-muted ms-2">
            
                                    {{ $thread->created_at->diffForHumans() }}
            
                                </span>
            
                            </div>
            
                            <div class="small text-info mb-2">
            
                                {{ $thread->film->nama_film }}
            
                            </div>
            
                            <p>
            
                                {{ Str::limit($thread->isi_thread, 180) }}
            
                            </p>
                            <div class="mt-2 text-muted small">
    
                                <i class="bi bi-chat"></i>
                            
                                {{ $thread->komentars->count() }}
                            
                            </div>
                        </div>
            
                    </div>
            
                </div>
            
            </a>
            
        @endforeach
    
        
        </div>

    </div>

</div>


{{-- 
<form method="POST" action="/feeds">
    @csrf

    <div class="mb-3">
        <label>Film</label>

        <select name="film_id" class="form-control">

            @foreach($films as $film)

                <option value="{{ $film->id }}">
                    {{ $film->nama_film }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Judul Thread</label>

        <input
            type="text"
            name="judul_thread"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Isi Thread</label>

        <textarea
            name="isi_thread"
            rows="5"
            class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">
        Kirim Thread
    </button>

</form>


@foreach($threads as $thread)

<div class="card mb-3">

    <div class="card-body">

        <h5>
            {{ $thread->judul_thread }}
        </h5>

        <small>
            {{ $thread->user->username }}
            •
            {{ $thread->film->nama_film }}
        </small>

        <p class="mt-2">
            {{ $thread->isi_thread }}
        </p>

    </div>

</div>

@endforeach --}}