<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'province',
        'status',
        'payment_method',
        'total_discount',
        'shipping_fee',
        'total_price',
        'delivery_date',
    ];

    //Thiết lập quan hệ n-1 với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Thiết lập quan hệ 1-n với bảng pivot order_product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'total_price');
    }
}
