@extends('layout.master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.employees.update',$employee->id)}}" method="POST">
    @csrf
    @method('PUT')
    Họ và tên nhân viên
    <input type="text" name="name" value="{{ $employee->name }}"><br>
    Ngày sinh
    <input type="date" name="birthday" value="{{ $employee->birthday }}"><br>
    Giới tính
    <br><label for="">Nam</label>
    <input type="radio" name="gender" value=1 checked>
    <label for="">Nữ</label>
    <input type="radio" name="gender" value=0
        @if($employee->gender === 0)
            checked
        @endif
    ><br>
    Số điện thoại
    <input type="text" name="phone" value="{{ $employee->phone }}"><br>
    Địa chỉ
    <input type="text" name="address" value="{{ $employee->address }}"><br>
    Tỉnh/Thành phố
    <select name="province" >
        <option value="0" selected>Chọn tỉnh/thành phố</option>
        @foreach($arrProvince as $key => $value)
            <option value="{{$value}}"
                @if($employee->province === $value)
                    selected
                @endif
            >{{$key}}</option>
        @endforeach
    </select><br>
    Lương
    <input type="number" name="salary" value="{{ $employee->salary }}"><br>
    Trạng thái
    <select name="status" >
        <option value="" selected>Chọn trạng thái</option>
        <option value=0 @if(@$employee->status===0) selected @endif>Đang làm việc</option>
        <option value=1 @if(@$employee->status===1) selected @endif>Đã nghỉ</option>
    </select><br>
    Chức vụ
    <select name="role" >
        <option value="0" selected>Chọn chức vụ</option>
        <option value="1" >Quản lý</option>
        <option value="2" >Chọn chức vụ</option>
    </select><br>
    <button type="submit">Cập nhật nhân viên</button>
</form>
@endsection
