@extends('layout.master')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul id="error">

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>
</div>
@endif
@if($products->count() > 0)
<form action="{{route('user.cart.update')}}" method="post">
    @csrf
    @method('PUT')

        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="250" height="300">
                            <a href="{{ route('home.detail', $product->slug) }}">{{ $product->name }}</a>
                        </td>
                        <td>{{ $product->price_VND }}</td>
                        <td>
                            <input type="number" name="quantity[]" value="{{$product->pivot->quantity}}" min="1" max="{{$product->quantity}}">
                        </td>
                        <td>{{ $product->price * $product->pivot->quantity }}</td>
                        <td>
                            <button id="{{$product->id}}" name="delete">
                                Xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <label for="">Tạm tính: </label>
        <h3>
            {{ $cart->cart_totalVND }}
        </h3>
        @if($cart->discount)
            <p>Đã áp dụng mã giảm giá: {{ $cart->discount->name }}</p>
            <button name="remove-discount">Xóa mã giảm giá</button><br>
            <p>Tổng số tiền giảm: {{$cart->total_discountVND }}</p> <br>
        @else
            <label for="">Nhập mã giảm giá </label> <br>
            <input type="text" name="code" id="" value="{{old('$product')}}">
            <button type="button" name="code">Áp dụng</button>
            <br>
        @endif
        <label for="">Tổng tiền: </label>
        <h3>
            {{ $cart->total_priceVND }}
        </h3>
        <button type="submit">Cập nhật giỏ hàng</button>
</form>
<a href="{{ route('user.checkout.index') }}"> Thanh toán</a>
@else
    <p>Không có sản phẩm nào trong giỏ hàng</p>
@endif
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    {{-- Khi nhấn nút xóa sản phẩm sẽ gửi ajax  --}}
    $('button[name="delete"]').click(function(e){
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
                $('#error').empty().html('<li>'+response.responseJSON.message+'</li>');
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
