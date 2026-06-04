@extends('mainlayout')

@section('maincontent')
<section class="container custom-padding">

    <!-- PROFILE CARD -->
<div class="profile-card mb-4 mt-2">
        <!-- PROFILE IMAGE -->
        <div class="col-md-3 text-center mb-4 mb-md-0">

            <img id="previewImage"
                    src="{{ asset('images/'.$user->foto_profil) }}"
                    class="profile-image">
        </div>

        <!-- PROFILE FORM -->
        <div class="col-md-9">

            <h3 class="text-white mb-4">
                Profile {{$user->username}}
            </h3>

            <!-- USERNAME -->
            <div class="mb-3">

                <label class="form-label text-white">
                    Username
                </label>

                <input type="text"
                       class="form-control custom-input"
                       name="username"
                       readonly
                       value="{{$user->username}}">

            </div>

            <!-- EMAIL -->
            <div class="mb-3">

                <label class="form-label text-white">
                    Email
                </label>

                <input type="email"
                       class="form-control custom-input"
                       value="{{$user->email}}"
                       name="email"
                       readonly>

            </div>
            @if(Auth::id() == $user->id)
                <button href="/dashboard" class="btn btn-primary">
                    <a  class="font-color">
                        Edit Profile
                    </a>
                </button>
                
            @endif
        </div>
    
    <!-- FAVORITE GENRE kurang ini yak -->
    <div class="dashboard-section mb-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="text-white">
                Favorite Genre
            </h4>

            <button class="btn btn-outline-light btn-sm">
                Edit Genre
            </button>

        </div>

        <div class="genre-wrapper">

            <span class="genre-chip">Sci-Fi</span>
            <span class="genre-chip">Thriller</span>
            <span class="genre-chip">Action</span>
            <span class="genre-chip">Fantasy</span>

        </div>

    </div>

</div>

    
    {{-- threads list user --}}
    <div class="dashboard-section mb-4">
        <div class="dashboard-section mb-4">

            <h4 class="text-white mb-3">
            Thread {{$user->username}}
            </h4>
            <div class="d-flex gap-3 mb-3">

                <div class="genre-chip">
                    Total Thread: {{ $user->threads->count() }}
                </div>
            
            </div>
        
            @forelse($user->threads as $thread)
        
                <a href="/feeds/{{ $thread->id }}"
                   class="text-decoration-none text-white">
        
                   <div class="glass-card p-3 mb-3">

                    <div class="d-flex justify-content-between align-items-start">
                
                        <div>
                            <strong>
                                {{ $thread->film->nama_film }}
                            </strong>
                
                            <p class="mt-2 mb-0">
                                {{ Str::limit($thread->isi_thread, 99) }}
                            </p>
                        </div>
                
                        <div class="text-end">
                
                            <small class="d-block">
                                {{ $thread->created_at->diffForHumans() }}
                            </small>
                        </div>
                
                    </div>
                
                </div>
        
                </a>
        
            @empty
        
                <div class="glass-card p-3">
        
                    <p class="mb-0">
                        Kamu belum membuat thread.
                    </p>
        
                </div>
        
            @endforelse
        
        </div>
    </div>

</section>

