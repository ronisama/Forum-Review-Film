@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <div class="glass-card p-4">

        <div class="d-flex align-items-center mb-3">
            <div class="text-muted small">
                {{ $thread->created_at->diffForHumans() }}
            </div>
            <strong>
                {{ $thread->user->username }}
            </strong>

            <span class="mx-2">•</span>

            <span>
                {{ $thread->film->nama_film }}
            </span>

        </div>

        <p>
            {{ $thread->isi_thread }}
        </p>

    </div>

    <div class="mt-4">
        {{-- form komentar --}}
        <div class="glass-card p-3 mb-4">

            <form method="POST" action="/komentar">
                @csrf
        
                <input
                    type="hidden"
                    name="thread_id"
                    value="{{ $thread->id }}">
        
                <textarea
                    name="isi_komentars"
                    class="form-control mb-3"
                    rows="3"
                    placeholder="Tulis komentar..."></textarea>
        
                <button class="btn btn-primary">
                    Kirim Komentar
                </button>
        
            </form>
        
        </div>
        {{-- list komentar --}}
        <h4>Komentar</h4>

        @forelse($thread->komentars as $komentar)

            <div class="glass-card p-3 mb-2">
                <div class="d-flex align-items-center">

                    @if($komentar->user->foto_profil)
                
                        <img
                            src="{{ asset('images/' . $komentar->user->foto_profil) }}"
                            width="40"
                            height="40"
                            class="rounded-circle">
                
                    @else
                
                        <div
                            class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                
                            <i class="bi bi-person text-white"></i>
                
                        </div>
                
                    @endif
                
                    <div class="ms-2">
                
                        <strong>
                            {{ $komentar->user->username }}
                        </strong>

                    </div>
                
                </div>

                <p class="mb-0 mt-2">
                    {{ $komentar->isi_komentars}}
                </p>
                {{-- tombol balas komentar --}}
                <button
                    class="btn btn-sm btn-outline-light"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#replyForm{{ $komentar->id }}">

                    Balas

                </button>
                <div
                    class="collapse mt-2"
                    id="replyForm{{ $komentar->id }}">

                    <form action="/komentar" method="POST">

                        @csrf

                        <input
                            type="hidden"
                            name="thread_id"
                            value="{{ $thread->id }}">

                        <input
                            type="hidden"
                            name="parent_id"
                            value="{{ $komentar->id }}">

                        <textarea
                            name="isi_komentars"
                            class="form-control mb-2"
                            rows="2"></textarea>

                        <button class="btn btn-primary btn-sm">

                            Kirim Balasan

                        </button>

                    </form>

                </div>
            </div>
            @foreach($komentar->replies as $reply)

            <div class="ms-5 mt-3">

                <div class="glass-card p-2">

                    <strong>
                        {{ $reply->user->username }}
                    </strong>

                    <p class="mb-0 mt-1">
                        {{ $reply->isi_komentars }}
                    </p>

                </div>

            </div>

            @endforeach

        @empty

            <p>Belum ada komentar.</p>

        @endforelse

    </div>

</div>

@endsection