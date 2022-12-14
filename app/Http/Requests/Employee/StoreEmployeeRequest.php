<?php

namespace App\Http\Requests\Employee;

use App\Enums\AccountRole;
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
            'role' => [
                'required',
                Rule::in(AccountRole::ADMIN, AccountRole::EMPLOYEE),
            ],
        ];
    }

    public function attributes() {
        return [
            'username' => 'T??n ????ng nh???p',
            'password' => 'M???t kh???u',
            'email' => 'Email',
            'name' => 'H??? t??n',
            'birthday' => 'Ng??y sinh',
            'gender' => 'Gi???i t??nh',
            'phone' => 'S??? ??i???n tho???i',
            'address' => '?????a ch???',
            'province' => 'T???nh/th??nh ph???',
            'salary' => 'L????ng',
            'role' => 'Ch???c v???',
        ];
    }
}
