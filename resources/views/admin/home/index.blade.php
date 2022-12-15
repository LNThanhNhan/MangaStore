@extends('layout.master')
@section('content')
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Đăng xuất</button>
</form>
<form action="{{route('admin.home.index')}}" >
    Từ ngày
    <input type="date" name="fromDate" value="{{ $fromDate  }}">
    Đến ngày
    <input type="date" name="toDate" value="{{ $toDate }}">
    Thể loại
    <select name="category" id="">
        <option value=0>Tất cả</option>
        @foreach($arrCategory as $key => $value)
        <option value="{{ $value }}" {{ $value === $category ? 'selected' : '' }}>{{ $key }}</option>
        @endforeach
    </select>

    <button type="submit">Tìm kiếm</button>
</form>
<table>
    <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Doanh thu</th>
        <th>Danh mục</th>
    </tr>
    @foreach($topProducts as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->total_price }}</td>
        <td>{{ getProductCategoryName($product->category)}}</td>
    </tr>
    @endforeach
</table>
@endsection
