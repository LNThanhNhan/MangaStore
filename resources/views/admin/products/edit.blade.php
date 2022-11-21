@extends('layout.master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.products.update',$product)}}" method="post" >
    @csrf
    @method('put')
    Tên truyện
    <input type="text" name="name" id="" value="{{$product->name}}">
    <br>
    Mô tả
    <textarea name="description" id="" cols="50" rows="20" >{{$product->description}}</textarea>
    <br>
    Ảnh sản phẩm <input type="text" name="image" id="" value="{{$product->image}}">
    <br>
    <img src="{{$product->image}}" alt="ảnh sản phẩm" width="100" height="150">
    <br>
    Tác giả
    <input type="text" name="author" id="" value="{{$product->author}}">
    <br>
    Giá niêm yết
    <input type="number" name="list_price" value="{{$product->list_price}}" id="">
    <br>
    Chiết khấu
    <input type="number" name="discount_rate" id="" value="{{$product->discount_rate}}">
    <br>
    Số lượng tồn
    <input type="number" name="quantity" id="" value="{{$product->quantity}}">
    <br>
    Kích thước
    <input type="text" name="size" id="" value="{{$product->size}}">
    <br>
    Năm xuất bản
    <input type="number" name="publish_year" id="" value="{{$product->publish_year}}">
    <br>
    Thể loại
    <select name="category">
        @foreach($arrProductCategory as $key => $value)
            <option value="{{$value}}">{{$key}}</option>
        @endforeach
    </select>
    <br>
    Bộ truyện
    <input type="text" name="collection" id="" value="{{$product->collection}}">
    <br>
    <input type="submit" value="Thay đổi" >
</form>
@endsection
