<?php

namespace App\Http\Requests\Order;

use App\Enums\AccountRole;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class CancelOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!auth()->check()) {
            return false;
        }
        $orderID=$this->route('orderId');
        $order=auth()->user()->user->orders()->find($orderID);
        return auth()->user()->role === AccountRole::ADMIN || auth()->user()->user->id === $order->user_id;
    }

    //Lấy tham số orderId từ route và đặt tên cho nó là product_id
    public function prepareForValidation()
    {
        $this->merge([
            'order_id' => $this->route('orderId'),
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
            'order_id' => [
                'bail',
                'required',
                'exists:App\Models\Order,id',
                //Kiểm tra xem trạng thái đơn hàng có phải là đang chờ xác nhận hay không
                //Nếu không thì không cho hủy đơn hàng
                function($attribute, $value, $fail){
                    $order = Order::find($value);
                    if($order->status !== OrderStatus::CHO_XAC_NHAN){
                        $fail("Không thể hủy đơn hàng");
                    }
                },
            ],
        ];
    }
}
