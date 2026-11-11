# 🎬 Forum Review Film

Website Forum Review Film merupakan platform diskusi berbasis web yang memungkinkan pengguna mencari film, membuat thread, memberikan komentar, dan berdiskusi berdasarkan film yang diminati.

Aplikasi ini dilengkapi dengan sistem rekomendasi film menggunakan algoritma **Content-Based Filtering**, yang memberikan rekomendasi berdasarkan preferensi genre dan interaksi pengguna.

## ✨ Fitur Utama

- **Autentikasi Pengguna** — Registrasi dan login pengguna.
- **Daftar Film** — Menampilkan informasi dan katalog film.
- **Forum Diskusi** — Membuat thread diskusi berdasarkan film.
- **Komentar** — Memberikan komentar dan membalas komentar pengguna lain.
- **Profil Pengguna** — Mengelola informasi dan foto profil.
- **Rekomendasi Film** — Memberikan rekomendasi film menggunakan algoritma Content-Based Filtering berdasarkan preferensi genre pengguna.

## 🛠️ Teknologi yang Digunakan

- PHP 8.3 atau lebih baru
- Laravel 13
- MySQL
- HTML, CSS, JavaScript
- Bootstrap
- Bootstrap Icons
- Vite
- TMDB API (buat akun dan generate API di website https://www.themoviedb.org)

## 📋 Persyaratan Instalasi

Pastikan perangkat sudah memiliki:

- PHP 8.3+
- Composer
- Node.js dan NPM
- MySQL atau MariaDB
- Git

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project secara lokal.

### 1. Clone Repository

Buka terminal atau command prompt, kemudian jalankan:

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
```

Masuk ke direktori project:

```bash
cd REPOSITORY
```

Ganti `USERNAME` dan `REPOSITORY` sesuai alamat repository GitHub.

### 2. Install Dependency Laravel

Jalankan perintah berikut:

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Windows:

```bash
copy .env.example .env
```

Linux / macOS:

```bash
cp .env.example .env
```

### 4. Konfigurasi Database

Buat database baru melalui MySQL atau phpMyAdmin.

Kemudian sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=forum_review_film
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database, username, dan password dengan konfigurasi MySQL pada perangkat masing-masing. berikut struktur databasenya.

### Database Relationships

Berikut merupakan penjelasan relasi utama antar tabel pada aplikasi Forum Review Film:

1. Users – Threads (One-to-Many)  
   Satu pengguna dapat membuat banyak thread diskusi, sedangkan setiap thread dimiliki oleh satu pengguna.

2. Users – Komentars (One-to-Many)
   Satu pengguna dapat memberikan banyak komentar pada thread diskusi.

3. Threads – Komentars (One-to-Many)
   Satu thread dapat memiliki banyak komentar. Tabel `komentars` juga mendukung komentar bertingkat melalui kolom `parent_id`, sehingga pengguna dapat membalas komentar lainnya.

4. Films – Genres (Many-to-Many)
   Satu film dapat memiliki beberapa genre, dan satu genre dapat dimiliki oleh banyak film. Relasi ini dikelola melalui tabel pivot `film_genre`.

5. Users – Genres (Many-to-Many)  
   Pengguna dapat memiliki beberapa preferensi genre. Relasi ini dikelola melalui tabel pivot `user_genre` yang juga menyimpan nilai `score` sebagai bobot preferensi genre pengguna.

6. Films – Threads (One-to-Many)  
   Satu film dapat memiliki banyak thread diskusi, sedangkan setiap thread dikaitkan dengan satu film.

7. Users – Notifications (One-to-Many)
   Satu pengguna dapat menerima banyak notifikasi melalui tabel `notifications`.

### 5. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

### 6. Migrasi Database

Jalankan perintah:

```bash
php artisan migrate
```

Jika project menyediakan seeder dan membutuhkan data awal, jalankan:

```bash
php artisan db:seed
```

### 7. Install Dependency Frontend

Jalankan:

```bash
npm install
```

Kemudian build asset frontend:

```bash
npm run build
```

### 8. Konfigurasi Storage

Jalankan perintah berikut agar file yang disimpan melalui Laravel Storage dapat diakses secara publik:

```bash
php artisan storage:link
```

### 9. Jalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

Project sekarang dapat dijalankan secara lokal.

## 💡 Pengembangan

Jika ingin menjalankan aplikasi dalam mode development, gunakan dua terminal.

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

## 📝 Catatan

- Pastikan konfigurasi `.env` sudah sesuai dengan lingkungan lokal.
- Jangan membagikan file `.env` karena dapat berisi informasi sensitif.
- Jika aplikasi menggunakan TMDB API, sesuaikan konfigurasi API key berdasarkan kebutuhan project.
- Pastikan database sudah dibuat sebelum menjalankan migration.
- Periksa file `database/seeders` jika aplikasi membutuhkan data awal.

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Silakan lihat file `LICENSE` untuk informasi lebih lanjut mengenai ketentuan penggunaan, modifikasi, dan distribusi project.

---

**Developed as a Final Project (Skripsi)**  
Website Forum Review Film dengan Algoritma Content-Based Filtering.
