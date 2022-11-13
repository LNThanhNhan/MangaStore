<div style="display:flex">
    <div>
        <form action="" method="POST">
            @csrf
            Họ tên <input type="text" name="name" value="{{ old('name', $user->name) }}">
            <br>
            Email <input type="text" name="email" value="{{ old('email',$user->account->email) }}">
            <br>
            Số điện thoại <input type="text" name="phone" value="{{ old('phone',$user->phone) }}">
            <br>
            <label for="">Tỉnh/Thành phố</label>
            <select name="province">
                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                @foreach ($provinces as $key => $value)
                    <option value="{{ $value }}"
                            @if($user->province ===$value)
                            selected
                            @endif
                    >{{ $key }}</option>
                @endforeach
            </select>
            <br>
            Địa chỉ <input type="text" name="address" value="{{ old('address') }}">
            <br>
            Phương thức thanh toán <br>
            <input type="radio" name="payment_method" value="1" checked> Thanh toán khi nhận hàng (COD) <br>
            <input type="radio" name="payment_method" value="2"> Chuyển khoản qua ngân hàng <br>
            <input type="radio" name="payment_method" value="3"> Thanh toán qua ví điện tử ZaloPay <br>
            <input type="radio" name="payment_method" value="4"> Thanh toán qua ví điện tử Momo <br>
            <input type="submit" value="Hoàn tất đơn hàng">
        </form>
    </div>
    <div style="margin-left: 200px">
        <table >
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="100" height="150">
                        </td>
                        <td>
                            <p>{{ $product->name }}</p>
                        </td>
                        <td>{{ $product->price_VND }}</td>
                        <td >
                            <p style="margin: 10px">{{$product->pivot->quantity}} </p>
                        </td>
                        <td>{{ $product->price * $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <label for="">Tạm tính: </label>
        <span>{{ $cart->cart_totalVND }}</span>
        @if($cart->discount)
            <br>
            <label for="">Giảm giá: </label>
            <span>- {{ $cart->total_discountVND }}</span>
        @endif
        <br>
        <label for="">Phí vận chuyển: </label>
        @if($user->province && (getProvinceName($user->province) === 'Hà Nội' || getProvinceName($user->province) === 'Hồ Chí Minh'))
            <span id="shipping-fee">{{format_priceVND($shipping_fee['hn_hcm'])}}</span>
        @elseif($user->province === null)
            <span id="shipping-fee">_</span>
        @else
            <span id="shipping-fee">{{format_priceVND($shipping_fee['tinh_thanh'])}}</span>
        @endif
        <br>
        <label for="">Tổng cộng: </label>
        <span id="total_price">{{ format_priceVND($cart->total_price + $cart->shipping_fee)}}</span>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
                $('#shipping-fee').text('_');
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

