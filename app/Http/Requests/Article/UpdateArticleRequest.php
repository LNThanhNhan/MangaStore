<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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

    //Lấy ra article id từ route và merge vào request để thực hiện prepareForValidation
    public function prepareForValidation()
    {
        $this->merge([
            'articleId' => $this->route('articleId'),
        ]);
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
                Rule::unique(Article::class)->ignore($this->articleId),
                //Làm hàm callback kiểm tra bằng cách lấy title từ request rồi tạo slug
                //kiểm tra xem slug có bị trùng không nếu là trùng id của bài viết hiện tại thì không báo lỗi
                //còn nếu là trùng id của bài viết khác thì báo lỗi
                function ($attribute, $value, $fail) {
                    $slug = create_slug($value);
                    $article = Article::query()->where('slug', $slug)->first();
                    if ($article && $article->id !== (int)$this->articleId) {
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
