<?php

namespace App\Http\Requests\Discount;

use App\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        /*
        trả về mảng key value với value theo dạng mảng
        ngày kết thúc phải lớn hơn ngày bắt đầu
        ngày bắt đầu và ngày kết thúc định dạng là dd/mm/yyyy hh:mm:ss
        nếu kiểu là phần trăm thì giá trị phải từ 0 đến 100
        nếu kiểu là giá trị thì giá trị phải lớn hơn 0
        và đơn hàng tối thiểu phải nhỏ hơn giảm giá tối đa
        */
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('discounts','code'),
            ],
            'type' => [
                'required',
                Rule::in(DiscountType::asArray()),
            ],
            'min_order' => [
                'required',
                'integer',
                'min:0',
            ],
            'value' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ((int)$this->type === DiscountType::PHAN_TRAM) {
                        if ($value < 0 || $value > 100) {
                            $fail('Giảm theo phần trăm phải từ 0 đến 100');
                        }
                    }
                },
                function ($attribute, $value, $fail) {
                    if ($this->min_order < $value && (int)$this->type === DiscountType::SO_TIEN) {
                        $fail('Đơn hàng tối thiểu phải nhỏ hơn giảm giá tối đa');
                    }
                },
            ],
            'max_discount' => [
                'required',
                'integer',
                'min:0',

                function ($attribute, $value, $fail) {
                    if ($this->min_order < $value) {
                        $fail('Đơn hàng tối thiểu phải nhỏ hơn giảm giá tối đa');
                    }
                },
            ],
            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],
            'begin_at' => [
                'required',
                'date_format:Y-m-d\\TH:i',
            ],
            'end_at' => [
                'required',
                'date_format:Y-m-d\\TH:i',
                function ($attribute, $value, $fail) {
                    if (strtotime($this->begin_at) > strtotime($value)) {
                        $fail('Ngày kết thúc phải lớn hơn ngày bắt đầu');
                    }
                },
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên mã giảm giá',
            'code' => 'Mã giảm giá',
            'type' => 'Loại giảm giá',
            'min_oder' => 'Đơn hàng tối thiểu',
            'value' => 'Giá trị',
            'max_discount' => 'Giá trị giảm tối đa',
            'quantity' => 'Số lượng',
            'begin_at' => 'Ngày bắt đầu',
            'end_at' => 'Ngày kết thúc',
        ];
    }

}
