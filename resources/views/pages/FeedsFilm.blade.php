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
                @foreach($films->take(5) as $film)

                <div class="d-flex mb-3">
                    <a href="/listFilm/{{ $film->id }}">
                        <img src="https://image.tmdb.org/t/p/w300{{ $film->poster }}"
                         width="70"
                         height="100"
                         class="rounded">
                    </a>
                        <div class="ms-2 font-color">

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
                        @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                             style="width:40px; height:40px;">
        
                            <i class="bi bi-person text-white"></i>
        
                        </div>
                        @endif
        
                    </div>
        
                    <div class="flex-grow-1">
        
                        <textarea
                            id="threadInput"
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

            <div class="mb-4">

                <a href="{{ url('/feeds?tab=recommend') }}"
                   class="btn {{ $tab == 'recommend' ? 'btn-primary' : 'btn-outline-primary' }}">
            
                    Untuk Anda
            
                </a>
            
                <a href="{{ url('/feeds?tab=latest') }}"
                   class="btn {{ $tab == 'latest' ? 'btn-primary' : 'btn-outline-primary' }}">
            
                    Thread Terbaru
            
                </a>
            
            </div>
            @if($tab == 'recommend')
                <h3 class="mb-3">
                    Untuk Anda
                </h3>
                {{-- recommended threads --}}
                @foreach($recommendedThreads as $thread)

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
                
                                <div class="small text-info mb-2">
                
                                    {{ $thread->film->nama_film }}
                
                                </div>
                
                                <p>
                
                                    {{ Str::limit($thread->isi_thread, 180) }}
                
                                </p>
                                <div class="mt-2 small">
        
                                    <i class="bi bi-chat"></i>
                                
                                    {{ $thread->komentars->count() }}
                                
                                </div>
                            </div>
                
                        </div>
                
                    </div>
                
                </a>
                
            @endforeach
            <div class="mt-3">
                {{ $recommendedThreads->links() }}
            </div>

            {{-- latest Trhead --}}
            @else
                <h3 class="mb-3">
                    Thread Terbaru
                </h3>
                
                @foreach($latestThreads as $thread)

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
                
                                <div class="small text-info mb-2">
                
                                    {{ $thread->film->nama_film }}
                
                                </div>
                
                                <p>
                
                                    {{ Str::limit($thread->isi_thread, 180) }}
                
                                </p>
                                <div class="mt-2 small">
        
                                    <i class="bi bi-chat"></i>
                                
                                    {{ $thread->komentars->count() }}
                                
                                </div>
                            </div>
                
                        </div>
                
                    </div>
                
                </a>

                @endforeach

                
                <div class="mt-3">
                    {{ $latestThreads->links() }}
                </div>
            @endif
        </div>

    </div>

</div>

<script>
    const textarea = document.getElementById('threadInput');
    
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
</script>
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