<?php

namespace App\Services\home;
use App\Enums\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
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
            ->where('slug',$slug)->first();
    }

    public function getProductByAuthor($slug)
    {
        return $this->products
            ->where('author_slug',$slug)->get();
    }

    public function getProductByCategory($value)
    {
        return $this->products
            ->where('category',$value)->get();
    }
}
