<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
