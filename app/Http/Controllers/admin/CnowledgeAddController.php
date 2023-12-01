<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Http\Controllers\Controller;

class CnowledgeAddController extends Controller
{
    public function show(){
        $classifications = Classification::all();
        return view('admin.cnowledge.add',[
            'classifications' => $classifications
        ]);
    }

    public function add(Request $request){

        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'source' => 'required',
            'link' => 'required|url',
            'body' => 'required',
        ]);

        $excerpt = implode(' ', array_slice(str_word_count($request->input('body'), 1), 0, 8));
        $slug = strtolower(str_replace(' ', '-', $request->input('title')));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article_images', 'public');
        } else {
            $imagePath = null;
        }

        Article::create([
            'classification_id' => $request->input('classification_id'),
            'title' => $request->input('title'),
            'image' => $imagePath,
            'source' => $request->input('source'),
            'link' => $request->input('link'),
            'body' => $request->input('body'),
            'excerpt' => $excerpt,
            'slug' => $slug,
        ]);

        return redirect()->route('cnowledge.cnowledge')->with('success','Artikel Berhasil Ditambahkan');
    }
}
