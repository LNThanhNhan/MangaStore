@push('css')
    <link rel="stylesheet" href="{{ asset('css/DSDonHang.css') }}">
@endpush
@extends('layout.master')
@section('content')
    <div class="containerDanhSachDonHang">
    @include('layout.header')
        <div class="contentDanhSachDonHang">
            <div class="danhsachdonhang">
                <div class="taikhoan">
                    <div class="lbTenTK">
                        <label for="tentk">
                            {{ Auth::user()->username }}
                        </label>
                    </div>
                    <div class="btnTTCN">
                        <button class="btnThongTinCaNhan">
                            <a href="{{route('user.profile.info')}}" style="text-decoration: none;color: black">
                                Thông tin cá nhân
                            </a>
                        </button>
                    </div>
                    <div class="btnDSDH">
                        <button class="btnDanhSachDonHang">
                            <a href="{{route('user.order.index')}}" style="text-decoration: none;color: black">
                                Danh sách đơn hàng
                            </a>
                        </button>
                    </div>
                    <div class="btnThoat">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btnExit">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
                <div class="divclasshr">
                    <hr class="hr" width="0.5" size="180">
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>-
                @endif
                    <div class="danhsachcacdonhang">
                        @foreach($orders as $order)
                            <div class="thongtindanhsachdonhang">
                                <div class="donhang">
                                    <div class="xacnhanngaydat">
                                        <div class="ngaydat">
                                            <a href="{{route('user.order.show',$order->id)}}" class="madonhang">
                                                #{{$order->id}}
                                            </a><br/>
                                            <label for="lbngaydat">
                                                Ngày đặt: {{$order->order_dateDMY}}
                                            </label>
                                        </div>
                                        <div class="btnchoxn">
                                            <button class="btnchoxacnhan">
                                                {{$order->status_name}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="listdonhang">
                                        @php($products = $order->products)
                                        @foreach($products as $product)
                                            <div class="thongtinsanpham">
                                                <div class="imagesp">
                                                    <img src="{{$product->image}}" class="imgsp">
                                                </div>
                                                <div class="motasanpham">
                                                    <div class="tensp">
                                                        <a href="" class="hreftensp">
                                                            {{$product->name}}
                                                        </a>
                                                    </div>
                                                    <div class="slmua">
                                                        <span class="inputslmua">{{$product->pivot->quantity}}</span>
                                                    </div>
                                                    <div class="giasp">
                                                        <label for="giasp">
                                                            {{format_priceVND($product->price*$product->pivot->quantity)}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tongtien">
                                        <div class="huydon">
                                            @if($order->status_name === 'Chờ xác nhận')
                                                <form action="{{route('user.order.cancel',$order->id)}}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btncancel" >
                                                        Hủy đơn
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="tongtiendh">
                                            <div class="sum">
                                                <label for="sum">
                                                    Tổng số tiền :
                                                </label>
                                            </div>
                                            <div class="tongsotien">
                                                <a href="" class="sotien">
                                                    {{$order->total_priceVND}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @include('layout.footer')
        </div>
    @endsection
    {{--@push('css')--}}
{{--    <link rel="stylesheet" href="{{ asset('css/DanhSachDonHang.css') }}">--}}
{{--@endpush--}}
{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--<div class="containerDanhSachDonHang">--}}
{{--    @include('layout.header')--}}
{{--    <div class="contentDanhSachDonHang">--}}
{{--        <table class="tbcontentdsdh">--}}
{{--            <tr>--}}
{{--                <td class="tdTenTK">--}}
{{--                    <table class="tbTaiKhoan">--}}
{{--                        <tr>--}}
{{--                            <td class="tdTen">--}}
{{--                                <div class="lbTenTK">--}}
{{--                                    <label for="tentk">--}}
{{--                                        {{auth()->user()->user->name}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="tdThongTinCaNhan">--}}
{{--                                <div class="btnTTCN">--}}
{{--                                    <a href="{{route('user.profile.info')}}">--}}
{{--                                        <button class="btnThongTinCaNhan">--}}
{{--                                            Thông tin cá nhân--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="tdDanhSachDonHang">--}}
{{--                                <div class="btnDSDH">--}}
{{--                                    <a href="{{route('user.order.index')}}">--}}
{{--                                        <button class="btnDanhSachDonHang">--}}
{{--                                            Danh sách đơn hàng--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="tdThoat">--}}
{{--                                <div class="btnThoat">--}}
{{--                                    <form method="post" action="{{route('logout')}}">--}}
{{--                                        @csrf--}}
{{--                                        <button class="btnExit">--}}
{{--                                            Đăng xuất--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </td>--}}
{{--                <td class="divhr">--}}
{{--                    <hr class="hr" width="0.5" size="180">--}}
{{--                </td>--}}
{{--                <td >--}}
{{--                    @if(session('success'))--}}
{{--                        <div class="alert alert-success">--}}
{{--                            {{session('success')}}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td class="tdlistdonhang">--}}
{{--                    @foreach($orders as $order)--}}
{{--                    <table class="tblistdonhang">--}}
{{--                        <tr>--}}
{{--                            <td class="tdngaydathang">--}}
{{--                                <div class="ngaydat">--}}
{{--                                    <a href="{{route('user.order.show',$order->id)}}" class="madonhang">--}}
{{--                                        #{{$order->id}}--}}
{{--                                    </a><br/>--}}
{{--                                    <label for="lbngaydat">--}}
{{--                                        Ngày đặt: {{$order->order_dateDMY}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td class="tdchoxacnhan">--}}
{{--                                <div class="btnchoxn">--}}
{{--                                    <button class="btnchoxacnhan">--}}
{{--                                        {{$order->status_name}}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td colspan="2">--}}
{{--                                <div class="thongtinsp">--}}
{{--                                    <div class="list">--}}
{{--                                        <ul>--}}
{{--                                            @php($products = $order->products)--}}
{{--                                            @foreach($products as $product)--}}
{{--                                                <li>--}}
{{--                                                    <table class="tbthongtinsp">--}}
{{--                                                        <tr>--}}
{{--                                                            <td class="tdimgsp">--}}
{{--                                                                <div class="imagesp">--}}
{{--                                                                    <img src="{{$product->image}}" class="imgsp">--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                            <td class="thongtin">--}}
{{--                                                                <div class="tensp">--}}
{{--                                                                    <a href="{{route('home.detail',$product->slug)}}" class="hreftensp">--}}
{{--                                                                        {{$product->name}}--}}
{{--                                                                    </a>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="slmua">--}}
{{--                                                                    <span  class="inputslmua" >{{$product->pivot->quantity}}</span>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="giasp">--}}
{{--                                                                    <label for="giasp">--}}
{{--                                                                        {{format_priceVND($product->price*$product->pivot->quantity)}}--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            @if($order->status_name === 'Chờ xác nhận')--}}
{{--                                <form action="{{route('user.order.cancel',$order->id)}}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <td class="tdhuydon">--}}
{{--                                        <div class="huydon">--}}
{{--                                            <button class="btncancel" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">--}}
{{--                                                Hủy đơn--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </form>--}}
{{--                            @endif--}}
{{--                            <td class="tdsummoney">--}}
{{--                                <p>--}}
{{--                                <div class="sum">--}}
{{--                                    <label for="sum">--}}
{{--                                        Tổng số tiền :--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="tongtien">--}}
{{--                                    <a href="" class="sotien">--}}
{{--                                        {{$order->total_priceVND}}--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                </p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--            @endforeach--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    @include('layout.footer')--}}
{{--</div>--}}
{{--@endsection--}}
