<?php

namespace App\Services\home;
use App\Enums\ProductCategory;
use App\Http\Requests\Home\FilterRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SearchProductService
{
    private Builder $products;
    public function __construct()
    {
        $this->products = (new Product())->query();
    }
    public  function getNewestProducts(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->products
            ->skip(0)
            ->take(10)
            ->orderBy('id','desc')
            ->get();
    }

    public function getSearchProducts($search): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->products
            ->where('name','like','%'.$search.'%')
            ->orWhere('collection','like','%'.$search.'%')
            ->paginate(16);
    }

    public function getProductBySlug($slug)
    {
        return $this->products
            ->where('slug',$slug)
            ->first();
    }

    public function getProductByAuthor($slug)
    {
        return $this->products
            ->where('author_slug',$slug)
            ->paginate(16);
    }

    public function getProductByFilter($array)
    {
            $category=[];
            $min=0;
            $max=$this->products->max('price');
            foreach ($array as $key => $value) {
                //Do khi truyền vào thanh địa chỉ dấu cách sẽ tự động chuyể thành gạch chân
                //nên ta thay lại bằng dấu cách và kiểm tra xem thể loại truyện có nằm trong mảng không
                if(in_array(str_replace('_',' ',$key),ProductCategory::ARRAY_NAME,true)) {
                    $category[]=$value;
                }
                if($key === 'min_price'&& $value !== null) {
                    $min= $value;
                }
                if($key === 'max_price'&& $value !== null) {
                    $max= $value;
                }
            }
            if(!count($category)){
                return $this->products
                    ->WhereBetween('price',[$min,$max])
                    ->paginate(16);
            }
            return $this->products
                    ->whereIn('category', $category)
                    ->WhereBetween('price',[$min,$max])
                    ->paginate(16);
    }
}
