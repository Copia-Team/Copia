<?php

namespace App\Http\Controllers\petani;

use App\Charts\TotalPenjualanPetaniChart;
use Illuminate\Http\Request;
use App\Charts\TransaksiPetaniChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(TransaksiPetaniChart $chart, TotalPenjualanPetaniChart $tpChart){
        $user = Auth::user();
        return view('petani.home', [
            'chart' => $chart->build($user->id),
            'tpChart'=> $tpChart->build($user->id),
        ]);
    }
}
