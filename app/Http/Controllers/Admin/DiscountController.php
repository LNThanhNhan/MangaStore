<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DiscountType;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Http\Requests\Discount\StoreDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DiscountController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Discount())->query();
        View::share('arrDiscountType',DiscountType::getArrayView());
    }

    // Hiển thị danh sách mã giảm giá
    public function index(Request $requests)
    {
        $search = $requests->query->get('q');
        $discounts = $this->model
            ->where('name','like','%'.$search.'%')
            ->orderBy('id','desc')
            ->paginate(10);
        $discounts->appends(['q'=>$search]);
        return view('admin.discounts.index',[
            'discounts' => $discounts,
            'search' => $search,
        ]);
    }

    // Hiển thị form tạo mã giảm giá
    public function create()
    {
        return view('admin.discounts.create');
    }

    // Lưu mã giảm giá vào database
    public function store(StoreDiscountRequest $request)
    {
        $discount = new Discount();
        $discount->fill($request->validated());
        $discount->save();
        return redirect(route('admin.discounts.index'))->with('success','Thêm mã giảm giá thành công');
    }

    public function show(Discount $discount)
    {
        //
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit',[
            'discount' => $discount,
        ]);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->fill($request->validated());
        $discount->save();
        return redirect(route('admin.discounts.index'))->with('success','Cập nhật mã giảm giá thành công');
    }

    public function destroy($discountID)
    {
        $discount =$this->model->find($discountID);
        $discount->delete();
        return redirect(route('admin.discounts.index'))->with('success','Xóa mã giảm giá thành công');
    }
}
