@if ($errors->any())
    <div class="alert alert-danger">
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
    @if($products->count() > 0)
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
        <label for="">Tổng tiền: </label>
        <h3>
            {{ $cart->total_priceVND }}
        </h3>
        <button type="submit">Cập nhật giỏ hàng</button>
    @else
        <p>Không có sản phẩm nào trong giỏ hàng</p>
    @endif
</form>
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
</script>

