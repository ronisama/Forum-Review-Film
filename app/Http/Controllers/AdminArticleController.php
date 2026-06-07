<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    public function create()
    {
        return view(
            'pages.ArtikelTambah',
            [
                'categories' => ArticleCategory::all()
            ]
        );
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'gambar_cover' => 'required|image',
            'gambar_tengah' => 'required|image',
            'isi_awal' => 'required',
            'isi_tengah' => 'required',
            'isi_akhir' => 'required',
            'categories' => 'required|array'
        ]);

        $gambarCover = $request
            ->file('gambar_cover')
            ->store(
                'articles',
                'public'
            );

        $gambarTengah = $request
            ->file('gambar_tengah')
            ->store(
                'articles',
                'public'
            );

        $article = Article::create([
            'judul' => $validated['judul'],
            'gambar_cover' => $gambarCover,
            'gambar_tengah' => $gambarTengah,
            'isi_awal' => $validated['isi_awal'],
            'isi_tengah' => $validated['isi_tengah'],
            'isi_akhir' => $validated['isi_akhir']
        ]);

        $article->categories()->sync(
            $validated['categories']
        );

        return back()->with(
            'success',
            'Artikel berhasil ditambahkan'
        );
    }
}
