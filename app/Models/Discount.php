<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'name',
        'code',
        'type',
        'min_oder',
        'value',
        'max_discount',
        'quantity',
        'begin_at',
        'end_at',
    ];

    //Lấy tên loai giảm giá
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>DiscountTypeEnum::getDiscountTypeName($attribute['type']),
        );
    }

    //Thiết lập quan hệ giảm giá với giỏ hàng
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
