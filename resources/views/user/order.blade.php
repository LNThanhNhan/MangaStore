@extends('layout.master')
@section('content')
@foreach($orders as $order)
    <a href="{{route('user.order.show',$order->id)}}">Xem chi tiết</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#{{ $order->id }}</th>
                <th>{{ $order->order_dateDMY }}</th>
                <th>{{ $order->status_name }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <td>
                    <img width="250" height="300" src="{{ $product->image }}" alt="Hình sản phẩm">
                    {{ $product->name }}
                </td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ format_priceVND($product->pivot->total_price) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @if($order->status_name === 'Chờ xác nhận')
                <td >
                    <form action="{{route('user.order.cancel',$order->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy đơn hàng</button>
                    </form>
                </td>
                @endif
                <td>Tổng tiền:</td>
                <td>{{ $order->total_priceVND }}</td>
            </tr>
        </tfoot>
    </table>
@endforeach
@endsection
