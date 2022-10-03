<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
include(app_path().'/Customs/create_slug.php');

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        //do chưa làm tính năng đăng nhập
        //nên để true trước đã
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
            'name' =>[
                'bail',
                'required',
                'string',
                'unique:App\Models\Product,name',
                //Hàm kiểm tra slug có trùng hay không
                function($attribute, $value,$fail){
                    if(null !== Product::query()->where('slug',create_slug($value))) {
                        $fail("Tên truyện đã được sử dụng");
                    }
                },
            ],
            'description' =>[
                'bail',
                'required',
                'string',
            ],
            'image' =>[
                'bail',
                'required',
                'active_url',
            ],
            'author' =>[
                'bail',
                'required',
                'string',
            ],
            'price' =>[
                'bail',
                'required',
                'integer',
                'min:0',
            ],
            'quantity' =>[
                'bail',
                'required',
                'integer',
                'min:0',
            ],
            'size'=>[
                'bail',
                'required',
                'string',
            ],
            'publish_year' =>[
                'bail',
                'required',
                'integer',
                'min:1970',
                'max:2155',
            ],
            'category' =>['required'],
            'collection' =>[
                'bail',
                'string',
                'nullable',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array The error messages
     **/
    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique' => ':attribute đã được sử dụng',
            'strings' => ':attribute phải là chuỗi ký tự',
            'integer' => ':attribute phải là số nguyên',
            'active_url' => ':attribute phải là đường link URL',
            'min' => ':attribute phải lớn hơn :min',
            'max' => ':attribute phải nhỏ hơn :max',
        ];
    }

    /**
     * Get custom messages for the defined validation rules.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Tên truyện',
            'description'=>'Phần mô tả',
            'image' => 'Ảnh sản phẩm',
            'author' => 'Tên tác giả',
            'price' => 'Giá',
            'quantity' => 'Số lượng tồn',
            'size' => 'Kích thước',
            'publish_year' =>'Năm xuất bản',
            'category' => 'Thể loại',
        ];
    }
}
