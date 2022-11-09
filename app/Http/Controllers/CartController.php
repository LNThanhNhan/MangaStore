<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCartRequest;
use App\Http\Requests\Cart\DeleteProductInCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private User $user;
    private Builder $model;
    public function __construct()
    {
        //Phải khởi tạo trong này do nếu khởi tạo
        //theo kiểu thông thường thì lúc này middleware chưa chạy
        $this->middleware(function ($request, $next) {
            $this->user= auth()->user()->user;
            $this->model = (new Cart())->query();
            return $next($request);
        });
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
        return redirect()->back()->with('success', 'Product added to cart successfully!');
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
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    //Hàm xóa sản phẩm khỏi giỏ hàng theo api
    public function deleteCart(DeleteProductInCartRequest $request)
    {
        $productID = $request->get('product_id');
        $cart = $this->model
            ->where('user_id',$this->user->id)
            ->first();
        $cart->products()->detach($productID);
        return response()->json([
            'status' => 200,
        ]);
    }
}
