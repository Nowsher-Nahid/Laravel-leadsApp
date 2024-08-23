@extends('layouts.main')
@section('title', __('messages.update_partner_info'))
@section('content')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ __('messages.partners') }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ __('messages.update_partner') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('messages.lead_form') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 text-center">
                                            <img class="img-fluid" src="{{ asset($user->profile_picture) }}" alt="{{ __('messages.profile_picture') }}" width="100">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name">{{ __('messages.first_name') }}</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" placeholder="{{ __('messages.enter_first_name') }}" required>
                                            @if ($errors->has('first_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('first_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">{{ __('messages.last_name') }}</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" placeholder="{{ __('messages.enter_last_name') }}" required>
                                            @if ($errors->has('last_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('last_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">{{ __('messages.email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="{{ __('messages.enter_email') }}" required>
                                            @if ($errors->has('email'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">{{ __('messages.phone') }}</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="{{ __('messages.enter_phone') }}" required>
                                            @if ($errors->has('phone'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="company_name">{{ __('messages.company_name') }}</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $user->company_name }}" placeholder="{{ __('messages.enter_company_name') }}" required>
                                            @if ($errors->has('company_name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('company_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="company_vat">{{ __('messages.company_vat') }}</label>
                                            <input type="text" class="form-control" id="company_vat" name="company_vat" value="{{ $user->company_vat }}" placeholder="{{ __('messages.enter_company_vat') }}" required>
                                            @if ($errors->has('company_vat'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('company_vat') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">{{ __('messages.profile_picture') }}</label>
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
                                    <button type="submit" class="btn btn-primary mb-4">{{ __('messages.update_partner') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </section>

  @endsection