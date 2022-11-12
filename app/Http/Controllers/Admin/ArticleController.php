<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
include(app_path().'/Customs/create_slug.php');

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->get();
        return view('articles.index',[
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article=new Article();
        $article->title = $request->get('title');
        $article->slug=create_slug($request->get('title'));
        $article->content = $request->get('content');
        $article->thumbnail = $request->get('thumbnail');
        $article->date = $request->get('created');
        $article->save();
    }
}
