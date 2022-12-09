<?php

namespace App\Http\Requests\Employee;

use App\Enums\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'email' => [
               'required',
               'string',
                'unique:accounts,email',
                'email',
                'max:255',
            ],
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
                'boolean',
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
        ];
    }

    public function attributes() {
        return [
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'name' => 'Họ tên',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'province' => 'Tỉnh/thành phố',
            'salary' => 'Lươngp',
        ];
    }
}
