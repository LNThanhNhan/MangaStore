<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

include(app_path().'/Customs/create_slug.php');

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query->get('q');
        $products =Product::query()
            ->where('name','like','%'.$search.'%')
            ->orWhere('author','like','%'.$search.'%')
            ->paginate(1);

        //Append dùng để thêm vào phần tìm kiếm
        //nếu không thì khi sang trang sẽ bị mất
        $products ->appends(['q'=>$search]);
        return view('admin.products.index',[
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreRequest $request)
    {
        $product = new Product();
        $product->fill($request->validated());
        $product->slug=create_slug($request->get('name'));
        $product->author_slug=create_slug($request->get('author'));
        $product->collection_slug=create_slug($request->get('collection'));
        $product->category_slug=create_slug($request->get('category'));
        $product->save();
        return redirect(route('products.index'));
    }

    public function show(Product $product)
    {
        //
    }

     // Laravel tự động hỗ trợ việc tìm product trong route
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->slug=create_slug($request->get('name'));
        $product->author_slug=create_slug($request->get('author'));
        $product->collection_slug=create_slug($request->get('collection'));
        $product->category_slug=create_slug($request->get('category'));
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     *  1) Khi để theo kiểu đối tượng thì sẽ được kiểm tra
     *  trước là trong table có tồn tại dòng đó không
     *  nếu không thì sẽ báo lỗi 404
     *
     *  2) Nên có thêm validate cho product
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
