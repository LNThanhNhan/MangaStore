
<form action="{{route('logout')}}" method="post">
    @csrf
    <button type="submit">Đăng xuất</button>
</form>
<a href="{{route('user.cart.index')}}">Trang giỏ hàng</a>
@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1>Thông tin tài khoản</h1>
<form action="{{route('user.profile.update',$user)}}" method="post">
    @csrf
    @method('PUT')
    <label>Họ tên</label>
    <input type="text" name="name" value="{{$user->name}}"> <br>
    <label>Email</label>
    <input type="text" name="email" value="{{$user->account->email}}"> <br>
    <label>Số điện thoại</label>
    <input type="text" name="phone" value="{{$user->phone}}"> <br>
    <label>Địa chỉ</label>
    <input type="text" name="address" value="{{$user->address}}"> <br>
    <label for="">Tỉnh/Thành phố</label>
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
    <br>
    <label for="">Giới tính</label>
    <br>
    <input type="radio" name="Nam" value="1"
        checked
    >
    <label for="">Nam</label>
    <input type="radio" name="Nữ" value="0"
        @if ($user->gender === 0)
            checked
           @endif
    >
    <label for="">Nữ</label>
    <br>
    <button type="submit">Cập nhật</button>
</form>
