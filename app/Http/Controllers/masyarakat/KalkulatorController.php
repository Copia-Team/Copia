<?php

namespace App\Http\Controllers\masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    public function kalkulator(){
        return view('masyarakat.kalkulator');
    }
}
