@extends('mainlayout')

@section('maincontent')
<section class="container custom-padding">

    <div class="row">
        <!-- SIDEBAR -->
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
                        <div class="d-none d-md-block">
                            @foreach($categories as $category)

                            <div class="form-check">
                            
                                <input
                                    id="category{{ $category->id }}"
                                    class="form-check-input"
                                    type="radio"
                                    name="category_radio"
                                    value="{{ $category->id }}"
                                    {{ request('category_radio') == $category->id ? 'checked' : '' }}>
                             
                                <label for="category {{$category->id}}"class="form-check-label font-color">
                                    
                                    {{ $category->nama_kategori }}
                                    
                                </label>
                            
                            </div>
                            @endforeach
                        </div>
                        {{-- hanya muncul di mobile --}}
                        <div class='d-block d-md-none'>
                            <select
                                name="category_select"
                                class="form-select mt-2">
    
                                <option value="">
                                    Semua Kategori
                                </option>
    
                                @foreach ($categories as $category)
    
                                    <option
                                        value="{{ $category->id }}"
                                        {{ request('category_select') == $category->id ? 'selected' : '' }}>
    
                                        {{ $category->nama_kategori }}
    
                                    </option>
    
                                @endforeach
                            
                            </select>
                        </div>
                            
            
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
        <!-- CONTENT -->
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

    </div>

</section>