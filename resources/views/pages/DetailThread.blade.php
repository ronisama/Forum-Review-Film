@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <div class="glass-card p-4 mb-4">

        <div class="d-flex">
    
            {{-- Avatar --}}
            <div class="me-3">
    
                @if($thread->user->foto_profil)
    
                    <img
                        src="{{ asset('images/' . $thread->user->foto_profil) }}"
                        width="50"
                        height="50"
                        class="rounded-circle object-fit-cover">
    
                @else
    
                    <div
                        class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">
    
                        <i class="bi bi-person text-white"></i>
    
                    </div>
    
                @endif
    
            </div>
    
            {{-- Konten --}}
            <div class="flex-grow-1">
    
                <div class="d-flex align-items-center">
    
                    <strong>
                        {{ $thread->user->username }}
                    </strong>
    
                    <span class="ms-2">
                        • {{ $thread->created_at->diffForHumans() }}
                    </span>
    
                </div>
    
                <div class="text-info small mb-2">
    
                    {{ $thread->film->nama_film }}
    
                </div>
    
                <div class="mb-3">
    
                    {{ $thread->isi_thread }}
    
                </div>
    
            </div>
    
        </div>
    
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
                    id="komentarsInput"
                    name="isi_komentars"
                    rows="1"
                    class="thread-input"
                    placeholder="Apa yang ingin kamu bahas hari ini?"></textarea>

                <button class="btn btn-primary">
                    Kirim Komentar
                </button>
        
            </form>
        
        </div>
        {{-- list komentar --}}
        <h4 class="font-color">Komentar</h4>

        @forelse($komentars as $komentar)

            <div class="glass-card p-3 mb-2">
                <div class="d-flex align-items-center">

                    @if($komentar->user->foto_profil)
                
                        <img
                            src="{{ asset('images/' . $komentar->user->foto_profil) }}"
                            width="40"
                            height="40"
                            class="rounded-circle object-fit-cover">
                        
                    @else
                
                        <div
                            class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                
                            <i class="bi bi-person text-white"></i>
                
                        </div>
                
                    @endif
                
                    <div class="d-flex align-items-center ms-3">
    
                    <strong>
                        {{ $komentar->user->username }}
                    </strong>
    
                    <span class="ms-2">
                        • {{ $komentar->created_at->diffForHumans() }}
                    </span>
    
                </div>
                
                </div>

                <p class="mb-0 mt-2">
                    {!! preg_replace(
                        '/@([A-Za-z0-9_]+)/',
                        '<a href="/user/$1" class="text-info text-decoration-none">@$1</a>',
                        e($komentar->isi_komentars)
                    ) !!}
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

            <div class="ms-5 mt-3 mb-3">

                <div class="glass-card p-2">

                    <strong>
                        {{ $reply->user->username }}
                    </strong>

                    <p class="mb-0 mt-2">
                        {!! preg_replace(
                            '/@([A-Za-z0-9_]+)/',
                            '<span class="text-info">@$1</span>',
                            e($reply->isi_komentars)
                        ) !!}
                    </p>
                    
                </div>

            </div>

            @endforeach

        @empty

            <p class="font font-color">Belum ada komentar.</p>

        @endforelse
        <div class="mt-3">
            {{ $komentars->links() }}
        </div>
    </div>

</div>
<script>
    const textarea = document.getElementById('komentarsInput');
    
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
</script>
@endsection