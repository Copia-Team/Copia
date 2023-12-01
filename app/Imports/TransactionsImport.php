<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        Log::info('Row data:', $row);

        $user = Auth::user();
        $store = Store::with('product')->where('user_id', $user->id)->latest()->first();
        $lastProduct = $store->product->last();
        $id = $lastProduct->id;
        $product = Product::find($id);
        $existingStock = $product->stock;
        $pricePerUnit = $product->price;

        $product->update([
            'stock'=>$existingStock - $row['banyak'],
        ]);

        //dd($lastProduct->id);

        return new Transaction([
            'product_id' => $lastProduct->id,
            'user_id' => $user->id,
            'date' => $row['tanggal'],
            'many' => $row['banyak'],
            'stock' => $existingStock - $row['banyak'],
            'price' => $pricePerUnit * $row['banyak'],
        ]);
    }
}
