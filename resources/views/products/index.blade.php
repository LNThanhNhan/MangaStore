<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<h1>Tất cả đầu truyện</h1>
<a href="{{route('products.create')}}">Thêm</a>
<table border="1" width="100%">
    <caption>
        <form action="">
            <lable>
                Tìm kiếm:
            </lable>
            <input type="search" name="q" id="" value="{{ $search }}">
        </form>
    </caption>
    <tr>
        <th>#</th>
        <th >Tên truyện</th>
        <th>Tác giả</th>
        <th>Giá</th>
        <th>Số lượng tồn</th>
        <th>Năm xuất bản</th>
        <th>Kích thước</th>
        <th>Thể loại</th>
        <th>Bộ truyện</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->author }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->publish_year }}</td>
        <td>{{ $product->size }}</td>
        <td>{{ $product->category }}</td>
        <td>{{ $product->collection }}</td>
        <td>
            <a href="{{route('products.edit',$product)}}">
                Sửa
            </a>
        </td>
        <td>
            <form action="{{route('products.destroy',$product)}}" method="post">
                @csrf
                @method('DELETE')
                <button>Xóa</button>
            </form>
        </td>
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

