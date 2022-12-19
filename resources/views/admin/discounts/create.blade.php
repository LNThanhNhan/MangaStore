@extends('layout.admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm mã khuyến mãi </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Thêm mã khuyến mãi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            @if ( $errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="container-fluid">
                <form action="{{ route('admin.discounts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin chung</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên mã giảm giá</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Mã code</label>
                                        <input type="text" name="code" class="form-control" id="code" placeholder="" value="{{old('code')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Số lượng</label>
                                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="" value="{{old('quantity')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Loại mã</label>
                                        <select id="type" name="type" class="form-control">
                                            <option value="" selected>Chọn một</option>
                                            <option value=0 >Giảm theo phần trăm</option>
                                            <option value=1>Giảm theo giá tiền</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung mã</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="value">Giá trị</label>
                                    <input type="number" name="value" class="form-control" id="value" placeholder="" value="{{old('value')}}">
                                </div>
                                <div class="form-group">
                                    <label for="min_order"> Đơn hàng tối thiếu</label>
                                    <input type="number" name="min_order" class="form-control" id="min_order" placeholder="" value="{{old('min_order')}}">
                                </div>
                                <div class="form-group">
                                    <label for="max_discount"> Giảm giá tối đa</label>
                                    <input type="number" name="max_discount" class="form-control" id="max_discount" placeholder="" value="{{old('max_discount')}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="begin_at">Thời gian bắt đầu</label>
                                            <input type="datetime-local" name="begin_at" id="input" class="form-control" required="required" title="" value="{{old('begin_at')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group ">
                                            <label for="end_at">Thời gian kết thúc</label>
                                            <input type="datetime-local" name="end_at" id="input" class="form-control" required="required" title="" value="{{old('end_at')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success ">Thêm</button>
                                <a href="{{route('admin.discounts.index')}}" type="cancel" class="btn btn-danger  ">Hủy bỏ</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--@if ( $errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<form action="{{ route('admin.discounts.store') }}" method="POST">--}}
{{--    @csrf--}}
{{--    Tên mã giảm giá--}}
{{--    <input type="text" name="name" id="" value="{{ old('name') }}">--}}
{{--    <br>--}}
{{--    Mã giảm giá--}}
{{--    <input type="text" name="code" id="" value="{{ old('code') }}">--}}
{{--    <br>--}}
{{--    Loại mã giảm giá--}}
{{--    <select name="type">--}}
{{--        <option value="">Chọn loại giảm giá</option>--}}
{{--        <option value="0">Giảm theo phần trăm</option>--}}
{{--        <option value="1">Giảm theo số tiền</option>--}}
{{--    </select>--}}
{{--    <br>--}}
{{--    Giá trị--}}
{{--    <input type="number" name="value" id="" value="{{ old('value') }}">--}}
{{--    <br>--}}
{{--    Đơn hàng tối thiểu--}}
{{--    <input type="number" name="min_order" id="" value="{{ old('min_price') }}">--}}
{{--    <br>--}}
{{--    Giảm giá tối đa--}}
{{--    <input type="number" name="max_discount" id="" value="{{ old('max_discount') }}">--}}
{{--    Số lượng--}}
{{--    <input type="number" name="quantity" id="" value="{{ old('quantity') }}">--}}
{{--    <br>--}}
{{--    Thời gian bắt đầu--}}
{{--    <input type="datetime-local" name="begin_at" id="" value="{{ old('begin_at') }}">--}}
{{--    <br>--}}
{{--    Thời gian kết thúc--}}
{{--    <input type="datetime-local" name="end_at" id="" value="{{ old('end_at') }}">--}}
{{--    <br>--}}
{{--    <input type="submit" value="Thêm">--}}
{{--</form>--}}
{{--@endsection--}}
