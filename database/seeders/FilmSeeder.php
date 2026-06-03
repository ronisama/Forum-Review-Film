<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::insert([
            [
                'nama_film' => 'The Batman',
                'sinopsis' => 'Bruce Wayne menyelidiki serangkaian pembunuhan yang dilakukan oleh Riddler di Gotham City.',
                'release_year' => '2022',
                'poster' => 'the-batman.jpg',
                'type' => 'Movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_film' => 'Interstellar',
                'sinopsis' => 'Sekelompok astronaut melakukan perjalanan melalui wormhole untuk mencari rumah baru bagi umat manusia.',
                'release_year' => '2014',
                'poster' => 'interstellar.jpg',
                'type' => 'Movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_film' => 'Inception',
                'sinopsis' => 'Seorang pencuri memasuki mimpi orang lain untuk mencuri atau menanamkan ide.',
                'release_year' => '2010',
                'poster' => 'inception.jpg',
                'type' => 'Movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_film' => 'Dune',
                'sinopsis' => 'Paul Atreides menghadapi takdirnya di planet gurun Arrakis.',
                'release_year' => '2021',
                'poster' => 'dune.jpg',
                'type' => 'Movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_film' => 'Avengers: Endgame',
                'sinopsis' => 'Para Avengers berusaha membalikkan kehancuran yang disebabkan oleh Thanos.',
                'release_year' => '2019',
                'poster' => 'endgame.jpg',
                'type' => 'Movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
