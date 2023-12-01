<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderAddController extends Controller
{
    public function show(){
        return view('admin.slider.add');
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slider_images', 'public');
        } else {
            $imagePath = null;
        }


        Slider::create([
            'image' => $imagePath,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('slider.slider')->with('success',' Slider berhasil ditambahkan');
    }
}
