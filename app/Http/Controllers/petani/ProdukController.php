<?php

namespace App\Http\Controllers\petani;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function produk(){
        $user = Auth::user();
        $request = request();
        $search = $request->input('search');
        $store = $user->store;

        $products = Product::query();

        $perPage = $request->input('per_page', 10);

        if ($search) {
            $products->where('name', 'ilike', '%' . $search . '%');
        }

        $products = $products->where('store_id', $store->id)->orderBy('created_at', 'desc')->paginate($perPage);

        return view('petani.produk', [
            'store' => $store,
            'products' => $products,
        ]);
    }

    public function add(Request $request){
        $user = Auth::user();
        $store = $user->store;

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harvested' => 'required|date',
            'yields' => 'required|integer',
            'discount' => 'integer',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null;
        }

        Product::create([
            'store_id' => $store->id,
            'name' => $request->input('name'),
            'image' => $imagePath,
            'harvested' => $request->input('harvested'),
            'yields' => $request->input('yields'),
            'stock' => $request->input('yields'),
            'discount' => $request->input('discount'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('produk.produk');
    }

    public function edit(Request $request, $id){
        $user = Auth::user();
        $store = $user->store;
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harvested' => 'required|date',
            'yields' => 'required|integer',
            'stock' => 'required|integer',
            'discount' => 'integer',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'store_id' => $store->id,
            'name' => $request->input('name'),
            'image' => $imagePath,
            'harvested' => $request->input('harvested'),
            'yields' => $request->input('yields'),
            'stock' => $request->input('stock'),
            'discount' => $request->input('discount'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('produk.produk')->with('success', 'Product updated successfully');
    }
}
