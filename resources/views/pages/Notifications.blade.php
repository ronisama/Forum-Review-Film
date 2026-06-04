@extends('mainlayout')

@section('maincontent')

<div class="container mt-5 pt-5">

    <h2 class="mb-4 font-color">
        Notifikasi
    </h2>

    @forelse($notifications as $notif)
        <a href="/feeds/{{ $notif->thread_id }}" class="text-decoration-none text-white">
        <div class="glass-card p-3 mb-3">

            <strong>
                {{ $notif->pengirim->username }}
            </strong>

            @if($notif->tipe == 'reply')

            <div class="mt-2">
                {{ Str::limit($notif->pesan, 100) }}
            </div>

            @elseif($notif->tipe == 'mention')  

            <div class="mt-2">
                {{ Str::limit($notif->pesan, 100) }}
            </div>

            @endif

            <div class="small mt-1">
                {{ $notif->created_at->diffForHumans() }}
            </div>

        </div>
        </a>
    @empty

        <div class="glass-card p-3">
            Belum ada notifikasi.
        </div>

    @endforelse

</div>

@endsection