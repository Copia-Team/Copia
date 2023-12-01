<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function show(){
        $sliders = Slider::all();
        return view('admin.slider.slider',[
            'sliders' => $sliders
        ]);
    }

    public function delete($id){
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect()->route('slider.slider')->with('failed', 'Failed deleted Slider.');
        }

        $slider->delete();
        return redirect()->route('slider.slider')->with('success', 'Slider successfully deleted.');
    }

}
