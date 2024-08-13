{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.main')
@section('title', 'Register')
@section('content')

<div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <a href="#"><img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img"></a>
                </div>
                <h4 class="text-center f-w-500 my-3">{{ __('Register form') }}</h4>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="first_name" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required>
                    @if ($errors->has('first_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                    @if ($errors->has('last_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone Number') }}" value="{{ old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                    @if ($errors->has('password'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="company_name" placeholder="{{ __('Company Name') }}" value="{{ old('company_name') }}">
                    @if ($errors->has('company_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('company_name') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" name="company_vat" placeholder="{{ __('Company VAT') }}" value="{{ old('company_vat') }}">
                    @if ($errors->has('company_vat'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('company_vat') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="">{{ __('Profile Picture') }}</label>
                    <input type="file" class="form-control mt-1" name="profile_picture" accept="image/*">
                    @if ($errors->has('profile_picture'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('profile_picture') }}
                        </div>
                    @endif
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </div>
                
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">Already have an Account?</h6>
                    <a href="{{ route('login') }}" class="link-primary">Login here</a>
                </div>
            </form>            
            
          </div>
        </div>
      </div>
    </div>
</div>

@endsection