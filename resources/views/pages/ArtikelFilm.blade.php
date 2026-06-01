@extends('mainlayout')

@section('maincontent')
<section class="container custom-padding">

    <div class="row">

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            @foreach ($artikel as $item)

                <div class="article-list-card mb-4">

                    <div class="row g-3 align-items-center">

                        <!-- IMAGE -->
                        <div class="col-md-4">
                            <img src="{{ $item->thumbnail }}"
                                 class="img-fluid article-image">
                        </div>

                        <!-- CONTENT -->
                        <div class="col-md-8">

                            <small class="text-secondary">
                                {{ $item->category }}
                            </small>

                            <h3 class="article-title mt-2">
                                {{ $item->title }}
                            </h3>

                            <p class="article-preview">
                                {{ Str::limit($item->content, 150) }}
                            </p>

                            <a href="#"
                               class="btn btn-primary">
                                Baca Selengkapnya
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $items->links() }}
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            <div class="popular-section">

                <h4 class="mb-4">Popular Posts</h4>

                @foreach ($popularPosts as $post)

                    <div class="popular-card mb-3">

                        <img src="{{ $post->thumbnail }}"
                             class="img-fluid rounded">

                        <h6 class="mt-2">
                            {{ $post->title }}
                        </h6>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>