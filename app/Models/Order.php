<?php

namespace App\Models;

use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Enums\Province;
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

    //Làm thuộc tính định dạng tiền tệ theo VNĐ từ shipping_fee của order
    protected function shippingFeeVND(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) => number_format($this->shipping_fee).' đ',
        );
    }

    //Làm thuộc tính định dạng tiền tệ theo VNĐ từ total_discount của order
    protected function totalDiscountVND(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) => number_format($this->total_discount).' đ',
        );
    }

    //Làm thuộc tính tính tổng tiền của order khi chưa trừ giảm giá và phí vận chuyển
    protected function totalOrderVND(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) => number_format($this->total_price + $this->total_discount - $this->shipping_fee).' đ',
        );
    }

    //Làm thuộc tính định dạng lại ngày giao hàng theo định dạng dd/mm/yyyy từ delivery_date của order
    protected function deliveryDateDMY(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                date('d/m/Y', strtotime($this->delivery_date)),
        );
    }

    //Làm thuộc tính định dạng lại ngày đặt theo định dạng dd/mm/yyyy HH:mm từ order_date của order
    protected function orderDateDMYHM(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                date('d/m/Y H:i', strtotime($this->order_date)),
        );
    }

    //Làm thuộc tính lấy ra tên của phương thức thanh toán theo enum OrderPaymentMethod
    protected function paymentMethodName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                OrderPaymentMethod::getPaymentMethodName($this->payment_method),
        );
    }

    //Lấy ra tên của tỉnh thành phố từ enum Province
    protected function provinceName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attribute) =>
                Province::getProvinceNameById($this->province),
        );
    }
}
