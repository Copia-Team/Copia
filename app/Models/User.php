<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function store(){
        return $this->hasOne(Store::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function notification(){
        return $this->hasMany(Notification::class, 'user_id');
    }

}
