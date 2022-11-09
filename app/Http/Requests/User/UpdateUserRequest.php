<?php

namespace App\Http\Requests\User;

use App\Enums\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('accounts', 'email')->ignore(auth()->user()->id, 'id'),
                //'unique:App\Models\Account,email',
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'gender'=>[
                'bail',
                'nullable',
                Rule::in([0,1]),
            ],
            'phone' => [
                'bail',
                'nullable',
                'numeric',
                'digits:10',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'province' => [
                'bail',
                Rule::in(array_merge(Province::getValues(),[0])),
            ]
        ];
        if($this->request->has('new_password')){
            $rules['old_password'] = [
                'required',
                'string',
                'min:8',
                'max:100',
                function($attribute, $value, $fail){
                    if(!Hash::check($value, auth()->user()->password)){
                        $fail('Mật khẩu cũ không đúng');
                    }
                },
            ];
            $rules['new_password'] = [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ];
        }
        return $rules;
    }

    public function attribute(): array
    {
        return [
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'name' => 'Tên người dùng',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'province' => 'Tỉnh/Thành phố',
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
        ];
    }
}
