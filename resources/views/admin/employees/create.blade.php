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
<form action="{{route('admin.employees.store')}}" method="POST">
    @csrf
    Tên đăng nhập
    <input type="text" name="username" value="{{ old('username') }}"><br>
    Email
    <input type="text" name="email" value="{{ old('email') }}"><br>
    Mật khẩu
    <input type="password" name="password" value="{{ old('password') }}"><br>
    Nhập lại mật khẩu
    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"><br>

    Họ và tên nhân viên
    <input type="text" name="name" value="{{ old('name') }}"><br>
    Ngày sinh
    <input type="date" name="birthday" value="{{ old('birthday') }}"><br>
    Giới tính
    <br><label for="">Nam</label>
    <input type="radio" name="gender" value=1 >
    <label for="">Nữ</label>
    <input type="radio" name="gender" value=0 ><br>
    Số điện thoại
    <input type="text" name="phone" value="{{ old('phone') }}"><br>
    Địa chỉ
    <input type="text" name="address" value="{{ old('address') }}"><br>
    Tỉnh/Thành phố
    <select name="province" >
        <option value="0" selected>Chọn tỉnh/thành phố</option>
        @foreach($arrProvince as $key => $value)
            <option value="{{$value}}">{{$key}}</option>
        @endforeach
    </select><br>
    Lương
    <input type="number" name="salary" value="{{ old('salary') }}">
    <button type="submit">Thêm nhân viên</button>
</form>
@endsection
