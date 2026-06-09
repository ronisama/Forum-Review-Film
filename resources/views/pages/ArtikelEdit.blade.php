@extends('mainlayout')

@section('maincontent')

<div class="container custom-padding font-color">
    @if(session('success'))

                            <div class="alert alert-success">

                                {{ session('success') }}

                            </div>

                        @endif
    <h2>Tambah Artikel</h2>

    <form action="{{ route('articles.update',$article->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>

            <input
                type="text"
                name="judul"
                class="form-control"
                value="{{ old('judul',$article->judul) }}">
        </div>

        <div class="mb-3">

            <label>Kategori</label>

            @foreach($categories as $category)

                <div class="form-check">

                    <input
                        type="checkbox"
                        name="categories[]"
                        value="{{ $category->id }}"
                        class="form-check-input"

                        {{ $article->categories
                            ->contains($category->id)
                            ? 'checked'
                            : '' }}>

                    <label class="form-check-label">

                        {{ $category->nama_kategori }}

                    </label>

                </div>

            @endforeach

        </div>

        <div class="mb-3">

            <label>Gambar Cover</label>

            <input
                type="file"
                name="gambar_cover"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>Isi Awal</label>

            <textarea
                name="isi_awal"
                class="form-control"
                rows="5">{{ old('isi_awal',$article->isi_awal) }}
            </textarea>

        </div>

        <div class="mb-3">

            <label>Gambar Tengah</label>

            <input
                type="file"
                name="gambar_tengah"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>Isi Tengah</label>

            <textarea
                name="isi_tengah"
                class="form-control"
                rows="5">{{ old('isi_awal',$article->isi_awal) }}
            </textarea>
        </div>

        <div class="mb-3">

            <label>Isi Akhir</label>

            <textarea
                name="isi_akhir"
                class="form-control"
                rows="5">{{ old('isi_awal',$article->isi_awal) }}
            </textarea>
        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Simpan Artikel

        </button>

    </form>

</div>

@endsection