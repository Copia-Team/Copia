<?php

namespace App\Http\Controllers\petani;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\TransactionsExport;
use App\Imports\TransactionsImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function transaksi(){
        $user = Auth::user();
        $request = request();
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $transactions = Transaction::query()
            ->where('user_id', $user->id);

        if ($search) {
            $transactions->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'ilike', '%' . $search . '%');
            });
        }

        if ($start_date && $end_date) {
            $transactions->whereBetween('date', [$start_date, $end_date]);
        }

        $perPage = $request->input('per_page', 10);
        $transactions = $transactions->orderBy('date', 'desc')->paginate($perPage);

        return view('petani.transaksi', [
            'transactions' => $transactions
        ]);
    }


    public function add(Request $request, $id){
        $user = Auth::user();
        $product = Product::find($id);
        $quantity = $request->input('many');
        $existingStock = $product->stock;
        $pricePerUnit = $product->price;

        if (!$product) {
            dd('Produk gk ada');
        }

        $request->validate([
            'many' => 'required|integer|max:' . $product->stock,
        ]);

        Transaction::create([
            'product_id' => $id,
            'user_id' => $user->id,
            'date' => now(),
            'many' => $quantity,
            'stock' => $existingStock - $quantity,
            'price' => $pricePerUnit * $quantity,
        ]);

        $product->update([
            'stock'=>$existingStock - $quantity,
        ]);

        return redirect()->route('transaksi.transaksi');
    }

    public function export(){
        $dateNow = Carbon::now()->format('YmdHis');

        return Excel::download(new TransactionsExport, 'transaksi_' . $dateNow . '.xlsx');
    }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new TransactionsImport, $request->file('file'));

        return redirect()->route('transaksi.transaksi')->with('success', 'Data imported successfully!');
    }
}
