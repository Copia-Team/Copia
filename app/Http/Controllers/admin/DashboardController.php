<?php

namespace App\Http\Controllers\admin;

use App\Charts\TotalPenjualanSemuaChart;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(TotalPenjualanSemuaChart $chart){
        $user = Auth::user();
        $admins = User::where('role', 'admin')->get();
        $petanis = User::where('role', 'petani')->get();
        $articles = Article::all();

        return view('admin.dashboard',[
            'user' => $user,
            'admins' => $admins,
            'petanis' => $petanis,
            'articles' => $articles,
            'chart'=> $chart->build()
        ]);
    }
}
