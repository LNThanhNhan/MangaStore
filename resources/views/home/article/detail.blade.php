@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/TinTuc.css') }}">
    <style>
        table,tr,td{
            border-collapse: collapse;
        }
    </style>
@endpush
@section('content')
    <div class="contentTinTuc">
        @include('layout.header')
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
                            <h3>{{$article->title}}</h3>
                            {!! $article->content !!}
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
                                @foreach ($newestArticles as $newArticle)
                                <tr>
                                    <td class="tdimg">
                                        <div class="imgbaivietmoi">
                                            <img src="{{$newArticle->image}}" class="imagebaivietmoi">
                                        </div>
                                    </td>
                                    <td class="tdtieudebaivietmoi">
                                        <div class="divtieudebaivietmoi">
                                            <div class="href">
                                                <a href="" class="tieudebaivietmoi">
                                                    {{$newArticle->title}}
                                                </a>
                                            </div>
                                            <div class="calendar">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <div class="lbngaythang">
                                                    <label for="ngaythang">
                                                        {{$newArticle->created_date}}
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
        @include('layout.footer')
    </div>
    @include('layout.facebook-messenger')
@endsection
{{--<h1>{{$article->title}}</h1>--}}
{{--{!! $article->content !!}--}}
