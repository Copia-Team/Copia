<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use App\Http\Controllers\Controller;

class CnowledgeDetailController extends Controller
{
    public function show(Article $article){


        return view('admin.cnowledge.detail',[
            'article'=> $article
        ]);
    }
}
