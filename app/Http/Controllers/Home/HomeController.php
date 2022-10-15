<?php

namespace App\Http\Controllers\Home;
use App\Services\home\SearchProductService;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $products=SearchProductService::getNewestProducts();
        return view('home.index',[
            'products' => $products,
        ]);
    }

    public function searchProducts(Request $request,$slug ='')
    {
        $search = $request->query->get('q');
        $products=SearchProductService::getSearchProducts($search);
        $products ->appends(['q'=>$search]);
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }
}
