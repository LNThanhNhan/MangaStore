<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductCategory;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
                //nếu tên cột khác name trong input
                //thì thêm , và truyền tham số vào unique()
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'description' => [
                'bail',
                'required',
                'string',
            ],
            'image' => [
                'bail',
                'required',
                'image',
            ],
            'author' => [
                'required',
                'string',
            ],
            'list_price' =>[
                'bail',
                'required',
                'integer',
                'min:0',
            ],
            'discount_rate' =>[
                'bail',
                'required',
                'integer',
                'min:0',
                'max:100',
            ],
            'quantity' => [
                'bail',
                'required',
                'integer',
                'min:0',
            ],
            'size' => [
                'bail',
                'required',
                'string',
            ],
            'publish_year' => [
                'bail',
                'required',
                'integer',
                'min:1970',
                'max:2155',
            ],
            'category' => [
                'required',
                Rule::in(ProductCategory::asArray()),
            ],
            'collection' => [
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
            'min'=>':attribute phải lớn hơn :min',
            'max'=>':attribute phải nhỏ hơn :max',
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
            'list_price' => 'Giá niêm yết',
            'discount_rate' => 'Chiết khấu',
            'quantity' => 'Số lượng tồn',
            'size' => 'Kích thước',
            'publish_year' =>'Năm xuất bản',
            'category' => 'Thể loại',
        ];
    }
}
