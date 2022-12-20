@extends('layout.admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm nhân viên mới </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Thêm nhân viên mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <!-- general form elements -->
                <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.employees.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Họ tên</label>
                                        <input type="text" class="form-control" id="name" placeholder="" name="name">
                                    </div>
                                    <div class="radio">
                                        <label for="gender">Giới tính</label>
                                        <a>
                                            <input type="radio" name="gender" id="inputgender" value="1" checked="checked">
                                            Nam
                                        </a>
                                        <a>
                                            <input type="radio" name="gender" id="inputgender" value="0">
                                            Nữ
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" id="email" placeholder="" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Tên tài khoản </label>
                                        <input type="text" class="form-control" id="username" placeholder="" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu </label>
                                        <input type="password" class="form-control" id="password" placeholder="" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Nhập lại mật khẩu </label>
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh</label>
                                        <input type="date" name="birthday" id="birthday" class="form-control"  required="required" >
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại </label>
                                        <input type="text" class="form-control" id="phone" placeholder="" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Địa chỉ nơi ở</label>
                                        <input type="text" class="form-control" id="address" placeholder="" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Tại tỉnh/thành</label>
                                        <select name="province" id="quantity" class="form-control">
                                            <option value="0" selected>Chọn tỉnh/thành phố</option>
                                            @foreach($arrProvince as $key => $value)
                                                <option value="{{$value}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="salary">Tiền lương</label>
                                        <input type="number" class="form-control" id="size" placeholder="" name="salary">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Chức vụ</label>
                                        <select name="role"  id="inputstatus" class="form-control" >
                                            <option value="" selected>Chọn chức vụ</option>
                                            <option value="1" >Quản lý</option>
                                            <option value="2" >Nhân viên</option>
                                        </select><br>
                                    </div>

                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary ">Thêm</button>
                                <a href="{{route('admin.employees.index')}}" type="cancel" class="btn btn-danger ">Hủy bỏ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
{{--<form action="{{route('admin.employees.store')}}" method="POST">--}}
{{--    @csrf--}}
{{--    Tên đăng nhập--}}
{{--    <input type="text" name="username" value="{{ old('username') }}"><br>--}}
{{--    Email--}}
{{--    <input type="text" name="email" value="{{ old('email') }}"><br>--}}
{{--    Mật khẩu--}}
{{--    <input type="password" name="password" value="{{ old('password') }}"><br>--}}
{{--    Nhập lại mật khẩu--}}
{{--    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"><br>--}}

{{--    Họ và tên nhân viên--}}
{{--    <input type="text" name="name" value="{{ old('name') }}"><br>--}}
{{--    Ngày sinh--}}
{{--    <input type="date" name="birthday" value="{{ old('birthday') }}"><br>--}}
{{--    Giới tính--}}
{{--    <br><label for="">Nam</label>--}}
{{--    <input type="radio" name="gender" value=1 >--}}
{{--    <label for="">Nữ</label>--}}
{{--    <input type="radio" name="gender" value=0 ><br>--}}
{{--    Số điện thoại--}}
{{--    <input type="text" name="phone" value="{{ old('phone') }}"><br>--}}
{{--    Địa chỉ--}}
{{--    <input type="text" name="address" value="{{ old('address') }}"><br>--}}
{{--    Tỉnh/Thành phố--}}
{{--    <select name="province" >--}}
{{--        <option value="0" selected>Chọn tỉnh/thành phố</option>--}}
{{--        @foreach($arrProvince as $key => $value)--}}
{{--            <option value="{{$value}}">{{$key}}</option>--}}
{{--        @endforeach--}}
{{--    </select><br>--}}
{{--    Lương--}}
{{--    <input type="number" name="salary" value="{{ old('salary') }}"><br>--}}
{{--    Chức vụ--}}
{{--    <select name="role" >--}}
{{--        <option value="0" selected>Chọn chức vụ</option>--}}
{{--        <option value="1" >Quản lý</option>--}}
{{--        <option value="2" >Nhân viên</option>--}}
{{--    </select><br>--}}
{{--    <button type="submit">Thêm nhân viên</button>--}}
{{--</form>--}}
{{--@endsection--}}
