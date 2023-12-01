<?php

namespace App\Http\Controllers\petani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    public function toko(){
        $user = Auth::user();
        $store = $user->store;
        return view('petani.toko',[
            'store'=> $store,
            'user'=> $user
        ]);
    }

    public function edit(Request $request, $id){
        $user = Auth::user();
        $store = $user->store;

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('store_images', 'public');
            if ($store->image) {
                Storage::disk('public')->delete($store->image);
            }
        } else {
            if ($store->image !== null){
                $imagePath = $store->image;
            } else {
                $imagePath = null;
            }
        }

        $store->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'no_telp' => $request->input('no_telp'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'image' => $imagePath,
        ]);

        return redirect()->route('toko.toko')
            ->with('success', 'Store updated successfully');
    }
}
