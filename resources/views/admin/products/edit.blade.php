@extends('layout.admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Sửa sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">
            @if ( $errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.products.update',$product)}}" method="post" >
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="name">Tên truyện</label>
                                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$product->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Mô tả</label>
                                            <textarea rows="5" cols="70" class="form-control" id="description" placeholder="" name="description" >{{$product->description}}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="author">Tác giả</label>
                                                    <input type="text" class="form-control" id="author" placeholder="" name="author" value="{{$product->author}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="publish_year">Năm xuất bản</label>
                                                    <input type="number" class="form-control" id="publish_year" placeholder="" name="publish_year" value="{{$product->publish_year}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="list_price">Giá niêm yết</label>
                                                    <input type="number" class="form-control" id="list_price" placeholder="" name="list_price" value="{{$product->list_price}}">
                                                </div>

                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="discount_rate">Chiết khấu</label>
                                                    <input type="number" class="form-control" id="discount_rate" placeholder="" name="discount_rate" value="{{$product->discount_rate}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label for="quantity">Số lượng</label>
                                                    <input type="int" class="form-control" id="quantity" placeholder="" name="quantity" value="{{$product->quantity}}">
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="size">Kích cỡ</label>
                                                    <input type="text" class="form-control" id="size" placeholder="" name="size" value="{{$product->size}}">
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="category">Thể loại</label>
                                                    <select id="category" name="category" class="form-control custom-select">
                                                        <option value="" selected>Chọn thể loại</option>
                                                        @foreach($arrProductCategory as $key => $value)
                                                            <option value="{{$value}}"
                                                                @if($value === $product->category)
                                                                    selected
                                                                @endif
                                                            >{{$key}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="collection">Bộ truyện</label>
                                            <input type="text" class="form-control" id="collection" placeholder="" name="collection" value="{{$product->collection}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Link ảnh sản phẩm</label>
                                            <input type="text" class="form-control" id="collection" placeholder="" name="image" value="{{$product->image}}">
                                        </div>
                                    </div>

                                </div>

                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="{{route('admin.products.index')}}" type="cancel" class="btn btn-danger ">Hủy bỏ</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<form action="{{route('admin.products.store')}}" method="post" >--}}
    {{--    @csrf--}}
    {{--    Tên truyện--}}
    {{--    <input type="text" name="name" id="" value="{{ old('name') }}">--}}
    {{--    <br>--}}
    {{--    Mô tả--}}
    {{--    <textarea name="description" id="" cols="50" rows="20"></textarea>--}}
    {{--    <br>--}}
    {{--    Ảnh sản phẩm--}}
    {{--    <input type="text" name="image" id="">--}}
    {{--    <br>--}}
    {{--    Tác giả--}}
    {{--    <input type="text" name="author" id="">--}}
    {{--    <br>--}}
    {{--    Giá niêm yết--}}
    {{--    <input type="number" name="list_price" id="">--}}
    {{--    <br>--}}
    {{--    Chiết khấu--}}
    {{--    <input type="number" name="discount_rate" id="" value="10">--}}
    {{--    <br>--}}
    {{--    Số lượng tồn--}}
    {{--    <input type="number" name="quantity" id="">--}}
    {{--    <br>--}}
    {{--    Kích thước--}}
    {{--    <input type="text" name="size" id="">--}}
    {{--    <br>--}}
    {{--    Năm xuất bản--}}
    {{--    <input type="number" name="publish_year" id="">--}}
    {{--    <br>--}}
    {{--    Thể loại--}}
    {{--    <select name="category">--}}
    {{--        @foreach($arrProductCategory as $key => $value)--}}
    {{--            <option value="{{$value}}">{{$key}}</option>--}}
    {{--            @endforeach--}}
    {{--    </select>--}}
    {{--    <br>--}}
    {{--    Bộ truyện--}}
    {{--    <input type="text" name="collection" id="">--}}
    {{--    <br>--}}
    {{--    <input type="submit" value="Thêm">--}}
    {{--</form>--}}
@endsection

{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<form action="{{route('admin.products.update',$product)}}" method="post" >--}}
{{--    @csrf--}}
{{--    @method('put')--}}
{{--    Tên truyện--}}
{{--    <input type="text" name="name" id="" value="{{$product->name}}">--}}
{{--    <br>--}}
{{--    Mô tả--}}
{{--    <textarea name="description" id="" cols="50" rows="20" >{{$product->description}}</textarea>--}}
{{--    <br>--}}
{{--    Ảnh sản phẩm <input type="text" name="image" id="" value="{{$product->image}}">--}}
{{--    <br>--}}
{{--    <img src="{{$product->image}}" alt="ảnh sản phẩm" width="100" height="150">--}}
{{--    <br>--}}
{{--    Tác giả--}}
{{--    <input type="text" name="author" id="" value="{{$product->author}}">--}}
{{--    <br>--}}
{{--    Giá niêm yết--}}
{{--    <input type="number" name="list_price" value="{{$product->list_price}}" id="">--}}
{{--    <br>--}}
{{--    Chiết khấu--}}
{{--    <input type="number" name="discount_rate" id="" value="{{$product->discount_rate}}">--}}
{{--    <br>--}}
{{--    Số lượng tồn--}}
{{--    <input type="number" name="quantity" id="" value="{{$product->quantity}}">--}}
{{--    <br>--}}
{{--    Kích thước--}}
{{--    <input type="text" name="size" id="" value="{{$product->size}}">--}}
{{--    <br>--}}
{{--    Năm xuất bản--}}
{{--    <input type="number" name="publish_year" id="" value="{{$product->publish_year}}">--}}
{{--    <br>--}}
{{--    Thể loại--}}
{{--    <select name="category">--}}
{{--        @foreach($arrProductCategory as $key => $value)--}}
{{--            <option value="{{$value}}"--}}
{{--                    @if($value == $product->category)--}}
{{--                    selected--}}
{{--                @endif--}}
{{--            >{{$key}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    <br>--}}
{{--    Bộ truyện--}}
{{--    <input type="text" name="collection" id="" value="{{$product->collection}}">--}}
{{--    <br>--}}
{{--    <input type="submit" value="Thay đổi" >--}}
{{--</form>--}}
{{--@endsection--}}
