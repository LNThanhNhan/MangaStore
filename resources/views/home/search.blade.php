<form class="float-end" action="{{route('home.search')}}">
    <label>
        Tìm kiếm:
    </label>
    <input type="search" name="q" id="" value="{{ $search }}">
</form>
<table>
    @foreach($products as $product)
        <tr>
            <td><img src="{{ $product->image}}" alt="" width="100" height="150"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
        </tr>
    @endforeach
</table>
