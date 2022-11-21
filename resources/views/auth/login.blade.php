@extends('layout.master')
@section('content')
@if ( $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="" value="{{old('email')}}" required autofocus>
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" id="" required autocomplete="current-password">
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
