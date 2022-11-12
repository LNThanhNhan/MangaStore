<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Product())->query();
        View::share('arrProductCategory',ProductCategory::getArrayView());
    }

    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        $search = $request->query->get('q');
        $products =$this->model
            ->where('name','like','%'.$search.'%')
            ->orWhere('author','like','%'.$search.'%')
            ->paginate(10);

        //Append dùng để thêm vào phần tìm kiếm
        //nếu không thì khi sang trang sẽ bị mất
        $products ->appends(['q'=>$search]);
        return view('admin.products.index',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    // Hiển thị form tạo sản phẩm
    public function create()
    {
        return view('admin.products.create');
    }

    // Lưu sản phẩm vào database
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->validated());
        $product->slug=create_slug($request->get('name'));
        $product->author_slug=create_slug($request->get('author'));
        $product->collection_slug=create_slug($request->get('collection'));
        //ceil dùng để làm tròn lên
        $product->price=ceil($request->get('list_price') - ($request->get('list_price') * ($request->get('discount_rate')/100)));
        $product->save();
        return redirect(route('admin.products.index'));
    }

     // Laravel tự động hỗ trợ việc tìm product trong route
    // Vì vậy ta không cần phải tìm product trong controller
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
        ]);
    }

    // Cập nhật sản phẩm vào database
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->slug=create_slug($request->get('name'));
        $product->author_slug=create_slug($request->get('author'));
        $product->collection_slug=create_slug($request->get('collection'));
        $product->price=ceil($request->get('list_price') - ($request->get('list_price') * ($request->get('discount_rate')/100)));
        $product->save();
        return redirect()->route('admin.products.index');
    }

    /**
     *  1) Khi để theo kiểu đối tượng thì sẽ được kiểm tra
     *  trước là trong table có tồn tại dòng đó không
     *  nếu không thì sẽ báo lỗi 404
     *
     *  2) Nên có thêm validate cho product
     */
    public function destroy($productId)
    {
        $this->model->find($productId)->delete();
        return redirect()->route('admin.products.index');
    }
}
