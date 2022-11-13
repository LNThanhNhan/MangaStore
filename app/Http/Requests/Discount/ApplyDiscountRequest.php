<?php

namespace App\Http\Requests\Discount;

use App\Enums\AccountRole;
use App\Models\Account;
use App\Models\Cart;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyDiscountRequest extends FormRequest
{
    private Cart $cart;
    private Builder $queryDiscount;
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
        $cart= auth()->user()->user->cart;
        $queryDiscount=(new Discount())->query();
        return [
            'code' => [
                'bail',
                'required',
                'string',
                'max:255',
                //Kiểm tra xem mã giảm giá có tồn tại hay không
                Rule::exists($queryDiscount->getModel()->getTable(), 'code'),

                //Hàm callback lấy ra mã giảm giá có code trùng với code trong request
                //rồi sau đó kiểm tra nếu thời gian hiện tại nhỏ hơn thời gian băt đầu của mã giảm giá thì báo lỗi
                function ($attribute, $value, $fail) use ($queryDiscount) {
                    $discount = $queryDiscount->where('code', $value)->first();
                    if ($discount->begin_at > now()) {
                        $fail('Mã giảm giá chưa bắt đầu');
                    }
                },

                //Hàm callback lấy ra mã giảm giá có code trùng với code trong request
                //rồi sau đó kiểm tra nếu thời gian hiện tại lớn hơn thời gian kết thúc của mã giảm giá thì báo lỗi
                function ($attribute, $value, $fail) use ($queryDiscount) {
                    $discount = $queryDiscount->where('code', $value)->first();
                    if ($discount->end_at < now()) {
                        $fail('Mã giảm giá đã hết hạn');
                    }
                },

                //Hàm callback lấy ra mã giảm giá có code trùng với code trong request
                //rồi sau đó kiểm tra nếu số lượng mã giảm giá đã hết thì báo lỗi
                function ($attribute, $value, $fail) use ($queryDiscount) {
                    $discount = $queryDiscount->where('code', $value)->first();
                    if ($discount->quantity <= 0) {
                        $fail('Mã giảm giá đã hết lượt sử dụng');
                    }
                },

                //Hàm callback lấy ra mã giảm giá có code trùng với code trong request
                //rồi sau đó kiểm tra nếu tổng giá trị giỏ hàng nhỏ hơn giá trị tối thiểu của mã giảm giá thì báo lỗi
                function ($attribute, $value, $fail) use ($queryDiscount, $cart) {
                    $discount = $queryDiscount->where('code', $value)->first();
                    if ($cart->total_price < $discount->min_price) {
                        $fail('Tổng giá trị trong giỏ hàng không đủ để sử dụng mã giảm giá');
                    }
                },
            ]
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'mã giảm giá',
        ];
    }
}
