@extends('layout.admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin khách hàng </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Thông tin khách hàng</li>
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
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Họ tên</label>
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$user->name}}">
                                    </div>
                                    <div class="radio">
                                        <label for="gender">Giới tính</label>
                                        <a>
                                            <input type="radio" name="gender" id="inputgender" value="1" checked="checked">
                                            Nam
                                        </a>
                                        <a>
                                            <input type="radio" name="gender" id="inputgender" value="0"
                                            @if($user->gender===0)
                                                checked
                                            @endif
                                            >
                                            Nữ
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$user->account->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại </label>
                                        <input type="text" class="form-control" id="phone" placeholder="" name="phone"
                                               @if($user->phone)
                                                   value="{{$user->phone}}"
                                               @else
                                                   value="Chưa cập nhật"
                                               @endif
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="quantity">Địa chỉ giao hàng</label>
                                        <input type="text" class="form-control" id="address" placeholder="" name="address"
                                               @if($user->address)
                                                   value="{{$user->address}}"
                                               @else
                                                   value="Chưa cập nhật"
                                               @endif
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Tỉnh/ thành</label>
                                        <input type="text" class="form-control" id="address" placeholder="" name="address"
                                               @if($user->province !== null)
                                                   value="{{getProvinceName($user->province)}}"
                                               @else
                                                   value="Chưa cập nhật"
                                               @endif
                                        >
                                    </div>
                                    <p><label>Ngày tạo tài khoản:</label> {{$user->account->created_at}}</p>
                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <a href="{{route('admin.users.index')}}" type="cancel" class="btn btn-success ">Quay lại</a>
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
{{--@if ( $errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--@if (session('success'))--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ session('success') }}--}}
{{--    </div>--}}
{{--@endif--}}
{{--<h1>Sửa thông tin khách hàng</h1>--}}
{{--<form action="{{route('admin.user.update',$user->id)}}" method="post">--}}
{{--    @csrf--}}
{{--    @method('PUT')--}}
{{--    <label>Họ tên</label>--}}
{{--    <input type="text" name="name" value="{{$user->name}}"> <br>--}}
{{--    <label>Số điện thoại</label>--}}
{{--    <input type="text" name="phone" value="{{$user->phone}}"> <br>--}}
{{--    <label>Địa chỉ</label>--}}
{{--    <input type="text" name="address" value="{{$user->address}}"> <br>--}}
{{--    <label for="">Tỉnh/Thành phố</label>--}}
{{--    <select name="province" >--}}
{{--        <option value="0" selected>Chọn tỉnh/thành phố</option>--}}
{{--        @foreach($provinces as $key => $value)--}}
{{--            <option value="{{$value}}"--}}
{{--                    @if($value === $user->province)--}}
{{--                        selected--}}
{{--                @endif--}}
{{--            >{{$key}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    <br>--}}
{{--    <label for="">Giới tính</label>--}}
{{--    <br>--}}
{{--    <input type="radio" name="Nam" value="1"--}}
{{--           checked--}}
{{--    >--}}
{{--    <label for="">Nam</label>--}}
{{--    <input type="radio" name="Nữ" value="0"--}}
{{--           @if ($user->gender === 0)--}}
{{--               checked--}}
{{--        @endif--}}
{{--    >--}}
{{--    <label for="">Nữ</label>--}}
{{--    <br>--}}
{{--    <button type="submit">Cập nhật</button>--}}
{{--</form>--}}
{{--@endsection--}}
