<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Article())->query();
    }

    // Hiển thị danh sách bài viết
    public function index(Request $request)
    {
        $search = $request->query->get('q');
        $articles =$this->model
            ->where('title','like','%'.$search.'%')
            ->orWhere('description','like','%'.$search.'%')
            ->paginate(10);

        return view('admin.articles.index',[
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $article=new Article();
        $article->fill($request->validated());
        $article->slug=create_slug($request->get('title'));
        $article->save();
        return redirect()->route('admin.articles.index')->with('success','Thêm bài viết thành công');
    }

    public function edit($id)
    {
        $article = $this->model->findOrFail($id);
        return view('admin.articles.edit',[
            'article' => $article,
        ]);
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = $this->model->findOrFail($id);
        $article->fill($request->validated());
        $article->slug=create_slug($request->get('title'));
        $article->save();
        return redirect()->route('admin.articles.index')->with('success','Cập nhật bài viết thành công');
    }

    public function destroy($id)
    {
        $article = $this->model->findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success','Xóa bài viết thành công');
    }
}
