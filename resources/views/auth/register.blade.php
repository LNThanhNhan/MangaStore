@extends('layout.master')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{route('home.index')}}">
                <img src="{{asset('image/LOGO HÌNH.png')}}" alt="" style="width: 20vh;height: 20vh">
            </a>
        </x-slot>

        <form id="login-form" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="recaptcha" id="recaptcha">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="" :value="__('Giới tính')" />
                <span>
                <input type="radio" name="gender" id="" value=1 required>
                <span>Nam</span>
{{--                <x-input-label for="gender" :value="__('Nam')" />--}}

                <input type="radio" name="gender" id="" value=0 style="margin-left: 5vw">
                <span>Nữ</span>
{{--                <x-input-label for="gender" :value="__('Nữ')" />--}}
                </span>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />

                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required  />

                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
            //Thêm sử kiện submit form
            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_KEY') }}', { action: 'register' }).then(function(token) {
                    document.getElementById('recaptcha').value = token;
                    document.getElementById('login-form').submit();
                })
            });
        });
    </script>
@endpush
