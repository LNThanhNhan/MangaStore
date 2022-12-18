@extends('layout.master')
@section('content')
    Tên khách hàng
    <p>{{$order->name}}</p>
    Số điện thoại
    <p>{{$order->phone}}</p>
    Địa chỉ nhận hàng
    <p>{{$order->address. ', '.$order->province_name}}</p>
    Ngày đặt hàng
    <p>{{$order->order_dateDMYHM}}</p>
    Phuong thức thanh toán
    <p>{{$order->payment_method_name}}</p>
    Trạng thái đơn hàng
    <form action="{{route('admin.orders.update',$order->id)}}" method="post">
        @csrf
        @method('PUT')
        <select name="status" id="">
            @foreach($orderStatus as $key => $value)
                <option value="{{$key}}" {{$key === $order->status ? 'selected' : ''}}>{{$value}}</option>
            @endforeach
        </select>
        <button type="submit">Cập nhật</button>
    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giá</th>
            <th scope="col">Thành tiền</th>
        </tr>
        </thead>
        <tbody>
{{--        @foreach($order->orderDetails as $key => $orderDetail)--}}
{{--            <tr>--}}
{{--                <th scope="row">{{$key+1}}</th>--}}
{{--                <td>--}}
{{--                    <img src="{{asset($orderDetail->product->image)}}" alt="" width="100px">--}}
{{--                </td>--}}
{{--                <td>{{$orderDetail->product->name}}</td>--}}
{{--                <td>{{$orderDetail->quantity}}</td>--}}
{{--                <td>{{$orderDetail->product->priceVND}}</td>--}}
{{--                <td>{{$orderDetail->total_priceVND}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        @foreach($products as $key => $product)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>
                    <img src="{{($product->image)}}" alt="" width="100px">
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{format_priceVND($product->pivot->total_price)}}</td>
                <td>{{format_priceVND($product->pivot->total_price/$product->pivot->quantity)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
