<?php

namespace App\Http\Requests\Employee;

use App\Enums\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'birthday' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                Rule::in(0,1),
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:10'
            ],
            'address' => [
                'required',
                'string',
            ],
            'province' => [
                'required',
                'string',
                Rule::in(Province::asArray()),
            ],
            'salary' => [
                'required',
                'numeric',
                'min:3000000',
            ],
            'status' => [
                'required',
                Rule::in(0,1),
            ],
        ];
    }

    public function attributes() {
        return [
            'name' => 'Họ tên',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'province' => 'Tỉnh/thành phố',
            'salary' => 'Lương',
            'status' => 'Trạng thái làm việc',
        ];
    }
}
