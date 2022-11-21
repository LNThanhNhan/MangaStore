@extends('layout.master')
@section('layout')
@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.discounts.update',$discount) }}" method="POST">
    @csrf
    @method('PUT')
    Tên mã giảm giá
    <input type="text" name="name" id="" value="{{ $discount->name  }}">
    <br>
    Mã giảm giá
    <input type="text" name="code" id="" value="{{ $discount->code }}">
    <br>
    Loại mã giảm giá
    <select name="type">
        <option value="">Chọn loại giảm giá</option>
        <option value=0 selected>Giảm theo phần trăm</option>
        <option value=1
                @if($discount->type===1)
                    selected
                @endif>Giảm theo số tiền</option>
            >Giảm theo số tiền</option>
    </select>
    <br>
    Giá trị
    <input type="number" name="value" id="" value="{{ $discount->value }}">
    <br>
    Đơn hàng tối thiểu
    <input type="number" name="min_order" id="" value="{{ $discount->min_order }}">
    <br>
    Giảm giá tối đa
    <input type="number" name="max_discount" id="" value="{{ $discount->max_discount }}">
    <br>
    Số lượng
    <input type="number" name="quantity" id="" value="{{ $discount->quantity }}">
    <br>
    Thời gian bắt đầu
    <input type="datetime-local" name="begin_at" id="" value="{{ $discount->begin_at }}">
    <br>
    Thời gian kết thúc
    <input type="datetime-local" name="end_at" id="" value="{{ $discount->end_at }}">
    <br>
    <input type="submit" value="Sửa">
</form>
@endsection
