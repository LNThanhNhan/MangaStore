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
<div class="containerDangKy">
    @include('layout.header')
    <div class="contentChiTietSanPham">
        <div class="tieude">
            <a href="" class="hreftrangchu">
                TRANG CHỦ
            </a>
            /
            <a href="" class="hreftrinhtham">
                {{$product->category_name}}
            </a>
            /
            <a href="" class="hreftentruyen">
                {{$product->name}}
            </a>
        </div>
        <div class="noidungsanpham">
            <div class="imagesp">
                <img src="{{$product->image}}" class="imgsp">
            </div>
            <div class="motasanpham">
                <div class="lbtentruyen">
                    <label for="lbtentruyen">
                        {{$product->name}}
                    </label>
                </div>
                <div class="giatruyen">
                    <a href="" class="gia">
                        {{$product->priceVND}} <del class="giabandau">{{$product->list_priceVND}}</del>
                    </a>
                </div>
                <div class="thongtin">
                    <div class="lb">
                        <label for="lb">
                            Tác giả
                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">
                            <a href="{{route('home.author',$product->author_slug)}}" style="text-decoration: none">
                                {{$product->author}}
                            </a>
                        </label>
                    </div>
                    <div class="lb">
                        <label for="lb">
                            Kích thước
                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">
                            {{$product->size}}
                        </label>
                    </div>
                </div>
                <div class="thongtin">
                    <div class="lb">
                        <label for="lb">
                            Năm xuất bản
                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">
                            {{$product->publish_year}}
                        </label>
                    </div>
                    <div class="lb">
                        <label for="lb">
                            Thể loại
                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">
                            <a href="{{route('home.category',$product->category)}}" style="text-decoration: none">
                                {{$product->category_name}}
                            </a>
                        </label>
                    </div>
                </div>
                <div class="thongtin">
                    @if($product->collection !==null)
                    <div class="lb">
                        <label for="lb">
                            Collection
                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">
                            <a href="{{route('home.collection',$product->collection_slug)}}" style="text-decoration: none">
                                {{$product->collection_slug}}
                            </a>
                        </label>
                    </div>
                    @endif
                    <div class="lb">
                        <label for="lb">

                        </label>
                    </div>
                    <div class="lbten">
                        <label for="lbten">

                        </label>
                    </div>
                </div>
                <div class="lbmotand">
                    <label for="lbmotand">
                        Mô tả
                    </label>
                </div>
                <div class="lbndmota">
                    <label for="lbndmota">
                        {{$product->description}}
                    </label>
                </div>
                @if($product->quantity > 0)
                    <form action="{{ route('user.cart.add',$product) }}" class="soluong" method="POST">
                        @csrf
                        <div class="soluongspmua">
                            <label for="lbslmua">
                                Số lượng
                            </label>
                            <input name="quantity" type="number" class="slmua" value="1" min="1" step="1">
                        </div>
                        <div class="btnadd">
                            <button class="btnthemvaogio">
                                Thêm vào giỏ
                            </button>
                        </div>
                    </form>
                @else
                    <div class="soluong">
                        <div class="btnadd">
                                <button class="btnthemvaogio">
                                    Hết hàng
                                </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="cungtg">
            <div class="lbcungtg">
                <label for="lbcungtg">
                    CÙNG TÁC GIẢ
                </label>
            </div>
            <div class="sanphamcungtg">
                @foreach($sameAuthor as $product)
                    <div class="thongtinsanpham">
                        <div class="imagesp">
                            <img src="{{$product->image}}" class="imgspcungtg">
                        </div>
                        <div class="thongtinspcungtg">
                            <div class="namemoney">
                                <a href="{{route('home.detail',$product->slug)}}" class="hrefsp">
                                    {{$product->name}}
                                </a>
                            </div>
                            <div class="giasp">
                                <a href="" class="hrefgiasp">
                                    {{$product->priceVND}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="buttonxemthem">
                <button class="btnmore">
                    <a href="{{route('home.author',$product->author_slug)}}" style="text-decoration: none; color: white">
                        XEM THÊM
                    </a>
                </button>
            </div>
        </div>
        <div class="divhr">
            <hr class="hr">
        </div>
        <div class="lbsplienquan">
            <label for="lbsplienquan">
                SẢN PHẨM LIÊN QUAN
            </label>
        </div>
        <div class="sanphamlienquan">
            @foreach($sameCategory as $product)
                <div class="thongtinsplienquan">
                    <div class="imgsanpham">
                        <img src="{{$product->image}}" class="image">
                    </div>
                    <div class="tensp">
                        <a href="{{route('home.detail',$product->slug)}}" class="hreftensp">
                            {{$product->name}}
                        </a>
                    </div>
                    <div class="money">
                        <a href="" class="hrefmoney">
                            {{$product->priceVND}}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="buttonxemthem">
            <button class="btnmore">
                <a href="{{route('home.category',$product->category)}}" style="text-decoration: none; color: white">
                    XEM THÊM
                </a>
            </button>
        </div>
    </div>
    @include('layout.footer')
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
                    $('.soluongmua').text(response.data);
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
