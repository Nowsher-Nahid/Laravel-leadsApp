@extends('layouts.main')
@section('title', 'Update Partner Info')
@section('content')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Partners</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ __('Update Partner') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lead Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 text-center">
                                            <img class="img-fluid" src="{{ asset($user->profile_picture) }}" alt="Profile picture" width="100">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name">{{ __('First Name') }}</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" placeholder="{{ __('Enter First Name') }}" required>
                                            @if ($errors->has('first_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('first_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">{{ __('Last Name') }}</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" placeholder="{{ __('Enter Last Name') }}" required>
                                            @if ($errors->has('last_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('last_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">{{ __('Email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="{{ __('Enter Email Address') }}" required>
                                            @if ($errors->has('email'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">{{ __('Phone') }}</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="{{ __('Enter Phone Number') }}" required>
                                            @if ($errors->has('phone'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="company_name">{{ __('Company Name') }}</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $user->company_name }}" placeholder="Enter Company Name" required>
                                            @if ($errors->has('company_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('company_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="company_vat">{{ __('Company VAT') }}</label>
                                            <input type="text" class="form-control" id="company_vat" name="company_vat" value="{{ $user->company_vat }}" placeholder="Enter Company VAT" required>
                                            @if ($errors->has('company_vat'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('company_vat') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">{{ __('Profile Picture') }}</label>
                                            <input type="file" class="form-control mt-1" name="profile_picture" accept="image/*">
                                            @if ($errors->has('profile_picture'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('profile_picture') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary mb-4">{{ __('Update Partner') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  @endsection