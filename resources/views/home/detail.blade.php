@extends('layout.master')
@section('content')
<h1>{{$product->name}}</h1>
<img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="250" height="300">
<p>{{ $product->description }}</p>
<p>{{$product->price_VND}}</p>
<form action="{{ route('user.cart.add') }}" method="POST">
    @csrf
    <label> Số lượng:</label>
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}"> <br>
    <button type="submit">Thêm vào giỏ hàng</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>Tác giả</p>
<a href="{{ route('home.author',$product->author_slug)}}">{{$product->author}}</a>
<p>Thể loại</p>
<p>{{$product->category_name}}</p>
<a href="{{route('home.collection',$product->collection_slug)}}">{{$product->collection}}</a>
@endsection
