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
<ul>
@foreach($arrProductCategory as $key => $value)
    <li>
        <label>
            <a href="{{route('home.category',$value)}}">
                <input type="checkbox" name="{{$key}}" value="{{$value}}"
                    @if(isset($checkValue) && (int)$checkValue === $value)
                    checked
                       @endif
                >
            </a>
            <span>{{$key}}</span>
        </label>
    </li>
@endforeach
</ul>
