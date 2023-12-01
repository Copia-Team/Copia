<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function show(){
        $search = request('search');
        $page = request('page', 1);

        $stores = Store::query();

        if ($search) {
            $stores->search($search);
        }

        $stores->orderBy('created_at', 'desc');
        $stores = $stores->paginate(5, ['*'], 'page', $page);
        return view('admin.distribusi',[
            'stores'=> $stores
        ]);
    }

    public function promosi(Request $request, $id){
        $store = Store::find($id);
        $user = User::find($store->user_id);

        $request->validate([
            'discount' => 'required|integer',
        ]);

        $discount = $request->input('discount');

        Notification::create([
            'user_id' => $user->id,
            'body' => 'Discount produk anda ' . $discount,
            'discount'=> $discount,
        ]);

        return redirect()->route('distribusi.distribusi')->with('success','Berhasil menawarkan Promosi');

    }
}
