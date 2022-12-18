@push('css')
    <link rel="stylesheet" href="{{ asset('css/TimKiem.css') }}">
@endpush
@extends('layout.master')
@section('content')
<div class="containerSanPham">
    @include('layout.header')
    <div class="contentSanPham">
        <div class="tcdmtcsp">
            <a href="" class="hreftrangchu">
                Trang chủ
            </a>
            /
            <a href="" class="hrefdanhmuc">
                Danh mục
            </a>
            /
            <a href="" class="hreftcsp">
                Tất cả sản phẩm
            </a>
        </div>
        <div class="noidungcontentsanpham">
            <div class="noidungdanhmucsp">
                <div class="lbdanhmuc">
                    <label for="lbdanhmuc">
                        DANH MỤC
                    </label>
                </div>
                <div class="divhr">
                    <hr class="hr">
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{route('home.filter')}}" method="get">
                    <div class="danhsachdanhmuc">
                        <ul>
                            @foreach($arrProductCategory as $key => $value)
                                <li>
                                    <input type="checkbox" name="{{$key}}" class="checkbox" value="{{$value}}"
                                           @if(isset($_GET[str_replace(' ','_',$key)]))
                                               checked
                                        @endif
                                    /><span>{{$key}}</span><br/>
                                    <div class="divhr">
                                        <hr class="hr">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="divhr">
                        <hr class="hr">
                    </div>
                    <div class="lbkhoanggia">
                        <label for="lbkhoanggia">
                            GIÁ
                        </label>
                    </div>

                    <div class="lbchonmucgia">
                        <label for="lbchonmucgia">
                            Chọn khoảng giá
                        </label>
                    </div>
                    <div class="nhapkhoang">
                        <p>
                            <input step="1000" type="number" class="inputkhoanggia" placeholder=0 name="min_price"
                                   @if ( isset($_GET['min_price']))
                                       value="{{$_GET['min_price']}}"
                                @endif
                            >
                            - <input step="1000" type="number"  class="inputkhoanggia" placeholder=0 name="max_price"
                                     @if ( isset($_GET['max_price']))
                                         value="{{$_GET['max_price']}}"
                                @endif
                            >
                        </p>
                    </div>
                    <div class="apdung">
                        <button type="submit" class="btnapdung">
                            Áp dụng
                        </button>
                    </div>
                </form>
            </div>
            <div class="tatcasp">
                <div class="lbtcsp">
                    <label for="lbtcsp">
                        TẤT CẢ SẢN PHẨM
                    </label>
                </div>
                <div class="thongtinsanpham">
                    @foreach($products as $product)
                        <div class="thongtincacsp">
                            <a href="" class="sanphamtruyen">
                                <div class="imagesp">
                                    <img src="{{$product->image}}" class="imgsp">
                                </div>
                                <div class="makhuyenmai">
                                    <div class="imagemagiam">
                                        <img src="{{asset('image/magiam.png')}}" class="imgmagiam">
                                    </div>
                                    <div class="sale">
                                        <span class="lbsale">-{{$product->discount_rate}}%</span>
                                    </div>
                                </div>
                                <div class="thongtinsp">
                                    <div class="lbsp">
                                        <a href="" class="name">
                                            {{$product->name}}
                                        </a>
                                    </div>
                                    <div class="giasp">
                                        <a href="" class="htgiasp">
                                            {{$product->price_VND}}
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="page">
                    <nav>
                        <ul class="pagination pagination-rounded mb-0">
                            <li>
                                {{$products->links()}}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footer')
</div>
@include('layout.facebook-messenger')
{{--<table>--}}
{{--    @foreach($products as $product)--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <a href="{{ route('home.detail',$product->slug) }}">--}}
{{--                    <img src="{{ $product->image}}" alt="" width="100" height="150">--}}
{{--                </a>--}}
{{--            </td>--}}
{{--            <td>{{ $product->name }}</td>--}}
{{--            <td>{{ $product->price_VND }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
{{--<nav>--}}
{{--    <ul class="pagination pagination-rounded mb-0">--}}
{{--        <li>--}}
{{--            {{$products->links()}}--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</nav>--}}
{{--@if ( $errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}



{{--<form action="{{route('home.filter')}}" method="GET">--}}
{{--    @foreach($arrProductCategory as $key => $value)--}}
{{--        <div>--}}
{{--            <input type="checkbox" name="{{$key}}" value="{{$value}}"--}}
{{--                   @if(isset($_GET[str_replace(' ','_',$key)]))--}}
{{--                       checked--}}
{{--                   @endif--}}
{{--            >--}}
{{--            <label>{{$key}}</label>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--    Khoảng giá--}}
{{--    <br>--}}
{{--    Tối thiểu--}}
{{--    <input type="number" name="min_price" id=""--}}
{{--           @if ( isset($_GET['min_price']))--}}
{{--               value="{{$_GET['min_price']}}"--}}
{{--        @endif--}}
{{--    >--}}
{{--    Tối đa--}}
{{--    <input type="number" name="max_price" id=""--}}
{{--           @if ( isset($_GET['max_price']) )--}}
{{--               value="{{$_GET['max_price']}}"--}}
{{--        @endif--}}
{{--    >--}}
{{--    <br>--}}
{{--    <input type="submit" value="Lọc">--}}
{{--</form>--}}
@endsection
