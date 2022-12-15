@push('css')
    <link rel="stylesheet" href="{{ asset('css/TinTuc.css') }}">
@endpush
@extends('layout.master')
@section('content')
    <div class="containerTrangChu">
        @include('layout.header')
        <div class="contentTinTuc">
            <div class="tbcontentTinTuc">
                <table class="tbTinTuc">
                    <tr>
                        <td class="tdtrangchutintuc" colspan="2">
                            <div class="trangchutintuc">
                                <a href="" class="hreftrangchu">
                                    TRANG CHỦ
                                </a>
                                /
                                <a href="" class="hreftintuc">
                                    TIN TỨC
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdbaiviet">
                            <div class="baiviet">
                                <table class="tbbaiviet">
                                    @foreach($articles as $article)
                                    <tr>
                                        <td class="tdimagebaiviet">
                                            <div class="imagebaiviet">
                                                <img src="{{$article->image}}" class="imgbaiviet">
                                            </div>
                                        </td>
                                        <td class="tdnoidungbaiviet">
                                            <div class="tbnoidung">
                                                <table class="tablenoidungbaiviet">
                                                    <tr>
                                                        <td class="tdtieudebaiviet">
                                                            <div class="tieudebaiviet">
                                                                <a href="{{route('home.articles.detail',$article->slug)}}" class="tieudebaiviet">
                                                                    {{$article->title}}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdngaythang">
                                                            <div class="calendar">
                                                                <i class="fa-solid fa-calendar-days"></i>
                                                                <div class="lbngaythang">
                                                                    <label for="ngaythang">
                                                                        {{$article->created_date}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdcontentbaiviet">
                                                            <div class="contentbaiviet">
                                                                <a href="{{route('home.articles.detail',$article->slug)}}" class="hrefbaiviet">
                                                                    {{$article->description}}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdmore">
                                                            <div class="xemthem">
                                                                <a href="{{route('home.articles.detail',$article->slug)}}" class="hrefxemthem">
                                                                    Xem thêm <i class="fa-solid fa-caret-right"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="tdbtnpage" colspan="2">
                                            <nav>
                                                <ul class="pagination pagination-rounded mb-0">
                                                    <li>
                                                        {{$articles->links()}}
                                                    </li>
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td class="tdbaivietmoi">
                            <div class="tbbaivietnew">
                                <table class="tbbaivietmoi">
                                    <tr>
                                        <td class="tdlbbaivietmoi" colspan="2">
                                            <div class="lbbaivietmoi">
                                                <label for="lbbaivietmoi">
                                                    BÀI VIẾT MỚI NHẤT
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="tdhr">
                                            <div class="divhr"><hr class="hr"></div>
                                        </td>
                                    </tr>
                                    @foreach($newestArticles as $newestArticle)
                                        <tr>
                                            <td class="tdimg">
                                                <div class="imgbaivietmoi">
                                                    <img src="{{$newestArticle->image}}" class="imagebaivietmoi">
                                                </div>
                                            </td>
                                            <td class="tdtieudebaivietmoi">
                                                <div class="divtieudebaivietmoi">
                                                    <div class="href">
                                                        <a href="" class="tieudebaivietmoi">
                                                            {{$newestArticle->title}}
                                                        </a>
                                                    </div>
                                                    <div class="calendar">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <div class="lbngaythang">
                                                            <label for="ngaythang">
                                                                {{$newestArticle->created_date}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @include('layout.footer')
    </div>
 @include('layout.facebook-messenger')
@endsection
