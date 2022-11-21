<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\Cart\AddCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Http\Requests\Discount\ApplyDiscountRequest;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ResponseTrait;
    private User $user;
    private Builder $model;
    private Builder $discount;

    public function __construct()
    {
        //Phải khởi tạo trong này do nếu khởi tạo
        //theo kiểu thông thường thì lúc này middleware chưa chạy
        $this->middleware(function ($request, $next) {
            $this->user= auth()->user()->user;
            $this->model = (new Cart())->query();
            return $next($request);
        });
        $this->discount = (new Discount())->query();
    }

    //Trả vể trang giỏ hàng cùng với thông tin sản phẩm
    //Nếu khách hàng chưa có giỏ hàng thì tạo giỏ hàng
    public function index()
    {
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->firstOrCreate(['user_id' => $this->user->id]);
        $products = $cart->products;
        return view('user.cart', [
            'cart' => $cart,
            'products' => $products,
        ]);
    }

    //Nếu khách hàng chưa có giỏ hàng thì tạo giỏ hàng
    //nếu sản phẩm đã có trong giỏ hàng thì cộng thêm với số lượng sản phẩm trong giỏ hàng
    //nếu không thì thêm sản phẩm vào giỏ hàng,
    public function addToCart(AddCartRequest $request)
    {
        $productID = $request->get('product_id');
        $quantity = $request->get('quantity');
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->firstOrCreate(['user_id' => $this->user->id]);
        if ($cart->products->contains($productID)) {
            $quantityInCart = $cart->products->find($productID)->pivot->quantity;
            $cart->products()->updateExistingPivot($productID, ['quantity' => $quantity + $quantityInCart]);
        } else {
            $cart->products()->attach($productID, ['quantity' => $quantity]);
        }
        return redirect()->back()->with('success', 'Sản phẩm thêm vào giỏ hàng thành công!');
    }

    //Cập nhật số lượng sản phẩm trong giỏ hàng
    //Nếu số lượng sản phẩm trong giỏ hàng bằng 0 thì xóa sản phẩm khỏi giỏ hàng
    //còn không thì cập nhật lại số lượng sản phẩm trong giỏ hàng
    public function updateCart(UpdateCartRequest $request)
    {
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->first();
        foreach ($request->quantity as $index => $quantity) {
            if ($quantity === 0) {
                //xóa sản phẩm khỏi giỏ hàng theo thứ tự dòng trong pivot table của giỏ hàng
                $cart->products()->detach($cart->products[$index]->id);
            } else {
                //cập nhật số lượng sản phẩm theo thứ tự dòng trong pivot table của giỏ hàng
                $cart->products()->updateExistingPivot($cart->products[$index]->id, ['quantity' => $quantity]);
            }
        }
        //kiểm tra xem giỏ hàng có áp dụng mã giảm giá hay không
        //nếu có thì kiểm tra xem tổng tiền giỏ hàng có đủ áp dụng mã giảm giá hay không
        //nếu không đủ thì xóa mã giảm giá khỏi giỏ hàng
        if ($cart->discount && $cart->total_price < $cart->discount->min_order) {
            $cart->discount_id=null;
            $cart->save();
        }
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    //Hàm xóa sản phẩm khỏi giỏ hàng theo api
    public function deleteCart(Request $request)
    {
        $productID = $request->get('product_id');
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->first();
        $cart->products()->detach($productID);
        //kiểm tra xem giỏ hàng có áp dụng mã giảm giá hay không
        //nếu có thì kiểm tra xem tổng tiền giỏ hàng có đủ áp dụng mã giảm giá hay không
        //nếu không đủ thì xóa mã giảm giá khỏi giỏ hàng
        if ($cart->discount && $cart->total_price < $cart->discount->min_order) {
            $cart->discount_id=null;
            $cart->save();
        }
        return response()->json([
            'status' => 200,
        ]);
    }

    //Hàm lấy ra mã giảm giá theo code
    //nếu trong giỏ hàng đã có mã giảm giá thì cập nhật lại mã giảm giá
    //thay discount_id trong giỏ hàng bằng discount_id mới
    //còn không thì thêm discount_id vào giỏ hàng
    public function applyDiscount(ApplyDiscountRequest $request)
    {
        $discountCode = $request->get('code');
        $discount = $this->discount->where('code', $discountCode)->first();
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->first();
        $cart->discount_id = $discount->id;
        $cart->save();
        return $this->successResponse($discount->name, 'Áp dụng mã giảm giá thành công!',200);
    }

    //Hàm xóa mã giảm giá khỏi giỏ hàng
    //Cập nhật lại discount_id trong giỏ hàng bằng null
    public function removeDiscount()
    {
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->first();
        $cart->discount_id = null;
        $cart->save();
        return $this->successResponse(null, 'Xóa mã giảm giá thành công!',200);
    }
}
