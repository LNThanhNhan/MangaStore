@extends('layout.master')
@section('content')
<h1>Quản lý danh sách truyện tranh</h1>
<a class="btn btn-success" href="{{route('admin.products.create')}}">Thêm</a>
<form class="float-end" action="">
    <lable>
        Tìm kiếm:
    </lable>
    <input type="search" name="q" id="" value="{{ $search }}">
</form>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th >Tên truyện</th>
        <th>Tác giả</th>
        <th>Giá</th>
        <th>Số lượng tồn</th>
        <th>Năm xuất bản</th>
        <th>Kích thước</th>
        <th>Thể loại</th>
        <th>Bộ truyện</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->author }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->publish_year }}</td>
        <td>{{ $product->size }}</td>
        <td>{{ $product->category }}</td>
        <td>{{ $product->collection }}</td>
        <td>
            <a href="{{route('admin.products.edit',$product)}}">
                Sửa
            </a>
        </td>
        <td>
            <form action="{{route('admin.products.destroy',$product)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        <li>
            {{$products->links()}}
        </li>
    </ul>
</nav>
@endsection('content')
