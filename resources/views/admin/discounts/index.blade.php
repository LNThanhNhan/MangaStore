@extends('layout.master')
@section('content')
<h1>Quản lý mã giảm giá</h1>
<a class="btn btn-success" href="{{route('admin.discounts.create')}}">Thêm</a>
<form class="float-end" action="">
    <label>
        Tìm kiếm:
    </label>
    <input type="search" name="q" id="" value="{{ $search }}">
</form>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Tên mã giảm giá</th>
        <th>Mã giảm giá</th>
        <th>Loại mã giảm</th>
        <th>Đơn hàng tối thiểu</th>
        <th>Giảm</th>
        <th>Giảm tối đa</th>
        <th>Số lượng</th>
        <th>Thời gian bắt đầu</th>
        <th>Thời gian kết thúc</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach($discounts as $discount)
    <tr>
        <td>{{ $discount->id }}</td>
        <td>{{ $discount->name }}</td>
        <td>{{ $discount->code }}</td>
        <td>{{ $discount->type_name }}</td>
        <td>{{ $discount->min_order }}</td>
        <td>{{ $discount->value }}</td>
        <td>{{ $discount->max_discount }}</td>
        <td>{{ $discount->quantity }}</td>
        <td>{{ $discount->begin_at }}</td>
        <td>{{ $discount->end_at }}</td>
        <td>
            <a href="{{route('admin.discounts.edit',$discount)}}">
                Sửa
            </a>
        </td>
        <td>
            <form action="{{route('admin.discounts.destroy',$discount)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        <li>
            {{$discounts->links()}}
        </li>
    </ul>
</nav>
@endsection
