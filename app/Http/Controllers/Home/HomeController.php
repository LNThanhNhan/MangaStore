<?php

namespace App\Http\Controllers\Home;
use App\Enums\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\FilterRequest;
use App\Models\Article;
use App\Models\Product;
use App\Services\home\SearchProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        View::share('arrProductCategory',ProductCategory::getArrayView());
    }

    //Tìm kiếm cho trang chủ
    public function index()
    {
        $products=(new SearchProductService())->getNewestProducts();
        $articles=Article::orderBy('created_at','desc')->limit(3)->get();
        return view('home.index',[
            'products' => $products,
            'articles' => $articles
        ]);
    }

    //Tìm kiếm bằng từ khóa
    public function searchProducts(Request $request)
    {
        $search = $request->query->get('q');
        if($search === null){
            $search = '';
        }
        $products=(new SearchProductService())->getSearchProducts($search);
        $products ->appends(['q'=>$search]);
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Điều hướng sang chi tiết sản phẩm
    public function productDetail($slug)
    {
        $product = (new SearchProductService())->getProductBySlug($slug);
        if($product===null) {
            abort(404);
        }
        //Lấy ra 3 sản phẩm có cùng tác giả
        $sameAuthor=Product::where('author',$product->author)->where('id','<>',$product->id)->limit(3)->get();
        //Lấy ra 5 sản phẩm có cùng thể loại
        $sameCategory=Product::where('category',$product->category)->where('id','<>',$product->id)->limit(5)->get();
        return view('home.detail',[
            'product' => $product,
            'sameAuthor' => $sameAuthor,
            'sameCategory' => $sameCategory
        ]);
    }

    //Tìm kiếm theo tác giả
    public function searchByAuthor($slug)
    {
        $products = (new SearchProductService())->getProductByAuthor($slug);
        $search =$products[0]->author;
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Tìm kiếm theo thể loại và giá
    public function searchByFilter(FilterRequest $request)
    {
        $products = (new SearchProductService())->getProductByFilter($request->query->all())->withQueryString();
        $search ='';
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Tìm kiếm theo bộ truyện
    public function searchByCollection($slug)
    {
        $products = (new SearchProductService())->getProductByCollection($slug);
        $search =$products[0]->collection;
        return view('home.search',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    //Trả về trang bài viết với tham số là slug của bài viết
    public function articleDetail($slug)
    {
        $article = Article::query()->where('slug',$slug)->first();
        //Lấy thêm 3 bài viết mới nhất
        $newestArticles = Article::orderBy('created_at','desc')->limit(3)->get();
        if($article===null) {
            abort(404);
        }
        return view('home.article.detail',[
            'article' => $article,
            'newestArticles' => $newestArticles,
        ]);
    }

    //Lấy ra danh sách tất cả sản phẩm có collection khác null
    //và sắp xếp theo tên collection và id sản phẩm giảm dần
    public function getAllCollection()
    {
        $products = Product::query()->whereNotNull('collection')
            ->orderBy('collection','desc')
            ->orderBy('id','desc')->paginate(12);
        return view('home.search',[
            'products' => $products,
        ]);
    }

    //Lấy ra danh sách sản phẩm có số lượng truyện > 0
    //và sắp xếp theo discount giảm dần
    public function getHotDeal()
    {
        $products = Product::query()
            ->where('quantity','>',0)
            ->orderBy('discount_rate','desc')
            ->paginate(12);
        return view('home.search',[
            'products' => $products,
        ]);
    }

    //Lấy ra danh sách bài viết mới nhất
    public function getArticles()
    {
        $articles = Article::query()->orderBy('created_at','desc')->paginate(3);
        $newestArticles = Article::orderBy('created_at','desc')->limit(3)->get();
        return view('home.article.index',[
            'articles' => $articles,
            'newestArticles' => $newestArticles,
        ]);
    }
}
