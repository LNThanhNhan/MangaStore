@extends('layout.master')
@section('content')
@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.discounts.store') }}" method="POST">
    @csrf
    Tên mã giảm giá
    <input type="text" name="name" id="" value="{{ old('name') }}">
    <br>
    Mã giảm giá
    <input type="text" name="code" id="" value="{{ old('code') }}">
    <br>
    Loại mã giảm giá
    <select name="type">
        <option value="">Chọn loại giảm giá</option>
        <option value="0">Giảm theo phần trăm</option>
        <option value="1">Giảm theo số tiền</option>
    </select>
    <br>
    Giá trị
    <input type="number" name="value" id="" value="{{ old('value') }}">
    <br>
    Đơn hàng tối thiểu
    <input type="number" name="min_order" id="" value="{{ old('min_price') }}">
    <br>
    Giảm giá tối đa
    <input type="number" name="max_discount" id="" value="{{ old('max_discount') }}">
    Số lượng
    <input type="number" name="quantity" id="" value="{{ old('quantity') }}">
    <br>
    Thời gian bắt đầu
    <input type="datetime-local" name="begin_at" id="" value="{{ old('begin_at') }}">
    <br>
    Thời gian kết thúc
    <input type="datetime-local" name="end_at" id="" value="{{ old('end_at') }}">
    <br>
    <input type="submit" value="Thêm">
</form>
@endsection
