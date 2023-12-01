<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('question', 'ILIKE', '%' . $search . '%')
                  ->orWhere('answer', 'ILIKE', '%' . $search . '%');
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
