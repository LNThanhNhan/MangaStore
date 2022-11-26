@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
@endpush
@section('content')
<h1>{{$product->name}}</h1>
<img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="250" height="300">
<p>{{ $product->description }}</p>
<p>{{$product->price_VND}}</p>
<form action="{{ route('user.cart.add',$product) }}" method="POST">
    @csrf
    <label> Số lượng:</label>
    <input type="number" name="quantity" value="1" min="1" > <br>
    <button type="submit">Thêm vào giỏ hàng</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>Tác giả</p>
<a href="{{ route('home.author',$product->author_slug)}}">{{$product->author}}</a>
<p>Thể loại</p>
<p>{{$product->category_name}}</p>
<a href="{{route('home.collection',$product->collection_slug)}}">{{$product->collection}}</a>
@endsection

@push('js')
<script src="{{ asset('js/jquery.toast.min.js') }}"></script>
<script>
    $(document).ready(function(){
    {{--    khi nhấn vào nút thêm sản phẩm vào giỏ hàng thực hiện việc gửi form request bằng ajax--}}
    {{--    nếu thành công thì hiển thị thông báo thêm sản phẩm thành công bằng toast--}}
    {{--    nếu thất bại thì hiển thị thông báo thêm sản phẩm thất bại bằng toast--}}
        $('form').on('submit',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url: '{{ route('user.cart.add',$product) }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'Thêm thành công', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'slide', // fade, slide or plain
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 2, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    });
                },
                error: function(response){
                    console.log(response);
                    $.toast({
                        text: response.responseJSON.message, // Text that is to be shown in the toast
                        heading: 'Lỗi', // Optional heading to be shown on the toast
                        icon: 'error', // Type of toast icon
                        showHideTransition: 'slide', // fade, slide or plain
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 2, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    });
                }
            });
        });
    });
</script>
@endpush
