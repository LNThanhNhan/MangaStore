@push('css')
    <link rel="stylesheet" href="{{ asset('css/DangNhap.css') }}">
@endpush
@extends('layout.master')
@section('content')
@include('layout.header')

<div class="contentDangNhap">
    <table class="tbcontentDangNhap">
        <tr>
            <td class="tdlbDangNhap">
                <div class="lbdn">
                    <label for="lbdangnhap">
                        ĐĂNG NHẬP
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="divhr"><hr class="hr"></div>
            </td>
        </tr>
        @if ( $errors->any())
        <tr>
            <td>
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </td>
        </tr>
        @endif
        <tr>
            <td class="formdn">
                <form method="POST" id="login-form" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="recaptcha" id="recaptcha">
                    <table class="tbformdangnhap">
                        <tr>
                            <td colspan="2" class="tdhoten">
                                <div class="texthoten">
                                    <input type="text" name="email" placeholder="Email" class="inputhoten" required autofocus>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tdpw">
                                <div class="password">
                                    <input type="password" name="password" placeholder="Mật khẩu" class="inputmk" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tdbtndn">
                                <div class="btndangnhap">
                                    <button type="submit" class="btnlogin">
                                        ĐĂNG NHẬP
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tdquenmk">
                                <div class="quenmk">
                                    <a href="{{ route('password.request') }}" class="hrefquenmk">
                                        Quên mật khẩu
                                    </a>
                                </div>
                            </td>
                            <td class="tddangky">
                                <div class="dangky">
                                    <a href="{{route('register')}}" class="hrefdangky">
                                        Đăng ký
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
</div>
@include('layout.footer')
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
            //Thêm sử kiện submit form
            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_KEY') }}', { action: 'login' }).then(function(token) {
                    document.getElementById('recaptcha').value = token;
                    document.getElementById('login-form').submit();
                })
            });
        });
    </script>
@endpush
