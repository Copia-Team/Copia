<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CnowledgeController extends Controller
{
    public function show(){
        $search = request('search');
        $page = request('page', 1);

        $articles = Article::query();

        if ($search) {
            $articles->search($search);
        }

        $articles->orderBy('created_at', 'desc');
        $articles = $articles->paginate(5, ['*'], 'page', $page);

        return view('admin.cnowledge.cnowledge', [
            'articles' => $articles
        ]);
    }

    public function delete($slug){
        $article = Article::find($slug);

        if (!$article) {
            return redirect()->route('cnowledge.cnowledge')->with('failed', 'Failed deleted Article.');
        }

        $article->delete();
        return redirect()->route('cnowledge.cnowledge')->with('success', 'Article successfully deleted.');

    }

}
