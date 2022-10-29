<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'Hài hước' => 'in:1',
            'Kinh dị' => 'in:2',
            'Lãng mạn' => 'in:3',
            'Học đường' => 'in:4',
            'Giả tưởng' => 'in:5',
            'Siêu nhiên' => 'in:6',
            'Tâm lý' => 'in:7',
            'Thể thao' => 'in:8',
            'Đời thường' => 'in:9',
            'Hành động' => 'in:10',
            'Phiêu lưu' => 'in:11',
            'Người trưởng thành' => 'in:12',
            'Thanh thiếu niên' => 'in:13',
            'min_price'=>[
                'integer',
                'min:0'
            ],
            'max_price'=>[
                'integer',
                'min:0',
                'gte:min_price'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'min_price'=>'Giá tối tiểu',
            'max_price'=>'Giá tối đa',
        ];
    }
}
