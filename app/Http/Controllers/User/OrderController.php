<?php

namespace App\Http\Controllers\User;

use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Enums\Province;
use App\Enums\ShippingFee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    private User $user;
    private Cart $cart;
    private Builder $model;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user()->user;
            $this->cart = $this->user->cart;
            $this->model = (new Order())->query();
            return $next($request);
        });
    }

    //Hiển thị trang thanh toán
    public function checkout()
    {
        $user = $this->user;
        $cart = $this->cart;
        $products = $cart->products;
        $provinces = Province::getArrayView();
        $shipping_fee = ShippingFee::getArray();
        return view('user.checkout',[
            'user' => $user,
            'cart' => $cart,
            'products' => $products,
            'provinces' => $provinces,
            'shipping_fee' => $shipping_fee,
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        $cart = $this->cart;
        $products = $cart->products;
        $total_price = $cart->total_price;
        $discount = $cart->discount;
        //Xử lý phí vận chuyển, value lấu về là string
        $province =(int) $request->get('province');
        if ($province === Province::HANOI || $province === Province::HOCHIMINH) {
            $shipping_fee = ShippingFee::HN_HCM;
        } else {
            $shipping_fee = ShippingFee::OTHER;
        }
        //Ghi vào bảng order
        $order = new Order();
        $order->fill($request->validated());
        $order->user_id = $this->user->id;
        $order->total_discount = $cart->total_discount;
        $order->shipping_fee = $shipping_fee;
        $order->total_price = $total_price + $shipping_fee;
        $order->save();
        //Thêm chi tiết sản phẩm vào bảng order_product
        foreach($products as $product){
            $order->products()->attach($product->id,[
                'quantity' => $product->pivot->quantity,
                'total_price' => $product->price * $product->pivot->quantity,
            ]);
            //Cập nhật lại số lượng sản phẩm
            $product->quantity -= $product->pivot->quantity;
            $product->save();
        }
        //Cập nhật lại số lượng sử dụng của mã giảm giá
        if($discount){
            --$discount->quantity;
            $discount->save();
        }
        //Xóa tất cả trong giỏ hàng
        $cart->products()->detach();
        $cart->discount_id = null;
        $cart->save();
        return Redirect::route('user.profile.info')->with('success','Đặt hàng thành công');
    }

    //Lấy danh sách tất cả đơn hàng của user
    public function index()
    {
        $orders = $this->model->where('user_id', $this->user->id)->orderBy('order_date','DESC')->get();
        return view('user.order',[
            'orders' => $orders,
        ]);
    }

    //Hủy đơn hàng
    public function cancel(Request $request,$orderID)
    {
        $order = $this->model->find($orderID);
        $order->status = OrderStatus::DA_HUY;
        $order->save();
        return redirect()->back()->with('success','Hủy đơn hàng thành công');
    }

    //trả về view chi tiết đơn hàng
    public function show($orderID)
    {
        $order = $this->model->find($orderID);
        $products = $order->products;
        return view('user.show',[
            'order' => $order,
            'products' => $products,
        ]);
    }
}
