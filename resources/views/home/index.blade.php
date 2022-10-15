<form action="{{route('search.products')}}">
<label for="">Tìm kiếm</label>
<input type="search" name="q" id="">
</form>
<h3>Mới nhất</h3>
<table>
    @foreach($products as $product)
        <tr>
            <td><img src="{{ $product->image}}" alt="" width="100" height="150"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
        </tr>
    @endforeach
</table>
