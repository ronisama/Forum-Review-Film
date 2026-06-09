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
            'gambar_cover' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_tengah' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi_awal' => 'required',
            'isi_tengah' => 'required',
            'isi_akhir' => 'required',
            'categories' => 'required|array'
        ], [
            'gambar_cover.max' =>
            'Gambar cover maksimal 2 MB.',

            'gambar_tengah.max' =>
            'Gambar tengah maksimal 2 MB.',
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
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with(
            'success',
            'Artikel berhasil dihapus'
        );
    }

    public function edit(Article $article)
    {
        return view(
            'pages.ArtikelEdit',
            [
                'article' => $article,
                'categories' => ArticleCategory::all()
            ]
        );
    }
    public function update(
        Request $request,
        Article $article
    ) {
        $validated = $request->validate([
            'judul' => 'required',
            'isi_awal' => 'required',
            'isi_tengah' => 'required',
            'isi_akhir' => 'required',
            'categories' => 'required|array'
        ]);

        $data = [
            'judul' => $validated['judul'],
            'isi_awal' => $validated['isi_awal'],
            'isi_tengah' => $validated['isi_tengah'],
            'isi_akhir' => $validated['isi_akhir']
        ];

        if ($request->hasFile('gambar_cover')) {

            $data['gambar_cover'] = $request
                ->file('gambar_cover')
                ->store(
                    'articles',
                    'public'
                );
        }

        if ($request->hasFile('gambar_tengah')) {

            $data['gambar_tengah'] = $request
                ->file('gambar_tengah')
                ->store(
                    'articles',
                    'public'
                );
        }

        $article->update($data);

        $article->categories()->sync(
            $validated['categories']
        );

        return redirect()
            ->route(
                'articles.show',
                $article->id
            )
            ->with(
                'success',
                'Artikel berhasil diperbarui'
            );
    }
}
