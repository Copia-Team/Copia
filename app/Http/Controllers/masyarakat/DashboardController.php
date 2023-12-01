<?php

namespace App\Http\Controllers\masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $sliders = Slider::all();
        $stores = Store::with('product')->get();
        $selectedOption = $request->input('selectedOption', 'Termurah');
        $storesWithProducts = Store::with('product')->has('product')->latest()->get();

        $storeFilters = $storesWithProducts->map(function ($store) use ($selectedOption) {
            $store->product = $store->product->sortBy(function ($product) use ($selectedOption) {
                switch ($selectedOption) {
                    case 'Termurah':
                        return -($product->price - ($product->price * $product->discount / 100));
                    case 'Tertinggi':
                        return ($product->price - ($product->price * $product->discount / 100));
                    case 'Terbanyak':
                        return $product->stock;
                    case 'Menipis':
                        return -$product->stock;
                    default:
                        return 0;
                }
            });

            return $store;
        });


        $storeFilters = $storeFilters->take(3);

        return view('masyarakat.dashboard',[
            'sliders'=>$sliders,
            'stores'=>$stores,
            'storeFilters'=>$storeFilters,
            'selectedOption' => $selectedOption,
        ]);
    }


}
