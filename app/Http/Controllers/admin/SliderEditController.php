<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderEditController extends Controller
{
    public function show($id){
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', ['slider' => $slider]);
    }

    public function update(Request $request, $id){

        $slider = Slider::findOrFail($id);

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slider_images', 'public');
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
        } else {
            $imagePath = $slider->image;
        }

        $slider->update([
            'image' => $imagePath,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('slider.slider')->with('success', 'Slider updated successfully');
    }

}
