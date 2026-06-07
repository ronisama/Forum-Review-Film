<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    protected $fillable = [
        'judul',
        'gambar_cover',
        'gambar_tengah',
        'isi_awal',
        'isi_tengah',
        'isi_akhir'
    ];

    public function categories()
    {
        return $this->belongsToMany(
            ArticleCategory::class,
            'article_category'
        );
    }
}
