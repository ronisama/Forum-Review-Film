@extends('mainlayout')

@section('maincontent')
<section class="container custom-padding">

    <!-- PROFILE CARD -->
<div class="profile-card mb-4 mt-2">

    
    <form class="row align-items-center" action="{{url('/dashboard/'. $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- PROFILE IMAGE -->
        <div class="col-md-3 text-center mb-4 mb-md-0">

            <label for="profileImageInput" class="profile-image-wrapper">

                <img id="previewImage"
                    src="{{ $user->foto_profil
                            ? asset('images/' . $user->foto_profil)
                            : asset('images/default-profile.png') }}"
                    class="profile-image">

                <div class="profile-overlay">
                    Ganti Foto
                </div>

            </label>
            @error('foto_profil')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror

            <input type="file"
                   id="profileImageInput"
                   name="foto_profil"
                   hidden>
                <div>
                @if($user->foto_profil)

                   <button
                       type="submit"
                       name="hapus_foto"
                       value="1"
                       class="btn btn-link text-danger p-0 mt-2">
                   
                       Hapus Foto Profil
                   
                   </button>
                   
                @endif
                </div>
        </div>

        <!-- PROFILE FORM -->
        <div class="col-md-9">

            <h3 class="text-white mb-4">
                Edit Profile
            </h3>

            <!-- USERNAME -->
            <div class="mb-3">

                <label class="form-label text-white">
                    Username
                </label>

                <input type="text"
                       class="form-control custom-input"
                       name="username"
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

            <!-- PASSWORD BARU -->
            <div class="mb-4">

                <label class="form-label text-white">
                    Password Baru
                </label>

                <input type="password"
                       class="form-control custom-input"
                       name="password"
                       placeholder="Masukkan Password Baru">

            </div>

            <!-- konfirmasi password -->
            <div class="mb-4">

                <label class="form-label text-white">
                    Konfirmasi Password Baru
                </label>

                <input type="password"
                       class="form-control custom-input"
                       name="password_confirmation"
                       placeholder="Konfirmasi Password Baru">

            </div>

            <!-- PASSWORD LAMA -->
            <div class="mb-4">

                <label class="form-label text-white">
                    Password Lama
                </label>

                <input type="password"
                       class="form-control custom-input"
                       name="password_lama"
                       placeholder="Masukkan Password Lama" required>
            </div>

        </div>

        <!-- udpate profil-->     
        <div class="text-end mt-3 px-3"> 
        <button type="submit" class="btn btn-primary"> save </button>
        </div>
    </form>
    <!-- logout -->
    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-primary">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </button>
    </form>
    {{-- hapus akun --}}
    <form method="POST" action="/dashboard/{{ $user->id }}" onsubmit="return confirm('yakin ingin hapus akun?')">
        @csrf
        @method('DELETE')

        <input type="password"
                name="password"
                class="form-control mb-2 custom-input"
                placeholder="masukkan password">

        <button class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i>
            Hapus Akun
        </button>
    </form>
    

    <!-- FAVORITE GENRE kurang ini yak -->
    <div class="dashboard-section mb-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="text-white">
                Favorite Genre
            </h4>

        </div>

        @foreach($userGenres as $genre)

            <div class="font-color">

                {{ $genre->genre }}
                ({{ $genre->pivot->score }})

            </div>

        @endforeach
    </div>

</div>

    
    {{-- threads list user --}}
    <div class="dashboard-section mb-4">
        <div class="dashboard-section mb-4">

            <h4 class="text-white mb-3">
                Thread Saya
            </h4>
            <div class="d-flex gap-3 mb-3">

                <div class="genre-chip">
                    Total Thread: {{ $threads->count() }}
                </div>
            
            </div>
        
            @forelse($threads as $thread)
        
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
                
                            <form action="/feeds/{{ $thread->id }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus thread ini?')">
                
                                @csrf
                                @method('DELETE')
                
                                <button class="btn btn-sm btn-outline-danger mt-2">
                                    Hapus 
                                        <i class="bi bi-trash"></i>
                                </button>
                
                            </form>
                
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

<script>
    document.getElementById('profileImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
    
        if (file) {
            const reader = new FileReader();
    
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }
    
            reader.readAsDataURL(file);
        }
    });
    </script>