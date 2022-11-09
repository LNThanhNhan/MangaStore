<?php

namespace App\Models;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //set relationship with cart_product belongs to product
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    //make attribute total price of cart
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>
                $this->products->sum(fn($product)=>$product->price * $product->pivot->quantity),
        );
    }

    //make attribute total price of cart in VND
    protected function totalPriceVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($this->totalPrice).' đ',
        );
    }
}
