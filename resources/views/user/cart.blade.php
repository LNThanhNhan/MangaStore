@push('css')
    <link rel="stylesheet" href="{{ asset('css/GioHang.css') }}">
@endpush
@extends('layout.master')
@section('content')
    <div class="containerDanhSachDonHang">
        @include('layout.header')
        @if($products->count() > 0)
            <div id="before-error" class="labelGioHang">
                <label for="giohang">
                    GIỎ HÀNG
                </label>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger show-error">
                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('user.cart.update')}}" method="post">
                @csrf
                @method('PUT')
            <div class="tablegiohang">
                <table class="tbgiohang">
                    <tr>
                        <td class="thsp">Sản phẩm</td>
                        <td class="thdongia">Đơn giá</td>
                        <td class="thsluong">Số lượng</td>
                        <td class="thgiatien">Giá tiền</td>
                        <td class="thnone">Xóa</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="listsp">
                                <ul>
                                    @foreach ($products as $product)
                                        <li>
                                            <div class="tbsp">
                                                <table class="tablesanpham">
                                                    <tr>
                                                        <td class="image">
                                                            <div class="imgsp">
                                                                <img src="{{ $product->image}}" class="imagesp">
                                                            </div>
                                                            <div class="name">
                                                                <label for="name">
                                                                    {{$product->name}}
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="gia">
                                                            <label class="giasp">
                                                                {{$product->priceVND}}
                                                            </label>
                                                        </td>
                                                        <td class="sl">
                                                            <input type="number" name="quantity[]" class="soluong" value={{$product->pivot->quantity}} min="1">
                                                        </td>
                                                        <td class="tong">
                                                            <label class="giatien">
                                                                {{format_priceVND($product->price * $product->pivot->quantity)}}
                                                            </label>
                                                        </td>
                                                        <td class="delete">
                                                            <div class="bin">
                                                                <img id="{{$product->id}}" src="{{asset('image/thungrac.png')}}" class="thungrac">
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
                </table>
            </div>
            <div class="tongtien">
                <table class="tbtinhtien">
                    @if($cart->discount)
                    {{-- Code thêm vào để bỏ áp dụng mã giảm giá --}}
                        <tr>
                            <td class="tdtongtien">Đã áp dụng mã: {{$cart->discount->name}}</td>
                            <td class="tdapdung">
                                <button name="remove-discount" class="btnapdung">
                                    Xóa mã
                                </button>
                            </td>
                        </tr>
{{--                    --}}
                        <tr>
                            <td class="tdtongtien">
                                <label class="tongtiensp" for="tongtien">Tổng tiền:</label>
                            </td>
                            <td class="tdtien"><label class="tien" for="tien">{{$cart->cart_totalVND}}</label></td>
                        </tr>
                        <tr>
                            <td class="tdgiamgia">
                                <label class="giamgia" for="giamgia">Giảm giá</label>
                            </td>
                            <td class="tdgiam"><label class="giam" for="giam">-{{$cart->total_discountVND}}</label></td>
                        </tr>
                    @else
                        <tr>
                            <td class="tdinput">
                                <input type="text" name="code"placeholder="Mã giảm giá" class="inputmagiamgia">
                            </td>
                            <td class="tdapdung">
                                <button name="code" class="btnapdung">
                                    ÁP DỤNG
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="tdtongtien">
                                <label class="tongtiensp" for="tongtien">Tổng tiền:</label>
                            </td>
                            <td class="tdtien"><label class="tien" for="tien">{{$cart->cart_totalVND}}</label></td>
                        </tr>
                    @endif
                    <tr>
                        <td class="tdtongcong">
                            <label class="tongcong" for="tongcong">Tổng cộng:</label>
                        </td>
                        <td class="tdcong"><label class="cong" for="cong">{{ $cart->total_priceVND }}</label></td>
                    </tr>
                    <tr>
                        <td class="tdtieptucmua">
                            <button class="btntieptucmua" type="submit">
                                <p>
                                    Cập nhật giỏ hàng
                                </p>
                            </button>
                        </td>

                        <td class="tdthanhtoan">
                            <button class="btnthanhtoan">
                                <a href="{{ route('user.checkout.index') }}" style="text-decoration: none; color:white">
                                    Thanh toán
                                    <i class="fa-solid fa-caret-right"></i>
                                </a>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        @else
            <div style="height: 30vh;width: 100%">
                <p style="margin: auto">Không có sản phẩm nào trong giỏ hàng</p>
            </div>
        @endif
        @include('layout.footer')
    </div>
@endsection

@push('js')
<script>
    {{-- Khi nhấn nút xóa sản phẩm sẽ gửi ajax  --}}
    $(".thungrac").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ route('user.cart.delete') }}",
            type: "DELETE",
            data: {
                product_id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response){
                if(response.status === 200){
                    location.reload();
                }
            },
            error: function(response){
                console.log(response);
            }
        });
    });

    {{-- Khi nhấn nút áp dụng giảm giá sẽ gửi ajax để áp dụng mã, gửi đi id cart, code mã giảm giá  --}}
    $('button[name="code"]').click(function(e){
        e.preventDefault();
        var code = $('input[name="code"]').val();
        $.ajax({
            url: "{{ route('user.cart.discount') }}",
            type: "PUT",
            data: {
                code: code,
                _token: "{{ csrf_token() }}"
            },
            success: function(response){
                console.log(response);
                if(response.success === true){
                    location.reload();
                }
            },
            error: function(response){
                //append lỗi vào thẻ li trong div id error
                $('.show-error').remove();
                $('#before-error').after(`
                    <div class="alert alert-danger show-error">
                        <ul id="error">
                            <li>${response.responseJSON.message}</li>
                        </ul>
                    </div>
                    `);
            }
        });
    });

    {{-- Khi nhấn nút xóa mã giảm giá sẽ gửi ajax để xóa mã giảm giá, gửi đi id cart  --}}
    $('button[name="remove-discount"]').click(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('user.cart.remove_discount') }}",
            type: "PUT",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response){
                if(response.success === true){
                    location.reload();
                }
            },
            error: function(response){
                console.log(response);
            }
        });
    });
</script>
@endpush
