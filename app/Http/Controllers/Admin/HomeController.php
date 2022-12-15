<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $arrCategory = ProductCategory::getArrayView();
        $fromDate=$request->query->get('fromDate');
        $toDate=$request->query->get('toDate');
        $category=$request->query->get('category') ?? $request->query->get('category');
        //Lấy số tài khoản đã đăng ký trong ngày hôm nay
        $userCreatedToday = Account::query()->whereDate('created_at', date('Y-m-d'))->count();
        //Lấy ra doanh thu hôm nay bằng cách lấy ra tổng tiền của các đơn hàng trong ngày hôm nay
        $revenueToday = Order::query()->whereDate('delivery_date', date('Y-m-d'))->sum('total_price');
        //Láy ra số đơn hàng đã đặt trong ngày hôm nay
        $orderCreatedToday = Order::query()->whereDate('created_at', date('Y-m-d'))->count();
        //Lấy ra số sản phẩm có số lượng tồn kho nhỏ hơn 100
        $productQuantity = Product::query()->where('quantity', '<', 100)->count();
        if($category===null){
            $category=0;
        }
        $category=(int)$category;
        //Lấy 10 sản phẩm có doanh thu cao nhất
        //bằng cách lấy tổng total_price của bảng order_product
        //mà có sản phẩm thuộc category_id = $category
        //sắp xếp giảm dần và có order_date nằm trong khoảng từ fromDate đến toDate
        if($category===0 && $toDate!==null && $fromDate!==null){
            $topProducts = DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->select('products.*', DB::raw('SUM(order_product.total_price) as total_price'))
            ->whereBetween('orders.order_date', [$fromDate, $toDate])
            ->groupBy('products.name')
            ->orderBy('total_price', 'desc')
            ->limit(10)
            ->get();
        }
        elseif ($category!==0 && $fromDate!==null && $toDate!==null)
        {
            $topProducts = DB::table('order_product')
                ->join('products', 'products.id', '=', 'order_product.product_id')
                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                ->select('products.*', DB::raw('SUM(order_product.total_price) as total_price'))
                ->where('products.category', '=', $category)
                ->whereBetween('orders.order_date', [$fromDate, $toDate])
                ->groupBy('products.name')
                ->orderBy('total_price', 'desc')
                ->limit(10)
                ->get();
        }
        //nếu fromDate hoặc toDate không có gán giá trị ngày hiện tại
        else if($category===0 && ($fromDate===null|| $toDate===null))
        {
            $topProducts = DB::table('order_product')
                ->join('products', 'products.id', '=', 'order_product.product_id')
                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                ->select('products.*', DB::raw('SUM(order_product.total_price) as total_price'))
                //->where('products.category', '=', $category)
                //->whereBetween('orders.order_date', [$fromDate, $toDate])
                ->groupBy('products.name')
                ->orderBy('total_price', 'desc')
                ->limit(10)
                ->get();
        }
        if($fromDate === null){
            $fromDate = date('Y-m-d');
        }
        if($toDate === null){
            $toDate = date('Y-m-d');
        }
        return view('admin.home.index',[
            'userCreatedToday' => $userCreatedToday,
            'revenueToday' => $revenueToday,
            'orderCreatedToday' => $orderCreatedToday,
            'productQuantity' => $productQuantity,
            'topProducts' => $topProducts,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'category' => $category,
            'arrCategory' => $arrCategory
        ]);
    }
}
