@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <div class="row">

        <div class="col-md-4">

            <img src="{{ asset('images/' . $film->poster) }}"
                 class="img-fluid rounded">

        </div>

        <div class="col-md-8">

            <h1>{{ $film->nama_film }}</h1>

            <p>
                {{ $film->release_year }}
            </p>

            <hr>

            <p>
                {{ $film->sinopsis }}
            </p>

        </div>

    </div>

    <hr class="my-5">

    <h3>Diskusi Tentang Film Ini</h3>

    @forelse($film->threads as $thread)

        <div class="glass-card p-3 mb-3">

            <strong>
                {{ $thread->user->username }}
            </strong>

            <p class="mt-2 mb-0">
                {{ $thread->isi_thread }}
            </p>

        </div>

    @empty

        <p>
            Belum ada thread yang membahas film ini.
        </p>

    @endforelse

</div>

@endsection