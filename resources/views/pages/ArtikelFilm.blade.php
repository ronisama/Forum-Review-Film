@extends('mainlayout')

@section('maincontent')
<section class="container custom-padding">

    <div class="row">

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            @foreach ($articles as $item)

                <div class="article-list-card mb-4">

                    <div class="row g-3 align-items-center">

                        <!-- IMAGE -->
                        <img
                            src="{{ asset('storage/' . $item->gambar_cover) }}"
                            class="img-fluid article-image">
                        

                        <!-- CONTENT -->
                        <div class="col-md-8">

                            <small class="text-secondary">

                                {{ $item->categories
                                    ->pluck('nama_kategori')
                                    ->join(', ') }}
                            
                            </small>

                            <h3 class="article-title mt-2">
                                {{ $item->judul }}
                            </h3>

                            <p class="article-preview">
                                {{ Str::limit(
                                    strip_tags($item->isi_awal),
                                    150
                                )}}
                            </p>

                            <a
                                href="{{ route(
                                    'articles.show',
                                    $item->id) }}"
                                class="btn btn-primary">

                                Baca Selengkapnya

                            </a>
                            @auth
                            @if(Auth::user()->role === 'admin')

                                <form
                                    action="{{ route('article.destroy', $item->id) }}"
                                    method="POST"
                                    class="position-relative bottom-0 end-0 mt-2">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus artikel ini?')">

                                        <i class="bi bi-trash"></i>
                                        Hapus

                                    </button>

                                </form>
                                {{-- Edit artikel --}}
                                <a
                                    href="{{ route(
                                        'articles.edit',
                                        $item->id
                                    ) }}"
                                    class="btn btn-warning">
                                
                                    Edit Artikel
                            
                                </a>
                            @endif
                            @endauth
                        </div>

                    </div>

                </div>

            @endforeach

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $articles->links() }}
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            <!-- SEARCH -->
            <div class="glass-card w-100 mb-3">
                <div class="card-body">
        
                    <form method="GET" action="{{ route('articles.index') }}">
        
                        <div class="mb-2">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari artikel..."
                                value="{{ request('search') }}">
                        </div>
        
                        <button class="btn btn-primary w-100">
                            Search
                        </button>
        
                    </form>
        
                </div>
            </div>
        
            <!-- KATEGORI -->
            <div class="glass-card w-100">
                <div class="card-body">
            
                    <h5 class="mb-3">Kategori</h5>
            
                    <form method="GET" action="{{ route('articles.index') }}">
                        <!-- KATEGORI CHECKBOX -->
                        @foreach ($categories as $category)
            
                            <div class="form-check">
            
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="category[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>
            
                                <label class="form-check-label">
                                    {{ $category->nama_kategori }}
                                </label>
            
                            </div>
            
                        @endforeach
            
                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-primary btn-sm mt-3 w-100">
                            Filter
                        </button>
            
                        <a href="{{ route('articles.index') }}"
                           class="btn btn-secondary btn-sm mt-2 w-100">
                            Reset
                        </a>
            
                    </form>
            
                </div>
            </div>
        
        </div>

    </div>

</section>