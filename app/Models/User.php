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

    //Thiết lập quan hệ 1-1 với bảng accounts
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    //Thiết lập quan hệ 1-1 với bảng carts
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    //Thiết lập quan hệ 1-n với bảng orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
