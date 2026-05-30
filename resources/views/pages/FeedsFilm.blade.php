@extends('mainlayout')

@section('maincontent')
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

{{-- tampil threads orang lain --}}
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

@endforeach