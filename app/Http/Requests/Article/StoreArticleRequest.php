<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => [
                'bail',
                'required',
                'string',
                'max:255',
                'unique:articles,title',
                //Làm hàm callback kiểm tra bằng cách lấy title từ request rồi tạo slug
                //kiểm tra xem slug có bị trùng không nếu có báo lỗi
                function ($attribute, $value, $fail) {
                    $slug = create_slug($value);
                    if (Article::query()->where('slug', $slug)->exists()) {
                        $fail('Slug tạo ra từ tiêu đề bài viết đã tồn tại');
                    }
                },
            ],
            'image' => [
                'bail',
                'required',
                'active_url',
            ],
            'description' => [
                'bail',
                'required',
                'string',
            ],
            'content' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Link ảnh bài viết',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
        ];
    }
}
