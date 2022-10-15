<?php

namespace App\Http\Controllers\Store;
use App\Services\store\SearchProductService;
class StoreController
{
    public function index()
    {
        $products=SearchProductService::getNewestProducts();
        return view('store.index',[
            'products' => $products,
        ]);
    }
}
