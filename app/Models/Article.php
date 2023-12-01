<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'ILIKE', '%' . $search . '%')
                  ->orWhere('excerpt', 'ILIKE', '%' . $search . '%')
                  ->orWhere('source', 'ILIKE', '%' . $search . '%');
        });
    }

    public function classification(){
        return $this->belongsTo(Classification::class);
    }
}
