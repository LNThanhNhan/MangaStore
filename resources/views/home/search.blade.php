@extends('layout.master')
@section('content')
<form class="float-end" action="{{route('home.search')}}">
    <label>
        Tìm kiếm:
    </label>
    <input type="search" name="q" id="" value="{{ $search }}">
</form>
<h1>{{$search}}</h1>
<table>
    @foreach($products as $product)
        <tr>
            <td>
                <a href="{{ route('home.detail',$product->slug) }}">
                    <img src="{{ $product->image}}" alt="" width="100" height="150">
                </a>
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price_VND }}</td>
        </tr>
    @endforeach
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        <li>
            {{$products->links()}}
        </li>
    </ul>
</nav>
@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('home.filter')}}" method="GET">
    @foreach($arrProductCategory as $key => $value)
        <div>
            <input type="checkbox" name="{{$key}}" value="{{$value}}"
                   @if(isset($_GET[str_replace(' ','_',$key)]))
                       checked
                   @endif
            >
            <label>{{$key}}</label>
        </div>
    @endforeach
    Khoảng giá
    <br>
    Tối thiểu
    <input type="number" name="min_price" id=""
           @if ( isset($_GET['min_price']))
               value="{{$_GET['min_price']}}"
        @endif
    >
    Tối đa
    <input type="number" name="max_price" id=""
           @if ( isset($_GET['max_price']) )
               value="{{$_GET['max_price']}}"
        @endif
    >
    <br>
    <input type="submit" value="Lọc">
</form>
@endsection
