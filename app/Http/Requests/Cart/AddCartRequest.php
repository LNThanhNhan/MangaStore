<?php

namespace App\Http\Requests\Cart;

use App\Enums\AccountRole;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
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

    //Lấy tham số productId từ route và đặt tên cho nó là product_id
    public function prepareForValidation()
    {
        $this->merge([
            'product_id' => $this->route('productId'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => [
                'bail',
                'required',
                'numeric',
                'exists:App\Models\Product,id',
            ],
            'quantity' => [
                'bail',
                'required',
                'numeric',
                'min:1',
                //lấy id sản phẩm từ request để kiểm tra
                //số lượng sản phẩm có đủ để thêm vào giỏ hàng hay không
                function($attribute, $value, $fail){
                    $product_id = $this->request->get('product_id');
                    $product = Product::find($product_id);
                    if($product->quantity < $value){
                        $fail("Số lượng sản phẩm không đủ");
                    }
                },
            ],
        ];
    }

    public function attributes()
    {
        return [
            'quantity' => 'Số lượng',
            'product_id' => 'Sản phẩm',
        ];
    }
}
