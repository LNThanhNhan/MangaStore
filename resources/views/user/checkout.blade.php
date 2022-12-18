@push('css')
    <link rel="stylesheet" href="{{ asset('css/ThanhToan.css') }}">
    <style>
        table,tr,td{
            border-collapse: collapse;
        }
        #hidettknh{
            display: none;
        }
        #hideck{
            display: none;
        }
        #hidevizalopay{
            display: none;
        }
    </style>
@endpush
@extends('layout.master')
@section('content')
<div class="containerThanhToan">
    @include('layout.header')
    <div class="contentThanhToan">
        <div class="ttgiaohang">
            <a href="" class="giohang">
                Giỏ hàng
            </a>
            <i class="fa-solid fa-caret-right"></i>
            <a href="" class="ttgh">
                Thông tin giao hàng
            </a>
        </div>
        <div class="thongtingiaohang">
            <div class="thongtinvanchuyenpttt">
                @if ( $errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{route('user.checkout.store')}}" method="POST">
                    @csrf
                <div class="lb">
                    <label for="lb">
                        Thông tin vận chuyển
                    </label>
                </div>
                <div class="nhaphotensdt">
                    <div class="inputhoten">
                        <input name="name" type="text" placeholder="Họ tên" class="iphoten" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="inputsdt">
                        <input name="phone" type="text" placeholder="Số điện thoại" class="ipsdt" value="{{ old('phone',$user->phone) }}">
                    </div>
                </div>
                <div class="nhapemail">
                    <input name="email" type="text" placeholder="Email" class="ip" value="{{ old('email',$user->account->email)}}">
                </div>
                <div class="nhapdiachi">
                    <input name="address" type="text" placeholder="Địa chỉ ( ví dụ: 204 Tô Ký, phường Tân Chánh Hiệp, Quận 12)" class="ip">
                </div>
                <div class="chontinhthanh">
                    <div class="optionTT">
                        <select id="TinhThanh" name="province">
                            <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                            @foreach ($provinces as $key => $value)
                                <option value="{{ $value }}"
                                        @if($user->province ===$value)
                                        selected
                                        @endif
                                >{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="lb">
                    <label for="lb">
                        Phương thức thanh toán
                    </label>
                </div>
                <div class="chonphuongthucthanhtoan">
                    <div class="thanhtoan" onclick="hienttknh()" ondblclick="anttknh()">
                        <input type="radio" name="payment_method" value="1" class="radiott">
                        <p class="pttt">
                            <img src="{{asset('image/ThanhToanKhiNhanHang.png')}}" class="pt">
                            <label class="tt">
                                Thanh toán khi nhận hàng
                            </label>
                        </p>
                    </div>
                    <div id="hidettknh">
                        <div class="thanhtoankhinhanhang">
                            <div class="labelstk">
                                <label for="stk">
                                    Khi chọn phương thức Thanh toán khi giao hàng (COD), bạn vui lòng kiểm tra kĩ<br>
                                    hàng trước khi nhận hàng và thanh toán toàn bộ giá trị đơn hàng cho shipper.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="thanhtoan" onclick="hienck()" ondblclick="anck()">
                        <input type="radio" name="payment_method" value="2" class="radiott">
                        <p class="pttt">
                            <img src="{{asset('image/ChuyenKhoan.png')}}" class="pt">
                            <label class="tt">
                                Chuyển khoản qua ngân hàng
                            </label>
                        </p>
                    </div>
                    <div id="hideck">
                        <div class="stknganhang">
                            <div class="labelstk">
                                <label for="stk">
                                    Khi lựa chọn phương thức thanh toán Chuyển khoản qua ngân hàng, bạn vui lòng<br>
                                    chuyển 100% giá trị đơn hàng vào tài khoản dưới đây:<br>
                                    Chủ tài khoản: SÂUKIU MANGA STORE <br>
                                    STK: 58110001165784<br>
                                    Ngân hàng Thương mại Cổ phần Đầu tư và Phát triển Việt Nam (BIDV)<br>
                                    Khi chuyển khoản, vui lòng để rõ Tên - Mã Đơn hàng - SĐT vào phần Nội dung<br>
                                    chuyển khoản.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="thanhtoan" onclick="hienvizalopay()" ondblclick="anvizalopay()">
                        <input type="radio" name="payment_method" value="3" class="radiott">
                        <p class="pttt">
                            <img src="{{asset('image/zalopay.png')}}" class="pt">
                            <label class="tt">
                                Ví điện tử ZaloPay
                            </label>
                        </p>
                    </div>
                    <div id="hidevizalopay">
                        <div class="vizalopay">
                            <div class="labelstk">
                                <label for="stk">
                                    Khi lựa chọn phương thức thanh toán Chuyển khoản qua ví ZaloPay, bạn vui lòng<br>
                                    chuyển 100% giá trị đơn hàng vào tài khoản ZaloPay với số điện thoại dưới đây:<br>
                                    Tên tài khoản: SÂUKIU MANGA STORE <br>
                                    SĐT: 0374540896<br>
                                    Khi chuyển khoản, vui lòng để rõ Tên - Mã Đơn hàng - SĐT vào phần Lời nhắn.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hoanthanhdathang">
                    <div class="back">
                        <a href="{{route('user.cart.index')}}" class="giohang">
                            <i class="fa-solid fa-caret-left"></i>
                            Giỏ hàng
                        </a>
                    </div>
                    <div class="btnhoanthanh">
                        <button class="btndathang">
                            Hoàn thành đặt hàng
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="divclasshrdoc">
                <hr class="hrdoc"  width="0.5" size="180">
            </div>
            <div class="chitietgiohang">
                <div class="thongtindonhang">
                    <div class="lbgiohang">
                        <label for="lbgiohang">
                            GIỎ HÀNG
                        </label>
                    </div>
                    @foreach($products as $product)
                        <div class="thongtinsp">
                            <div class="imagesp">
                                <img src="{{$product->image}}" class="truyen">
                                <div class="spansoluong">
                                    <span class="sl">{{$product->pivot->quantity}}</span>
                                </div>
                            </div>
                            <div class="chitietsp">
                                <div class="ttsp">
                                    <a href="" class="name">
                                        {{$product->name}}
                                    </a>
                                </div>
                                <div class="ttspprice">
                                    <label for="price" class="lbprice">
                                        {{format_priceVND($product->price * $product->pivot->quantity)}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="divhr"><hr class="hr"></div>
                    <div class="thongtingiadonhang">
                        <div class="vanchuyen">
                            <label for="tamtinh">
                                Tạm tính:
                            </label>
                        </div>
                        <div class="price">
                            <label for="gia">
                                {{ $cart->cart_totalVND }}
                            </label>
                        </div>
                    </div>
                    <div class="thongtingiadonhang">
                        <div class="vanchuyen">
                            <label for="giamgia">
                                Giảm giá:
                            </label>
                        </div>
                        <div class="price">
                            <label for="gia">
                                @if($cart->discount)
                                    -{{ $cart->total_discountVND }}
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="thongtingiadonhang">
                        <div class="vanchuyen">
                            <label for="tamtinh">
                                Phí vận chuyển
                            </label>
                        </div>
                        <div class="price">
                            @if($user->province && (getProvinceName($user->province) === 'Hà Nội' || getProvinceName($user->province) === 'Hồ Chí Minh'))
                                <label for="gia" id="shipping-fee">{{format_priceVND($shipping_fee['hn_hcm'])}}</label>
                            @elseif($user->province === null)
                                <label for="gia" id="shipping-fee">___</label>
                            @else
                                <label for="gia" id="shipping-fee">{{format_priceVND($shipping_fee['tinh_thanh'])}}</label>
                            @endif
                        </div>
                    </div>
                    <div class="divhr"><hr class="hr"></div>
                    <div class="sumgia">
                        <div class="tongcong">
                            <label for="sum">
                                Tổng cộng
                            </label>
                        </div>
                        <div class="pricesum">
                            <label for="gia" id="total_price">
                                {{ format_priceVND($cart->total_price + $cart->shipping_fee)}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layout.footer')
</div>
{{--@if ( $errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<div style="display:flex">--}}
{{--    <div>--}}
{{--        <form action="" method="POST">--}}
{{--            @csrf--}}
{{--            Họ tên <input type="text" name="name" value="{{ old('name', $user->name) }}">--}}
{{--            <br>--}}
{{--            Email <input type="text" name="email" value="{{ old('email',$user->account->email) }}">--}}
{{--            <br>--}}
{{--            Số điện thoại <input type="text" name="phone" value="{{ old('phone',$user->phone) }}">--}}
{{--            <br>--}}
{{--            <label for="">Tỉnh/Thành phố</label>--}}
{{--            <select name="province">--}}
{{--                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>--}}
{{--                @foreach ($provinces as $key => $value)--}}
{{--                    <option value="{{ $value }}"--}}
{{--                            @if($user->province ===$value)--}}
{{--                            selected--}}
{{--                            @endif--}}
{{--                    >{{ $key }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--            <br>--}}
{{--            Địa chỉ <input type="text" name="address" value="{{ old('address') }}">--}}
{{--            <br>--}}
{{--            Phương thức thanh toán <br>--}}
{{--            <input type="radio" name="payment_method" value="1" checked> Thanh toán khi nhận hàng (COD) <br>--}}
{{--            <input type="radio" name="payment_method" value="2"> Chuyển khoản qua ngân hàng <br>--}}
{{--            <input type="radio" name="payment_method" value="3"> Thanh toán qua ví điện tử ZaloPay <br>--}}
{{--            <input type="radio" name="payment_method" value="4"> Thanh toán qua ví điện tử Momo <br>--}}
{{--            <input type="submit" value="Hoàn tất đơn hàng">--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    <div style="margin-left: 200px">--}}
{{--        <table >--}}
{{--            <tbody>--}}
{{--                @foreach($products as $product)--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="100" height="150">--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <p>{{ $product->name }}</p>--}}
{{--                        </td>--}}
{{--                        <td>{{ $product->price_VND }}</td>--}}
{{--                        <td >--}}
{{--                            <p style="margin: 10px">{{$product->pivot->quantity}} </p>--}}
{{--                        </td>--}}
{{--                        <td>{{ $product->price * $product->pivot->quantity }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <label for="">Tạm tính: </label>--}}
{{--        <span>{{ $cart->cart_totalVND }}</span>--}}
{{--        @if($cart->discount)--}}
{{--            <br>--}}
{{--            <label for="">Giảm giá: </label>--}}
{{--            <span>- {{ $cart->total_discountVND }}</span>--}}
{{--        @endif--}}
{{--        <br>--}}
{{--        <label for="">Phí vận chuyển: </label>--}}
{{--        @if($user->province && (getProvinceName($user->province) === 'Hà Nội' || getProvinceName($user->province) === 'Hồ Chí Minh'))--}}
{{--            <span id="shipping-fee">{{format_priceVND($shipping_fee['hn_hcm'])}}</span>--}}
{{--        @elseif($user->province === null)--}}
{{--            <span id="shipping-fee">_</span>--}}
{{--        @else--}}
{{--            <span id="shipping-fee">{{format_priceVND($shipping_fee['tinh_thanh'])}}</span>--}}
{{--        @endif--}}
{{--        <br>--}}
{{--        <label for="">Tổng cộng: </label>--}}
{{--        <span id="total_price">{{ format_priceVND($cart->total_price + $cart->shipping_fee)}}</span>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection

@push('js')
<script>
{{--thêm script để tính tổng tiền khi chọn tỉnh/thành phố--}}
{{--khi thay đổi tỉnh thành phố thì sẽ tính lại tổng tiền theo value của id="total_price"--}}
{{--nếu tỉnh thành phố là Hà Nội hoặc Hồ Chí Minh thì lấy value + 15000 rồi format lại theo tiền Việt Nam--}}
{{--nếu tỉnh thành phố là null thì lấy value + 0 rồi format lại theo tiền Việt Nam--}}
{{--nếu tỉnh thành phố là tỉnh khác thì lấy value + 30000 rồi format lại theo tiền Việt Nam--}}
    $(document).ready(function () {
        $('select[name="province"]').change(function () {
            let province = $(this).val();
            if (province === '0') {
                $('#total_price').text("{{ format_priceVND($cart->total_price) }}");
                $('#shipping-fee').text('___');
            } else if (province === "{{getProvinceID('Hồ Chí Minh')}}" || province === "{{getProvinceID('Hà Nội')}}") {
                $('#total_price').text("{{ format_priceVND($cart->total_price + $shipping_fee['hn_hcm'])}}");
                $('#shipping-fee').text('{{format_priceVND($shipping_fee['hn_hcm'])}}');
            } else {
                $('#total_price').text("{{ format_priceVND($cart->total_price + $shipping_fee['tinh_thanh'])}}");
                $('#shipping-fee').text('{{format_priceVND($shipping_fee['tinh_thanh'])}}');
            }
        });
    });
</script>
<script>
    function hienttknh(){
        document.getElementById("hidettknh").style.display = "block";
        document.getElementById("hideck").style.display = "none";
        document.getElementById("hidevizalopay").style.display = "none";
    }
    function anttknh(){
        document.getElementById("hidettknh").style.display = "none";
    }
    function hienck(){
        document.getElementById("hideck").style.display = "block";
        document.getElementById("hidettknh").style.display = "none";
        document.getElementById("hidevizalopay").style.display = "none";
    }
    function anck(){
        document.getElementById("hideck").style.display = "none";
    }
    function hienvizalopay(){
        document.getElementById("hidevizalopay").style.display = "block";
        document.getElementById("hideck").style.display = "none";
        document.getElementById("hidettknh").style.display = "none";
    }
    function anvizalopay(){
        document.getElementById("hidevizalopay").style.display = "none";
    }
</script>
@endpush
