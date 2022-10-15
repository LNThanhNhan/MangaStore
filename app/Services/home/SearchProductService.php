<?php

namespace App\Services\store;
use App\Models\Product;
class SearchProductService
{
    public static function getNewestProducts()
    {
        return Product::query()
            ->skip(0)
            ->take(10)
            ->orderBy('id','desc')
            ->get();
    }

    public static function getSearchProducts($name)
    {

    }
}
