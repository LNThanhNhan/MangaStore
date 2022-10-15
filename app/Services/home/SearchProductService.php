<?php

namespace App\Services\home;
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

    public static function getSearchProducts($search)
    {
        return Product::query()
            ->where('name','like','%'.$search.'%')
            ->orWhere('author','like','%'.$search.'%')
            ->orWhere('collection','like','%'.$search.'%')
            ->paginate(16);
    }
}
