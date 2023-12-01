<?php

namespace App\Http\Controllers\petani;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class NotificationController extends Controller
{
    public function decline($id){
        $notification = Notification::findOrFail($id);

        $notification->update([
            'read' => true,
        ]);

        return redirect()->route('produk.produk')->with('success', 'Penawaran promosi ditolak');
    }

    public function accept($id){
        $latestProduct = Product::latest()->first();
        $notification = Notification::findOrFail($id);

        $notification->update([
            'read' => true,
        ]);

        if ($latestProduct) {
            $latestProduct->update([
                'discount' => $notification->discount,
            ]);
        }

        return redirect()->route('produk.produk')->with('success', 'Penawaran promosi diterima');
    }

    public function edit(Request $request, $id){
        $latestProduct = Product::latest()->first();
        $notification = Notification::findOrFail($id);

        $request->validate([
            'discount' => 'required|integer',
        ]);

        $notification->update([
            'read' => true,
            'discount' => $request->input('discount'),
        ]);

        if ($latestProduct) {
            $latestProduct->update([
                'discount' => $request->input('discount'),
            ]);
        }

        return redirect()->route('produk.produk')->with('success', 'Penawaran diedit dan penawaran promosi diterima');
    }
}
