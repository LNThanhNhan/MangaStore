@push('css')
    <link rel="stylesheet" href="{{ asset('css/ThongTin.css') }}">

@endpush
@extends('layout.master')
@section('content')
    <style>
        table,tr,td{
            border-collapse: collapse;
        }
    </style>
<div class="containerThongTinCaNhan">
    @include('layout.header')
    <div class="contentThongTinCaNhan">
        <div class="thongtincanhan">
            <div class="taikhoan">
                <div class="lbTenTK">
                    <label for="tentk">
                        {{$user->name}}
                    </label>
                </div>
                <div class="btnTTCN">
                    <button class="btnThongTinCaNhan">
                        <a href="{{route('user.profile.info')}}" style="text-decoration: none;color: black">
                            Thông tin cá nhân
                        </a>
                    </button>
                </div>
                <div class="btnDSDH">
                    <button class="btnDanhSachDonHang">
                        <a href="{{route('user.order.index')}}" style="text-decoration: none;color: black">
                            Danh sách đơn hàng
                        </a>
                    </button>
                </div>
                <div class="btnThoat">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="btnExit">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
            <div class="divclasshr">
                <hr class="hr" width="0.5" size="180">
            </div>
            <div class="thongtintk">
                <div class="lbtttk">
                    <label for="tentk">
                        THÔNG TIN TÀI KHOẢN
                    </label>
                </div>
                @if ( $errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <form method="post" action="{{route('user.profile.update',$user->id)}}">
                    @csrf
                    @method('PUT')
                <div class="hoten">
                    <div class="lbhoten">
                        <label for="lbhoten">
                            Họ tên
                        </label>
                    </div>
                    <div class="texthoten">
                        <input type="text" name="name" placeholder="Nhập họ tên" class="inputhoten" value="{{old('name',$user->name)}}">
                    </div>
                </div>
                <div class="email">
                    <div class="lbmailuser">
                        <label for="lbmailuser">
                            Email
                        </label>
                    </div>
                    <div class="textmail">
                        <input type="email" name="email"  placeholder="Nhập Email" class="inputmail" value="{{$user->account->email}}" readonly>
                    </div>
                </div>
                <div class="sdt">
                    <div class="lbsodienthoai">
                        <label for="lbsodienthoai">
                            Số điện thoại
                        </label>
                    </div>
                    <div class="textsdt">
                        <input type="text" placeholder="Nhập số điện thoại" class="inputsdt" value="{{old('phone',$user->phone)}}">
                    </div>
                </div>
                <div class="diachi">
                    <div class="lbdiachi">
                        <label for="lbdiachi">
                            Địa chỉ
                        </label>
                    </div>
                    <div class="textdiachi">
                        <textarea name="Địa chỉ" id="inputdiachi" rows="2" placeholder="Nhập địa chỉ">
                            {{old('address',$user->address)}}
                        </textarea>
                    </div>
                </div>
                <div class="tinhthanh">
                    <div class="lbtinhthanh">
                        <label for="lbtinhthanh">
                            Tỉnh/Thành
                        </label>
                    </div>
                    <div class="optionTT">
                        <select name="province" >
                            <option value="0" selected>Chọn tỉnh/thành phố</option>
                            @foreach($provinces as $key => $value)
                                <option value="{{$value}}"
                                        @if($value === $user->province)
                                        selected
                                    @endif
                                >{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gender">
                    <div class="lbgioitinh">
                        <label for="lbgioitinh">
                            Giới tính
                        </label>
                    </div>
                    <div class="radiogender">
                        <input id="gtnam" type="radio" name="gender" value="1"
                                checked
                        >Nam
                        <input id="gtnu" type="radio" name="gender" value="0"
                            @if ($user->gender === 0)
                                checked
                           @endif
                        >Nữ
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="thaydoimatkhau">
                            <input id="change" type="button" value="Thay đổi mật khẩu" class="btnthaydoimk">
                        </div>
                        <div id="change-password">

                        </div>


                    </div>
                    <div class="btncapnhattk">
                        <input type="submit" value="Cập nhật tài khoản" class="btnupdate">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @include('layout.footer')
</div>
@push('js')
    <script>
        $(document).ready(function(){
            //tạo sự kiện khi nhấn nút đổi mật khẩu
            $("#change").click(function(){
                //lấy ra element có id là change-password
                //kiểm tra nếu element không có child nào thì thêm vào
                //còn nếu có thì xóa hết child trong element change-password
                var element = document.getElementById("change-password");
                if (!element.hasChildNodes()) {
                    $("#change-password").append(`
                            <div class="matkhau">
                                <div class="lbmatkhau">
                                    <label for="lbmatkhau">
                                        Mật khẩu cũ
                                    </label>
                                </div>
                                <div class="textmk">
                                    <input type="password" name="old_password" placeholder="Mật khẩu cũ" class="inputpw">
                                </div>
                                </div>
                            <div class="matkhau">
                                <div class="lbmatkhau">
                                    <label for="lbmatkhau">
                                        Mật khẩu mới
                                    </label>
                                </div>
                                <div class="textmk">
                                    <input type="password" name="new_password" placeholder="Mật khẩu mới" class="inputpw">
                                </div>
                            </div>
                            <div class="matkhau">
                                <div class="lbmatkhau">
                                    <label for="lbmatkhau">
                                        Nhập lại mật khẩu
                                    </label>
                                </div>
                                <div class="textmk">
                                    <input type="password" name="password_confirmation " placeholder="Nhập lại mật khẩu" class="inputpw">
                                </div>
                            </div>
                    `);
                }
                else{
                    $("#change-password").empty();
                }
            })
        });
    </script>
@endpush
{{--<form action="{{route('logout')}}" method="post">--}}
{{--    @csrf--}}
{{--    <button type="submit">Đăng xuất</button>--}}
{{--</form>--}}
{{--<a href="{{route('user.cart.index')}}">Trang giỏ hàng</a>--}}
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
{{--<h1>Thông tin tài khoản</h1>--}}
{{--<form action="{{route('user.profile.update',$user)}}" method="post">--}}
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
{{--                    selected--}}
{{--                @endif--}}
{{--            >{{$key}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    <br>--}}
{{--    <label for="">Giới tính</label>--}}
{{--    <br>--}}
{{--    <input type="radio" name="Nam" value="1"--}}
{{--        checked--}}
{{--    >--}}
{{--    <label for="">Nam</label>--}}
{{--    <input type="radio" name="Nữ" value="0"--}}
{{--        @if ($user->gender === 0)--}}
{{--            checked--}}
{{--           @endif--}}
{{--    >--}}
{{--    <label for="">Nữ</label>--}}
{{--    <br>--}}
{{--    <button type="submit">Cập nhật</button>--}}
{{--</form>--}}
@endsection
