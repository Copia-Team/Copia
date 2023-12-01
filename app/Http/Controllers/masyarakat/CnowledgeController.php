<?php

namespace App\Http\Controllers\masyarakat;

use App\Models\Article;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Classification;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CnowledgeController extends Controller
{
    public function posts(Request $request) {
        $filter = $request->input('filter');

        $articlesQuery = Article::latest();

        if ($filter) {
            $articlesQuery->whereHas('classification', function ($query) use ($filter) {
                $query->where('class', $filter);
            });
        }

        $perPage = 5;
        $articles = $articlesQuery->paginate($perPage);
        $classifications = Classification::all();
        $ranPosts = Article::inRandomOrder()->take(4)->get();

        return view('masyarakat.cnowledge', [
            'posts' => $articles,
            'classifications' => $classifications,
            'ranPosts' => $ranPosts,
            'filter' => $filter
        ]);
    }


    public function post(Article $article){
        $article = Article::with('classification')->latest()->find($article->id);

        if ($article && $article->classification) {
            $relatedArticles = Article::where('classification_id', $article->classification_id)
                ->where('id', '!=', $article->id)
                ->take(4)
                ->get();

            return view('masyarakat.cnowledgePost', [
                'article' => $article,
                'relatedArticles' => $relatedArticles
            ]);
        } else {
            return view('masyarakat.cnowledgePost', [
                'article' => $article,
                'relatedArticles' => collect()
            ]);
        }
    }

    public function loadMore(Request $request){
        $offset = $request->input('offset');
        $filter = $request->input('filter');

        $articlesQuery = Article::latest();

        if ($filter) {
            $articlesQuery->whereHas('classification', function ($query) use ($filter) {
                $query->where('class', $filter);
            });
        }

        $articles = $articlesQuery->skip($offset)->take(5)->get();

        return response()->json($articles);
    }

    public function generatePDF($slug) {
        $article = Article::where('slug', $slug)->firstOrFail();

        $html = view('masyarakat.cnowledgePost', ['article' => $article])->render();

        $pdf = PDF::loadHtml($html);

        return $pdf->download('Knowledge.pdf');
    }

}
