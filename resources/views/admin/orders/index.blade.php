@extends('layout.master')
@section('content')
    <h1>Quản lý đơn hàng</h1>
    <form class="float-end" action="{{route('admin.orders.index')}}">
        <label>
            Tìm kiếm:
        </label>
        <input type="search" name="q" id="" value="{{ $search }}">
    </form>
    <table class="table table-striped">
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái đơn hàng</th>
            <th>Xem</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->order_dateDMY }}</td>
                <td>{{ $order->total_priceVND }}</td>
                <td>{{ $order->status_name }}</td>
                <td>
                    <a href="{{route('admin.orders.edit',$order->id)}}">
                        Sửa
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <nav>
        <ul class="pagination pagination-rounded mb-0">
            <li>
                {{$orders->links()}}
            </li>
        </ul>
    </nav>
@endsection
