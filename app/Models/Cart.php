<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'user_id',
    ];

    //Lấy thông tin user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Thiết lập quan hệ cho cart_product belongs to product
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    //Thiết lập quan hệ cho cart belongs to discount
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    //làm thuộc tính tổng giá của giỏ hàng
    //trừ đi tổng số tiền giảm giá
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>
                $this->products->sum(fn($product)=>$product->price*$product->pivot->quantity)-$this->total_discount,
        );
    }

    //làm thuộc tính tổng giá của giỏ hàng bằng VND
    protected function totalPriceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($this->totalPrice).' đ',
        );
    }

    //làm thuộc tính lấy ra tổng số tiền được giảm giá
    //nếu không tồn tại mã giảm giá thì trả về 0
    //nếu có thì dựa vào loại mã giảm giá để tính toán
    //nếu giảm theo số tiền thì tổng số tiền giảm sẽ là value trong discount
    //nếu giảm theo phần trăm thì tổng số tiền giảm sẽ là tổng giá trị trừ đi tổng giá trị nhân với phần trăm giảm
    //nếu tổng số tiền giảm lớn hơn max_discount thì sẽ lấy max_discount
    protected function totalDiscount(): Attribute
    {
        return Attribute::make(
            get: function($value,$attribute) {
                if($this->discount===null)
                    return 0;
                if($this->discount->type === DiscountTypeEnum::SO_TIEN)
                    return $this->discount->value;
                $totalDiscount=$this->totalPrice * $this->discount->value/100;
                //Làm tròn số tiền giảm giá về chữ số nguyên
                $totalDiscount=round($totalDiscount);
                if($totalDiscount>$this->discount->max_discount)
                    return $this->discount->max_discount;
                return $totalDiscount;
            },
        );
    }

    //làm thuộc tính tổng số tiền giảm giá bằng VND
    protected function totalDiscountVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($this->totalDiscount).' đ',
        );
    }
}
