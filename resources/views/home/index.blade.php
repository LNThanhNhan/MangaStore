@extends('layout.master')
@push('css')
<link rel="stylesheet" href="{{ asset('css/TrangChu.css') }}">
<style>
    table,tr,td{
        border-collapse: collapse;
    }
</style>
@endpush
@section('content')

<div class="containerSanPham">

    @include('layout.header')
    <div class="contentTrangChu">
        <div class="display">
            <div class="bannerlist">
                <div class="banner">
                    <img src="{{asset('image/ms_banner_img3 1.png')}}" class="imgbanner1">
                </div>
                <div class="banner">
                    <img src="{{asset('image/ms_banner_img1 (1).png')}}" class="imgbanner">
                </div>
            </div>
        </div>
        <div class="listsp">
            <table class="spban">
                <tr>
                    <td>
                        <div class="tbsp">
                            <table class="tblistsp">
                                <tr>
                                    <td class="tdspmoi">
                                        <div class="sachmoi">
                                            <a href="" class="hrefspmoi">
                                                MỚI
                                            </a>
                                            <div class="divhr">
                                                <hr class="hr">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="tdspbanchay">
                                        <div class="sachbanchay">
                                            <a href="" class="hrefspbanchay">
                                                BÁN CHẠY
                                            </a>
                                            <div class="divhr">
                                                <hr class="hr">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="tdsphot">
                                        <div class="sachhot">
                                            <a href="" class="hrefsphot">
                                                HOT DEALS
                                            </a>
                                            <div class="divhr">
                                                <hr class="hr">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="danhsachsp">
                        <div class="tbtatcasp">
                            <table class="tatcasp">
                                <tr>
                                @foreach($products as $index=> $product)
                                    @if($index <= 4)
                                        <td class="tdsp">
                                            <a href="{{route('home.detail',$product->slug)}}" style="text-decoration: none">
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
                                                    <label for="lbsp">
                                                        {{$product->name}}
                                                    </label>
                                                </div>
                                                <div class="giasp">
                                                    <a href="{{route('home.detail',$product->slug)}}" class="htgiasp">
                                                        {{$product->priceVND}}
                                                    </a>
                                                </div>
                                            </div>
                                            </a>
                                        </td>
                                    @endif
                                @endforeach
                                </tr>
                                <tr>
                                    @foreach($products as $index=> $product)
                                        @if($index > 4)
                                            <td class="tdsp">
                                                <a href="{{route('home.detail',$product->slug)}}" style="text-decoration: none">
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
                                                        <label for="lbsp">
                                                            {{$product->name}}
                                                        </label>
                                                    </div>
                                                    <div class="giasp">
                                                        <a href="{{route('home.detail',$product->slug)}}" class="htgiasp">
                                                            {{$product->priceVND}}
                                                        </a>
                                                    </div>
                                                </div>
                                                </a>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="tdbutton">
                        <div class="buttonmore">
                            <button class="btnxemthem">
                                XEM THÊM
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="tdhr">
                        <div class="divhr2">
                            <hr class="hr2">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="tdbaivietmoi">
                        <div class="labelbaivietmoi">
                            <label for="baivietmoi">
                                BÀI VIẾT MỚI
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="tabletintuc">
                        <div class="tbtintuc">
                            <table class="tablenews">
                                <tr>
                                    @foreach($articles as $article)
                                        <td class="tdnews1">
                                            <table class="tbnews">
                                                <tr>
                                                    <td class="tdimg">
                                                        <div class="news">
                                                            <img src="{{ $article->image }}" class="imgnews">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdngaythangnam">
                                                        <div class="ngaythangnam">
                                                            <span class="ngayupdate">
                                                                {{ $article->created_date }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdtieudenew">
                                                        <div class="hreftieudenew">
                                                            <a href="{{route('home.articles.detail',$article->slug)}}" class="tieudenews">
                                                                {{ $article->title }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdnoidungnews">
                                                        <div class="noidungnews">
                                                            {{ $article->description }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @include('layout.footer')
</div>
@endsection
