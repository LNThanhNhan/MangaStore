<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected  $fillable=[
        'name',
        'gender',
        'phone',
        'address',
        'province',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}