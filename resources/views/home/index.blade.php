<form action="{{route('home.search')}}">
<label for="">Tìm kiếm</label>
<input type="search" name="q" id="">
</form>
@auth
    <a href="{{ route('user.profile.info') }}" >Thông tin cá nhân</a>
@else
<a href="{{ route('login') }}" >Log in</a>
<a href="{{ route('register') }}" >Register</a>
@endauth
<h3>Mới nhất</h3>
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
