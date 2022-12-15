<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected  $fillable=[
        'name',
        'account_id',
        'gender',
        'phone',
        'address',
        'province',
    ];
    //làm thuộc tính lấy ra tên giới tính
    //nếu giới tính là 1 thì trả về Nam
    //nếu giới tính là 0 thì trả về Nữ
    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>$attribute['gender']===1?'Nam':'Nữ',
        );
    }

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
