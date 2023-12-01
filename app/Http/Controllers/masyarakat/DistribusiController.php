<?php

namespace App\Http\Controllers\masyarakat;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistribusiController extends Controller
{
    public function distribusi(){
        $stores = Store::with('product')->get();
        return view('masyarakat.distribusi',[
            'stores'=>$stores
        ]);
    }
}
