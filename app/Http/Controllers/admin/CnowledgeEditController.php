<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CnowledgeEditController extends Controller
{
    public function show(Article $article){
        $classifications = Classification::all();

        return view('admin.cnowledge.edit',[
            'article'=>$article,
            'classifications' => $classifications
        ]);
    }

    public function edit(Request $request, Article $article){
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
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
        } else {
            $imagePath = $article->image;
        }

        $article->update([
            'classification_id' => $request->input('classification_id'),
            'title' => $request->input('title'),
            'image' => $imagePath,
            'source' => $request->input('source'),
            'link' => $request->input('link'),
            'body' => $request->input('body'),
            'excerpt' => $excerpt,
            'slug' => $slug,
        ]);

        return redirect()->route('cnowledge.cnowledge')
            ->with('success', 'Article updated successfully');
    }

}
