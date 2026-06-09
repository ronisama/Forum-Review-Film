<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::insert([
            [
                'nama_kategori' => 'Berita',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'nama_kategori' => 'Review',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'nama_kategori' => 'Leak/Rumor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [

                'nama_kategori' => 'Ending Explained',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Rekomendasi Film',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
