@push('css')
    <link rel="stylesheet" href="{{ asset('css/ChiTietDonHang.css') }}">
@endpush
@extends('layout.master')
@section('content')
    <div class="containerChiTietDonHang">
        @include('layout.header')
        <div class="contentChiTietDonHang">
            <table class="tbcontentctdh">
                <tr>
                    <td class="tdTenTK">
                        <div class="tableTaiKhoan">
                            <table class="tbTaiKhoan">
                                <tr>
                                    <td class="tdTen">
                                        <div class="lbTenTK">
                                            <label for="tentk">
                                                {{auth()->user()->user->name}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdThongTinCaNhan">
                                        <div class="btnTTCN">
                                            <a href="{{route('user.profile.info')}}">
                                                <button class="btnThongTinCaNhan">
                                                    Thông tin cá nhân
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdDanhSachDonHang">
                                        <div class="btnDSDH">
                                            <a href="{{route('user.order.index')}}">
                                                <button class="btnDanhSachDonHang">
                                                    Danh sách đơn hàng
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdThoat">
                                        <div class="btnThoat">
                                            <form action="{{route('logout')}}">
                                                @csrf
                                                <button class="btnExit">
                                                    Đăng xuất
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td class="divhr">
                        <hr class="hr" width="0.5" size="180">
                    </td>
                    <td class="tdchitietdh">
                        <div class="tbthongtindonhang">
                            <table class="tablettdh">
                                <tr>
                                    <td class="tdtbngaythang">
                                        <div class="tbngaythang">
                                            <table class="tablengaythang">
                                                <tr>
                                                    <td class="back">
                                                        <div class="btnback">
                                                            <i class="fa-solid fa-circle-arrow-left"></i>
                                                        </div>
                                                    </td>
                                                    <td class="madh">
                                                        <div class="lbdonhang">
                                                            <label for="lbdh">
                                                                ĐƠN HÀNG: <a href="{{'user.order.show',$order->id}}" class="hrefmadh">#{{$order->id}}</a> |  Ngày đặt: {{$order->orderDateDMY}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="buttondagiao">
                                                        <div class="btndagiao">
                                                            <button class="dagiao">
                                                                {{$order->status_name}}
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="chitietsanphamdh">
                                        <div class="tbchitietsp">
                                            <table class="tablechitietsp">
                                                <tr>
                                                    <td class="tdname">Tên sản phẩm</td>
                                                    <td class="tdsoluong">Số lượng</td>
                                                    <td class="tdgia">Giá niêm yết</td>
                                                    <td class="tdthanhtien">Thành tiền</td>
                                                </tr>
                                                <tr>
                                                    <td class="tbsp" colspan="4">
                                                        <div class="listsp">
                                                            <ul>
                                                                @foreach($products as $product)
                                                                    <li>
                                                                        <div class="tbspmua">
                                                                            <table class="tablesp">
                                                                                <tr>
                                                                                    <td class="tdtentruyen">
                                                                                        <div class="tentruyen">
                                                                                            <a href="" class="hreftentuyen">
                                                                                                {{$product->name}}
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="tdsl">
                                                                                        <div class="soluong">
                                                                                            <label for="lbsl">
                                                                                                {{$product->pivot->quantity}}
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="tdgiasp">
                                                                                        <div class="giasp">
                                                                                            <label for="lbgia">
                                                                                                {{format_priceVND($product->price)}}
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="tdthanhtiensp">
                                                                                        <div class="giathanhtien">
                                                                                            <label for="lbthanhtien">
                                                                                                {{format_priceVND($product->price * $product->pivot->quantity)}}
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tddivhr2" colspan="4">
                                                        <div class="divhr2">
                                                            <hr class="hr2">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tddivhr2" colspan="4">
                                                        <div class="divhr2">
                                                            <hr class="hr2">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdmagiamkhuyenmai" colspan="2">
                                                        <div class="magiamkhuyenmai">
                                                            <label for="lbmgkm">
                                                                Tổng giá trị sản phẩm
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="tdgiagiamkm">
                                                        <div class="giagiamkm">
                                                            <label for="lbgiakm">
                                                                {{$order->total_orderVND}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tddivhr2" colspan="4">
                                                        <div class="divhr2">
                                                            <hr class="hr2">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdmagiamkhuyenmai" colspan="2">
                                                        <div class="magiamkhuyenmai">
                                                            <label for="lbmgkm">
                                                                Tổng khuyến mãi
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="tdgiagiamkm">
                                                        <div class="giagiamkm">
                                                            <label for="lbgiakm">
                                                                -{{$order->total_discountVND}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tddivhr2" colspan="4">
                                                        <div class="divhr2">
                                                            <hr class="hr2">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdmagiamkhuyenmai" colspan="2">
                                                        <div class="magiamkhuyenmai">
                                                            <label for="lbmgkm">
                                                                Phí vận chuyển
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="tdgiagiamkm">
                                                        <div class="giagiamkm">
                                                            <label for="lbgiakm">
                                                                +{{$order->shipping_feeVND}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tddivhr2" colspan="4">
                                                        <div class="divhr2">
                                                            <hr class="hr2">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdmagiamkhuyenmaisum" colspan="2">
                                                        <div class="magiamkhuyenmaisum">
                                                            <label for="lbmgkmsum">
                                                                Tổng thanh toán
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="tdgiagiamkmsum">
                                                        <div class="giagiamkmsum">
                                                            <label for="lbgiakmsum">
                                                                {{$order->total_priceVND}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdthongtinnguoinhan">
                                        <div class="ttnn">
                                            <label for="lbttnn">
                                                Thông tin nhận hàng
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="thongtinnhanhang" colspan="4">
                                        <div class="tbthongtinnhanhang">
                                            <table class="tablenhanhang">
                                                <tr>
                                                    <td class="tdngnhan">
                                                        <div class="ngnhan">
                                                            <label for="ten">
                                                                Tên người nhận: <a href="" class="hrefngnhan">{{$order->name}}</a>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdngnhan">
                                                        <div class="ngnhan">
                                                            <label for="emailngnhan">
                                                                Email: <a href="" class="hrefngnhan">{{$order->email}}</a>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdngnhan">
                                                        <div class="ngnhan">
                                                            <label for="sdtngnhan">
                                                                Số điện thoại: <a href="" class="hrefngnhan">{{$order->phone}}</a>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdngnhan">
                                                        <div class="ngnhan">
                                                            <label for="httt">
                                                                Phương thức thanh toán: <a href="" class="hrefngnhan">{{$order->paymentMethodName}}</a>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdngnhan">
                                                        <div class="ngnhan">
                                                            <label for="dcgh">
                                                                Địa chỉ giao hàng: <a href="" class="hrefngnhan">{{$order->address. ', '.$order->province_name}}</a>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        @include('layout.footer')
    </div>
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
{{--    <p>{{$order->status_name}}</p>--}}
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
@endsection

