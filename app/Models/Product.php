<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class Product extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected  $fillable=[
        'name',
        'description',
        'image_uuid',
        'image',
        'category',
        'author',
        'list_price',
        'discount_rate',
        'quantity',
        'publish_year',
        'size',
        'category',
        'collection',
    ];

    protected function categoryName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>ProductCategory::getCategoryName($attribute['category']),
        );
    }

    protected function listPriceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($attribute['list_price']).'đ',
        );
    }

    protected function priceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($attribute['price']).'đ',
        );
    }

    //thiết lập quan hệ 1-n với bảng pivot cart_product
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    //thiết lập quan hệ 1-n với bảng pivot order_product
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'total_price');
    }
}
