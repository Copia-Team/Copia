<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Classification;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(){
        $search = request('search');
        $page = request('page', 1);

        $categories = Classification::query();

        if ($search) {
            $categories->search($search);
        }

        $categories = $categories->paginate(5, ['*'], 'page', $page);

        return view('admin.cnowledge.kategori',[
            'categories' => $categories
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'class' => 'required|unique:classifications,class',
        ]);

        Classification::create([
            'class' => $request->input('class'),
            'slug' => strtolower($request->input('class')),
        ]);

        return redirect()->route('class.kategori');
    }

    public function edit(Request $request, $id){
        $class = Classification::findOrFail($id);

        $request->validate([
            'class' => 'required|unique:classifications,class,'.$id,
        ]);

        $class->update([
            'class' => $request->input('class'),
            'slug' => strtolower($request->input('class')),
        ]);

        return redirect()->route('class.kategori');
    }

    public function delete($id){
        $class = Classification::find($id);

        if (!$class) {
            return redirect()->route('class.kategori')->with('failed', 'Failed deleted kategori.');
        }

        $class->delete();
        return redirect()->route('class.kategori')->with('success', 'kategori berhasil didelete.');
    }
}
