@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <div class="glass-card p-4">

        <div class="d-flex align-items-center mb-3">

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

        <h4>Komentar</h4>

        @forelse($thread->komentars as $komentar)

            <div class="glass-card p-3 mb-2">

                <strong>
                    {{ $komentar->user->username }}
                </strong>

                <p class="mb-0 mt-2">
                    {{ $komentar->isi_komentar }}
                </p>

            </div>

        @empty

            <p>Belum ada komentar.</p>

        @endforelse

    </div>

</div>

@endsection