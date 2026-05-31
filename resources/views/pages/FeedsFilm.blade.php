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
                            {{ $film->title }}
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
        <div class="col-lg-9">
            <div class="glass-card p-3 mb-4">

                <form action="/thread"
                      method="POST">
            
                    @csrf
            
                    <div class="d-flex">
                    @if(Auth::check() && Auth::user()->foto_profil)

                        <img src="{{ asset('images/' . Auth::user()->foto_profil) }}"
                             width="45"
                             height="45"
                             class="rounded-circle object-fit-cover">
                    
                    @else
                    
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                             style="width:40px; height:40px;">
                    
                            <i class="bi bi-person text-white"></i>
                    
                        </div>
                    
                    @endif
                        <div class="flex-grow-1 ms-3">
            
                            <textarea
                                class="form-control border-0"
                                name="isi_thread"
                                rows="4"
                                placeholder="Apa yang ingin kamu bahas hari ini?"></textarea>
            
                        </div>
            
                    </div>
            
                    <hr>
            
                    <div class="row">
            
                        <div class="col-md-8">
            
                            <select class="form-select"
                                    name="film_id">
            
                                <option>
                                    Pilih Film
                                </option>
            
                                @foreach($films as $film)
            
                                <option value="{{ $film->id }}">
                                    {{ $film->title }}
                                </option>
            
                                @endforeach
            
                            </select>
            
                        </div>
            
                        <div class="col-md-4 text-end">
            
                            <button class="btn btn-primary">
                                Posting
                            </button>
            
                        </div>
            
                    </div>
            
                </form>
                 <!-- THREAD DATABASE -->
                @foreach($threads as $thread)

                <div class="glass-card p-3 mb-3">

                    <div class="d-flex align-items-center mb-2">
                    @if($thread->user->foto_profil)

                        <img src="{{ asset('images/' . $thread->user->foto_profil) }}"
                             width="45"
                             height="45"
                             class="rounded-circle object-fit-cover">
                    
                    @else
                    
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                             style="width:45px; height:45px;">
                    
                            <i class="bi bi-person text-white"></i>
                    
                        </div>
                    
                    @endif
                        <div class="ms-2">

                            <strong>
                                {{ $thread->user->username }}
                            </strong>

                            <div class="text-muted">
                                {{ $thread->film->title }}
                            </div>

                        </div>

                    </div>

                    <p>
                        {{ $thread->isi_thread }}
                    </p>

                </div>

            @endforeach
            
            </div>
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
                    {{ $film->title }}
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
            {{ $thread->film->title }}
        </small>

        <p class="mt-2">
            {{ $thread->isi_thread }}
        </p>

    </div>

</div>

@endforeach --}}