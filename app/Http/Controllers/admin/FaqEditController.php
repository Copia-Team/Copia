<?php

namespace App\Http\Controllers\admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;

class FaqEditController extends Controller
{
    public function show($id){
        $faq = Faq::find($id);
        $categories = Category::all();
        return view('admin.faq.editfaq',[
            'faq' => $faq,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id){
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $request->input('category_id'),
            'status' => true
        ]);

        return redirect()->route('faq.faq')->with('success', 'FAQ Berhasil Diupdate');
    }
}
