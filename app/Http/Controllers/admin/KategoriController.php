<?php

namespace App\Http\Controllers\admin;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function show(){

        $search = request('search');
        $page = request('page', 1);

        $categories = Category::query();

        if ($search) {
            $categories->search($search);
        }

        $categories = $categories->paginate(5, ['*'], 'page', $page);

        return view('admin.faq.kategori',[
            'categories' => $categories
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'category' => 'required|unique:categories,category',
        ]);

        Category::create([
            'category' => $request->input('category'),
            'slug' => strtolower($request->input('category')),
        ]);

        return redirect()->route('kategori.kategori');
    }

    public function edit(Request $request, $id){
        $category = Category::findOrFail($id);

        $request->validate([
            'category' => 'required|unique:categories,category,'.$id,
        ]);

        $category->update([
            'category' => $request->input('category'),
            'slug' => strtolower($request->input('category')),
        ]);

        return redirect()->route('kategori.kategori');
    }

    public function delete($id){
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('kategori.kategori')->with('failed', 'Gagal delete kategori.');
        }

        Faq::where('category_id', $id)->update(['category_id' => null]);

        $category->delete();
        return redirect()->route('kategori.kategori')->with('success', 'Kategori berhasil didelete.');
    }
}
