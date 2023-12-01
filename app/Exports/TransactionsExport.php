<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        $userId = Auth::id();

        return Transaction::where('user_id', $userId)->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Produk',
            'Banyak Dibeli',
            'Sisa Stok',
            'Total Bayar',
        ];
    }

    public function map($transaction): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $transaction->date,
            $transaction->product->name,
            $transaction->many . ' Kg',
            $transaction->stock . ' Kg',
            'Rp. ' . $transaction->price,
        ];
    }
}
