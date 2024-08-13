{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.main')
@section('title', 'Login')
@section('content')

<div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">

            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="text-center">
                    <a href="#"><img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img" /></a>
                </div>
                <h4 class="text-center f-w-500 my-3">{{ __('Login form') }}</h4>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Email Address') }}">
                    @if ($errors->has('email'))
						<div class="text-danger mt-2">
							{{ $errors->first('email') }}
						</div>
					@endif
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}">
                    @if ($errors->has('password'))
						<div class="text-danger mt-2">
							{{ $errors->first('password') }}
						</div>
					@endif
                </div>
                <h6 class="text-secondary f-w-400 mb-0 text-end">
                    <a href="{{ route('password.request') }}"> {{ __('Forgot your password?') }} </a>
                </h6>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">{{ __("Don't have an Account?") }}</h6>
                    <a href="{{ route('register') }}" class="link-primary">{{ __('Create Account') }}</a>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
</div>

@endsection