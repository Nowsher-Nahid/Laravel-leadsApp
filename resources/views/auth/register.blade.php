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
@section('title', __('messages.register'))
@section('content')

<div class="auth-main">

    <div class="language">
        <a href="{{ url('locale/nl') }}" class="me-1 {{ app()->getLocale() === 'nl' ? 'text-bold' : '' }}">
            {{ __('messages.dutch') }}
        </a>
        |
        <a href="{{ url('locale/en') }}" class="ms-1 {{ app()->getLocale() === 'en' ? 'text-bold' : '' }}">
            {{ __('messages.english') }}
        </a>
    </div>

    <div class="auth-wrapper v1">
        <div class="auth-form">
          <div class="card my-5">
            <div class="card-body">
      
              <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                  <a href="#"><img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img"></a>
                </div>
                <h4 class="text-center f-w-500 my-3">{{ __('messages.register_form') }}</h4>
                
                <div class="mb-3">
                  <input type="text" class="form-control" name="first_name" placeholder="{{ __('messages.first_name') }}" value="{{ old('first_name') }}" required>
                  @if ($errors->has('first_name'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('first_name') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="text" class="form-control" name="last_name" placeholder="{{ __('messages.last_name') }}" value="{{ old('last_name') }}" required>
                  @if ($errors->has('last_name'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('last_name') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="email" class="form-control" name="email" placeholder="{{ __('messages.email_address') }}" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="text" class="form-control" name="phone" placeholder="{{ __('messages.phone_number') }}" value="{{ old('phone') }}" required>
                  @if ($errors->has('phone'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('phone') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                </div>
                
                <div class="mb-3">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('messages.confirm_password') }}" required>
                  @if ($errors->has('password'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="text" class="form-control" name="company_name" placeholder="{{ __('messages.company_name') }}" value="{{ old('company_name') }}">
                  @if ($errors->has('company_name'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('company_name') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <input type="text" class="form-control" name="company_vat" placeholder="{{ __('messages.company_vat') }}" value="{{ old('company_vat') }}">
                  @if ($errors->has('company_vat'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('company_vat') }}
                    </div>
                  @endif
                </div>
                
                <div class="mb-3">
                  <label for="">{{ __('messages.profile_picture') }}</label>
                  <input type="file" class="form-control mt-1" name="profile_picture" accept="image/*">
                  @if ($errors->has('profile_picture'))
                    <div class="text-danger mt-2">
                      {{ $errors->first('profile_picture') }}
                    </div>
                  @endif
                </div>
                
                <div class="d-grid mt-4">
                  <button type="submit" class="btn btn-primary">{{ __('messages.sign_up') }}</button>
                </div>
                
                <div class="d-flex justify-content-between align-items-end mt-4">
                  <h6 class="f-w-500 mb-0">{{ __('messages.already_have_account') }}</h6>
                  <a href="{{ route('login') }}" class="link-primary">{{ __('messages.login_here') }}</a>
                </div>
              </form>            
      
            </div>
          </div>
        </div>
      </div>
      
</div>

@endsection