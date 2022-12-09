@extends('layout.master')
@section('content')
@if ( $errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form method="POST" id="login-form" action="{{ route('login') }}">
    @csrf

    <input type="hidden" name="recaptcha" id="recaptcha">
    <!-- Email Address -->
    <div>
        <label for="email">Email</label>
        <input type="text" name="email"  value="{{old('email')}}" required autofocus>
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password"  required autocomplete="current-password">
    </div>


    <div class="flex items-center justify-end mt-4">
        <!-- Forgot Password -->
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
        <button>
            {{ __('Log in') }}
        </button>
    </div>
</form>
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
