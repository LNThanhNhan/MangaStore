<?php

namespace App\Http\Controllers\Home;
use App\Enums\ProductCategory;
use App\Services\home\SearchProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController
{
    public function __construct()
    {
        View::share('arrProductCategory',ProductCategory::getArrayView());
    }

    //Tìm kiếm cho trang chủ
    public function index()
    {
        $products=(new SearchProductService())->getNewestProducts();
        return view('home.index',[
            'products' => $products,
        ]);
    }

    //Tìm kiếm bằng từ khóa
    public function searchProducts(Request $request)
    {
        $search = $request->query->get('q');
        $products=(new SearchProductService())->getSearchProducts($search);
        $products ->appends(['q'=>$search]);
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Điều hướng sang chi tiết sản phẩm
    public function productDetail($slug)
    {
        $product = (new SearchProductService())->getProductBySlug($slug);
        if($product===null) {
            abort(404);
        }
        return view('home.detail',[
            'product' => $product,
        ]);
    }

    //Tìm kiếm theo tác giả
    public function searchByAuthor($slug)
    {
        $products = (new SearchProductService())->getProductByAuthor($slug);
        $search =$products[0]->author;
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Tìm kiếm theo thể loại
    public function searchByCategory($value)
    {
        $products = (new SearchProductService())->getProductByCategory($value);
        $search =ProductCategory::getCategoryName((int)$value);
        $checkValue = $value;
        return view('home.search',[
            'products' => $products,
            'search' => $search,
            'checkValue' => $checkValue,
        ]);
    }
}
