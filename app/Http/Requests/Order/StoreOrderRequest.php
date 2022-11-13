<?php

namespace App\Http\Requests\Order;

use App\Enums\AccountRole;
use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Enums\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
        $cart = auth()->user()->user->cart;
        $products = $cart->products;
        $discount = $cart->discount;
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'max:100',
            ],
            'phone' => [
                'bail',
                'required',
                'numeric',
                'digits:10',
            ],
            'address' => [
                'bail',
                'required',
                'string',
            ],
            'province' => [
                'bail',
                'required',
                Rule::in(Province::asArray()),
            ],
            'payment_method' => [
                'bail',
                'required',
                Rule::in(OrderPaymentMethod::asArray()),
                //Kiểm tra xem phương thức thanh toán có phải là COD hay không
                //Nếu là COD kiểm tra xem trong vòng 50 ngày user có
                //các đơn hàng nào được thanh toán COD mà mà có trạng thái đã hủy từ 2 lần trở lên thì báo lỗi
                function ($attribute, $value, $fail) {
                    if ($value === OrderPaymentMethod::COD) {
                        $count = auth()->user()->user->orders()
                            ->where('payment_method', OrderPaymentMethod::COD)
                            ->where('status', OrderStatus::DA_HUY)
                            ->where('order_date', '>=', now()->subDays(50))
                            ->count();
                        if ($count >= 2) {
                            $fail('Không thể thanh toán COD, do bạn đã hủy 2 đơn hàng COD trong vòng 50 ngày qua');
                        }
                    }
                },

                //Các hàm callback tự định nghĩa thêm để kiểm tra các điều kiện khác
                //Kiểm tra mã giảm giá trong giỏ hàng còn lượt sử dụng hay không nếu không thì báo lỗi
                function ($attribute, $value, $fail) use ($discount) {
                    if ($discount->quantity <= 0) {
                        $fail('Mã giảm giá đã hết lượt sử dụng');
                    }
                },

                //Kiểm tra xem mã giảm giá còn hạn sử dụng hay không nếu không thì báo lỗi
                function ($attribute, $value, $fail) use ($discount) {
                    if ($discount->end_at < now()) {
                        $fail('Mã giảm giá đã hết hạn sử dụng');
                    }
                },

                //Kiểm tra đối với từng sản phẩm trong giỏ hàng xem có đủ số lượng để thanh toán hay không
                //nếu không thì báo lỗi và trả về tên sản phẩm và số lượng còn lại của sản phẩm đó
                function ($attribute, $value, $fail) use ($products) {
                    foreach ($products as $product) {
                        if ($product->quantity < $product->pivot->quantity) {
                            $fail('Sản phẩm ' . $product->name . ' chỉ còn ' . $product->quantity . ' sản phẩm');
                        }
                    }
                },
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người nhận',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'province' => 'Tỉnh/Thành phố',
            'payment_method' => 'Phương thức thanh toán',
        ];
    }
}
