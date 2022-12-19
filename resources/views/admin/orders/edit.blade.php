@extends('layout.admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết đơn hàng </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khách hàng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <p>Tên khách hàng: {{$order->name}}</p>

                    <p>Số điện thoại: {{$order->phone}}</p>
                    <p>Địa chỉ nhận hàng: {{$order->address. ', '.$order->province_name}}</p>

                    <p>Ngày đặt hàng: {{$order->order_dateDMYHM}}</p>
                    <p>Trạng thái đơn hàng: {{$order->status_name}}</p>
                    <p>Phương thức thanh toán: {{$order->payment_method_name}}</p>

                    <form action="{{route('admin.orders.update',$order->id)}}" method="post"  class="form-inline" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="">Trạng thái</label>
                            @csrf
                            @method('PUT')
                            <select name="status" id="" class="form-control">
                                @foreach($orderStatus as $key => $value)
                                    <option value="{{$key}}" {{$key === $order->status ? 'selected' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
                <!-- /.card-body -->



            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Danh sách đơn hàng</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên truyện</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
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
                            <tr>
                                <td>Tổng đơn hàng</td>
                                <td>{{$order->totalOrderVND}}</td>
                            </tr>
                            <tr>
                                <td>Giảm giá</td>
                                <td>-{{format_priceVND($order->total_discount)}}</td>

                            </tr>
                            <tr>
                                <td>Phí vận chuyển</td>
                                <td>+{{format_priceVND($order->shipping_fee)}}</td>

                            </tr>
                            <tr class="bg-danger">
                                <td>Tổng thanh toán</td>
                                <td colspan="5">{{format_priceVND($order->total_price)}}</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--    Tên khách hàng--}}
{{--    <p>{{$order->name}}</p>--}}
{{--    Số điện thoại--}}
{{--    <p>{{$order->phone}}</p>--}}
{{--    Địa chỉ nhận hàng--}}
{{--    <p>{{$order->address. ', '.$order->province_name}}</p>--}}
{{--    Ngày đặt hàng--}}
{{--    <p>{{$order->order_dateDMYHM}}</p>--}}
{{--    Phuong thức thanh toán--}}
{{--    <p>{{$order->payment_method_name}}</p>--}}
{{--    Trạng thái đơn hàng--}}
{{--    <form action="{{route('admin.orders.update',$order->id)}}" method="post">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}
{{--        <select name="status" id="">--}}
{{--            @foreach($orderStatus as $key => $value)--}}
{{--                <option value="{{$key}}" {{$key === $order->status ? 'selected' : ''}}>{{$value}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <button type="submit">Cập nhật</button>--}}
{{--    </form>--}}
{{--    <table class="table table-bordered">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th scope="col">STT</th>--}}
{{--            <th scope="col">Hình ảnh</th>--}}
{{--            <th scope="col">Tên sản phẩm</th>--}}
{{--            <th scope="col">Số lượng</th>--}}
{{--            <th scope="col">Giá</th>--}}
{{--            <th scope="col">Thành tiền</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($products as $key => $product)--}}
{{--            <tr>--}}
{{--                <th scope="row">{{$key+1}}</th>--}}
{{--                <td>--}}
{{--                    <img src="{{($product->image)}}" alt="" width="100px">--}}
{{--                </td>--}}
{{--                <td>{{$product->name}}</td>--}}
{{--                <td>{{$product->pivot->quantity}}</td>--}}
{{--                <td>{{format_priceVND($product->pivot->total_price)}}</td>--}}
{{--                <td>{{format_priceVND($product->pivot->total_price/$product->pivot->quantity)}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--@endsection--}}

