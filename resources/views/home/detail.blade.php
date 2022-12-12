@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ChiTietSanPham.css') }}">
    <style>
        table,tr,td{
            border-collapse: collapse;
        }
    </style>
@endpush

@section('content')
{{--<h1>{{$product->name}}</h1>--}}
{{--<img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="250" height="300">--}}
{{--<p>{{ $product->description }}</p>--}}
{{--<p>{{$product->price_VND}}</p>--}}
{{--<form action="{{ route('user.cart.add',$product) }}" method="POST">--}}
{{--    @csrf--}}
{{--    <label> Số lượng:</label>--}}
{{--    <input type="number" name="quantity" value="1" min="1" > <br>--}}
{{--    <button type="submit">Thêm vào giỏ hàng</button>--}}
{{--</form>--}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<p>Tác giả</p>--}}
{{--<a href="{{ route('home.author',$product->author_slug)}}">{{$product->author}}</a>--}}
{{--<p>Thể loại</p>--}}
{{--<p>{{$product->category_name}}</p>--}}
{{--<a href="{{route('home.collection',$product->collection_slug)}}">{{$product->collection}}</a>--}}
<div class="containerDangKy">
    @include('layout.header')
    <div class="contentChiTietSanPham">
        <table class="tbcontentChiTietSanPham">
            <tr>
                <td class="tdtieudesanpham" colspan="2">
                    <div class="tieude">
                        <a href="" class="hreftrangchu">
                            TRANG CHỦ
                        </a>
                        /
                        <a href="" class="hreftrinhtham">
                            {{  $product->category_name }}
                        </a>
                        /
                        <a href="" class="hreftentruyen">
                            {{$product->name}}
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tdimagesp">
                    <div class="imagesp">
                        <img src="{{$product->image}}" class="imgsp">
                    </div>
                </td>
                <td class="tdchitietsp">
                    <div class="thongtinchitietsp">
                        <table class="tbthongtinchitietsp">
                            <tr>
                                <td colspan="2">
                                    <div class="lbtentruyen">
                                        <label for="lbtentruyen">
                                            {{$product->name}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdgia" colspan="2">
                                    <div class="giatruyen">
                                        <p  class="gia">
                                            {{$product->priceVND}} <del class="giabandau">{{$product->list_priceVND}}</del>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtgnxbcol">
                                    <div class="tgnxbcol">
                                        <table class="tbtgnxbcol">
                                            <tr>
                                                <td class="tdlb">
                                                    <div class="lb">
                                                        <label for="lb">
                                                            Tác giả
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="tdlbten">
                                                    <div class="lbten">
                                                        <label for="lbten">
                                                            <a href="{{route('home.author',$product->author_slug)}}">{{$product->author}}</a>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="lb">
                                                        <label for="lb">
                                                            Năm xuất bản
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="lbten">
                                                        <label for="lbten">
                                                            {{$product->publish_year}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if($product->collection !== null)
                                            <tr>
                                                <td>
                                                    <div class="lb">
                                                        <label for="lb">
                                                            Collection
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="lbten">
                                                        <label for="lbten">
                                                            <a href="{{route('home.collection',$product->collection_slug)}}">{{$product->collection}}</a>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </td>
                                <td class="tdkttl">
                                    <div class="kttl">
                                        <table class="tbkttl">
                                            <tr>
                                                <td>
                                                    <div class="lb">
                                                        <label for="lb">
                                                            Kích thước
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="lbten">
                                                        <label for="lbten">
                                                            {{$product->size}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="lb">
                                                        <label for="lb">
                                                            Thể loại
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="lbten">
                                                        <label for="lbten">
                                                            {{$product->category_name}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="lbmota">
                                        <label for="lbmota">
                                            Mô tả
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="lbndmota">
                                        <label for="lbndmota">
                                            {{$product->description}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <form action="{{ route('user.cart.add',$product) }}" method="POST">
                                    @csrf
                                    <td class="tdslmua">
                                        <div class="soluongspmua">
                                            <label for="lbslmua">
                                                Số lượng
                                            </label>
                                            <input type="number" name="quantity" class="slmua" value="1" min="1" step="1">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btnadd">
                                            <button type="submit" class="btnthemvaogio">
                                                Thêm vào giỏ
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        @include('layout.footer')
    </div>
</div>
@endsection

@push('js')
@auth
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
                    // console.log(response);
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'Thêm thành công', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'slide', // fade, slide or plain
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 2, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    });
                    //lấy thẻ span có class soluongmua và thay bằng giá trị của response.data vào
                    $('.soluongmua').html(response.data);
                },
                error: function(response){
                    //console.log(response);
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
@endauth
@endpush
