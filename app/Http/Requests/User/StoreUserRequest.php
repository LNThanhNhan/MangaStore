<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class StoreUserRequest extends FormRequest
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
            'username' =>
                [
                    'required',
                    'string',
                    'max:100'
                ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:App\Models\Account,email'
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'gender'=>[
                'bail',
                'required',
                Rule::in([0,1]),
            ]
        ];
    }

    public function attribute(): array
    {
        return [
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'name' => 'Tên người dùng',
            'gender' => 'Giới tính',
        ];
    }
}
