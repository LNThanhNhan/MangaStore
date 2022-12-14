<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->query->get('fromDate');
        $toDate = $request->query->get('toDate');
        $category = $request->query->get('category');
        //nếu fromDate hoặc toDate không có gán giá trị ngày hiện tại
        if($fromDate === null){
            $fromDate = date('Y-m-d');
        }
        if($toDate === null){
            $toDate = date('Y-m-d');
        }
        //Lấy 10 sản phẩm có doanh thu cao nhất
        //bằng cách lấy tổng total_price của bảng order_product
        //mà có sản phẩm thuộc category_id = $category
        //sắp xếp giảm dần và có order_date nằm trong khoảng từ fromDate đến toDate
        $topProducts = DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->select('products.name', DB::raw('SUM(order_product.total_price) as total_price'))
            ->where('products.category', '=', $category)
            ->whereBetween('orders.order_date', [$fromDate, $toDate])
            ->groupBy('products.name')
            ->orderBy('total_price', 'desc')
            ->limit(10)
            ->get();


        return view('home.dashboard');
    }
}
