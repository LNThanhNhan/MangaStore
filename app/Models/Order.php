<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    //Làm thuộc tính lấy tên trạng thái đơn hàng
    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                OrderStatus::getName($this->status),
        );
    }

    //Làm thuộc tính định dạng lại ngày đặt hàng theo định dạng dd/mm/yyyy từ order date của order
    protected function orderDateDMY(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                date('d/m/Y', strtotime($this->order_date)),
        );
    }

    //Làm thuộc tính định dạng tiền tệ theo VNĐ từ total_price của order
    protected function totalPriceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) => number_format($this->total_price).' đ',
        );
    }
}
