<?php

namespace App\Http\Requests\Cart;

use App\Enums\AccountRole;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role===AccountRole::USER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //đưa vào mảng quantity với key là index và value là số lượng sản phẩm
            //ví dụ: quantity[0] = 1, quantity[1] = 2, quantity[2] = 3
            //kiểm tra đối với từng sản phẩm trong giỏ hàng
            //số lượng sản phẩm có đủ để thêm vào giỏ hàng hay không
            'quantity.*' => [
                'bail',
                'required',
                'numeric',
                'min:0',

                //Hàm callback kiểm tra số lượng sản phẩm của từng sản phẩm có đủ để thêm vào giỏ hàng hay không
                function($attribute, $value, $fail){
                    $cart = auth()->user()->user->cart;
                    //Đoạn bên dưới sẽ cắt chuỗi attribute để lấy ra index của sản phẩm
                    //ví dụ: quantity.0 sẽ lấy ra được 0
                    $index = explode('.', $attribute)[1];
                    $product = $cart->products[$index];
                    if($product->quantity < $value){
                        $fail("Số lượng sản phẩm tồn kho ở hàng ".(int)$index+1 ." không đủ");
                    }
                },
            ],
        ];
    }
}
