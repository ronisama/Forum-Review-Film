<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ArticleCategory extends Model
{
    protected $fillable = [
        'nama_kategori'
    ];

    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            'article_category'
        );
    }
}
