@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.products.store')}}" method="post" >
    @csrf
    Tên truyện
    <input type="text" name="name" id="" value="{{ old('name') }}">
    <br>
    Mô tả
    <textarea name="description" id="" cols="50" rows="20"></textarea>
    <br>
    Ảnh sản phẩm
    <input type="text" name="image" id="">
    <br>
    Tác giả
    <input type="text" name="author" id="">
    <br>
    Giá
    <input type="number" name="price" id="">
    <br>
    Số lượng tồn
    <input type="number" name="quantity" id="">
    <br>
    Kích thước
    <input type="text" name="size" id="">
    <br>
    Năm xuất bản
    <input type="number" name="publish_year" id="">
    <br>
    Thể loại
    <select name="category">
        @foreach($arrProductCategory as $key => $value)
            <option value="{{$value}}">{{$key}}</option>
            @endforeach
    </select>
    <br>
    Bộ truyện
    <input type="text" name="collection" id="">
    <br>
    <input type="submit" value="Thêm">
</form>
