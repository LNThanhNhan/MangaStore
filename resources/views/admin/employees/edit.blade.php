@extends('layout.admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật nhân viên</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cập nhật nhân viên</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.employees.update',$employee->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="name">Họ tên</label>
                                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$employee->name}}">
                                        </div>
                                        <div class="radio">
                                            <label for="gender">Giới tính</label>
                                            <a>
                                                <input type="radio" name="gender" id="inputgender" value="1" checked="checked">
                                                Nam
                                            </a>
                                            <a>
                                                <input type="radio" name="gender" id="inputgender" value="0"
                                                    @if($employee->gender === 0) checked @endif>
                                                Nữ
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday">Ngày sinh</label>
                                            <input type="date" name="birthday" id="birthday" class="form-control"  required="required" value="{{$employee->birthday}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại </label>
                                            <input type="text" class="form-control" id="phone" placeholder="" name="phone" value="{{$employee->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Trạng thái làm việc</label>
                                            <select name="status"  id="status" class="form-control" >
                                                <option value="" >Chọn trạng thái</option>
                                                <option value="0"
                                                            selected
                                                >Đang làm</option>
                                                <option value="1"
                                                        @if($employee->status === 1)
                                                            selected
                                                       @endif
                                                >Đã nghỉ</option>
                                            </select><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="quantity">Địa chỉ nơi ở</label>
                                            <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{$employee->address}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Tại tỉnh/thành</label>
                                            <select name="province" id="quantity" class="form-control">
                                                <option value="0" selected>Chọn tỉnh/thành phố</option>
                                                @foreach($arrProvince as $key => $value)
                                                    <option value="{{$value}}"
                                                        @if($employee->province === $value)
                                                            selected
                                                        @endif
                                                    >{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="salary">Tiền lương (VNĐ)</label>
                                            <input type="number" class="form-control" id="size" placeholder="" name="salary" value="{{$employee->salary}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Chức vụ</label>
                                            <select name="role"  id="role" class="form-control" >
                                                <option value="" selected>Chọn chức vụ</option>
                                                <option value="1"
                                                        @if($employee->account->role === 1)
                                                            selected
                                                        @endif
                                                >Quản lý</option>
                                                <option value="2"
                                                        @if($employee->account->role === 2)
                                                            selected
                                                       @endif
                                                >Nhân viên</option>
                                            </select><br>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary ">Cập nhật</button>
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
{{--<form action="{{route('admin.employees.update',$employee->id)}}" method="POST">--}}
{{--    @csrf--}}
{{--    @method('PUT')--}}
{{--    Họ và tên nhân viên--}}
{{--    <input type="text" name="name" value="{{ $employee->name }}"><br>--}}
{{--    Ngày sinh--}}
{{--    <input type="date" name="birthday" value="{{ $employee->birthday }}"><br>--}}
{{--    Giới tính--}}
{{--    <br><label for="">Nam</label>--}}
{{--    <input type="radio" name="gender" value=1 checked>--}}
{{--    <label for="">Nữ</label>--}}
{{--    <input type="radio" name="gender" value=0--}}
{{--        @if($employee->gender === 0)--}}
{{--            checked--}}
{{--        @endif--}}
{{--    ><br>--}}
{{--    Số điện thoại--}}
{{--    <input type="text" name="phone" value="{{ $employee->phone }}"><br>--}}
{{--    Địa chỉ--}}
{{--    <input type="text" name="address" value="{{ $employee->address }}"><br>--}}
{{--    Tỉnh/Thành phố--}}
{{--    <select name="province" >--}}
{{--        <option value="0" selected>Chọn tỉnh/thành phố</option>--}}
{{--        @foreach($arrProvince as $key => $value)--}}
{{--            <option value="{{$value}}"--}}
{{--                @if($employee->province === $value)--}}
{{--                    selected--}}
{{--                @endif--}}
{{--            >{{$key}}</option>--}}
{{--        @endforeach--}}
{{--    </select><br>--}}
{{--    Lương--}}
{{--    <input type="number" name="salary" value="{{ $employee->salary }}"><br>--}}
{{--    Trạng thái--}}
{{--    <select name="status" >--}}
{{--        <option value="" selected>Chọn trạng thái</option>--}}
{{--        <option value=0 @if(@$employee->status===0) selected @endif>Đang làm việc</option>--}}
{{--        <option value=1 @if(@$employee->status===1) selected @endif>Đã nghỉ</option>--}}
{{--    </select><br>--}}
{{--    Chức vụ--}}
{{--    <select name="role" >--}}
{{--        <option value="0" selected>Chọn chức vụ</option>--}}
{{--        <option value="1" >Quản lý</option>--}}
{{--        <option value="2" >Nhân viên</option>--}}
{{--    </select><br>--}}
{{--    <button type="submit">Cập nhật nhân viên</button>--}}
{{--</form>--}}
{{--@endsection--}}
