<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductCategory;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class Product extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected  $fillable=[
        'name',
        'description',
        'image',
        'category',
        'author',
        'price',
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

    protected function priceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($attribute['price']).'đ',
        );
    }
}
