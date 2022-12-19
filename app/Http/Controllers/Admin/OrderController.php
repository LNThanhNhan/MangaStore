<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Enums\Province;
use App\Enums\ShippingFee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Account;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = (new Order())->query();
    }

    //Hàm trả về view index của tất cả order trong hệ thống
    public function index(Request $request)
    {
        $search = $request->query->get('q');
        //tìm kiểm đơn hàng bằng email, số điện thoại hay id trong bảng order
        $orders = $this->model
            //->where('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('id',  $search )
            ->orderBy('order_date', 'desc')
            ->paginate(10);

        //Append dùng để thêm vào phần tìm kiếm
        //nếu không thì khi sang trang sẽ bị mất
        $orders ->appends(['q'=>$search]);
        return view('admin.orders.index',[
            'orders' => $orders,
            'search' => $search,
        ]);
    }

    //Hàm trả về view chi tiết của 1 order
    public function edit($orderID)
    {
        $order = $this->model->where('id',$orderID)->first();
        $orderStatus= OrderStatus::getArray();
        //lấy ra thông tin của từng sản phẩm từ bảng product qua bảng order_product
        //cùng với thông tin quantity, total price trong order_product
        $products = $order->products;
        return view('admin.orders.edit', [
            'order' => $order,
            'orderStatus' => $orderStatus,
            'products' => $products,
        ]);
    }

    //Hàm xử lý cập nhật thông tin của 1 order và trả về view index
    public function update(Request $request,$orderID)
    {
        $order = $this->model->where('id',$orderID)->first();
        $order->status = $request->get('status');
        if((int)$request->get('status') === OrderStatus::DA_GIAO_HANG){
            //Cập nhật delivery_date là giờ hiện tại
            $order->delivery_date = date('Y-m-d H:i:s');
        }
        $order->save();
        return redirect()->route('admin.orders.index')->with('success','Cập nhật trạng thái đơn hàng thành công');
    }
}
