@extends('layouts.main')
@section('title', 'Update Lead')
@section('content')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Leads</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ __('Update Lead') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lead Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lead.update', $lead->id) }}" method="POST">
                                @csrf
                                <h4 class="mb-4">{{ __('Project Info') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="job-type">{{ __('Job Type') }}</label>
                                            <select class="form-select" id="job-type" name="job_type" required>
                                                <option value="">{{ __('Select Type') }}</option>
                                                <option value="Website laten maken" {{ (old('job_type', $lead->job_type) == 'Website laten maken') ? 'selected' : '' }} >Website laten maken</option>
                                                <option value="Webshop laten maken" {{ (old('job_type', $lead->job_type) == 'Webshop laten maken') ? 'selected' : '' }} >Webshop laten maken</option>
                                                <option value="Redesign bestaande website" {{ (old('job_type', $lead->job_type) == 'Redesign bestaande website') ? 'selected' : '' }} >Redesign bestaande website</option>
                                            </select>
                                            @if ($errors->has('job_type'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('job_type') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="deadline">Deadline</label>
                                            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $lead->deadline }}" placeholder="Enter deadline" required>
                                            @if ($errors->has('deadline'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('deadline') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="budget">Budget</label>
                                            <select class="form-select" id="budget" name="budget" required>
                                                <option value="">Select Budget</option>
                                                <option value="Minder dan €1000" {{ (old('budget', $lead->budget) == 'Minder dan €1000') ? 'selected' : '' }} >Minder dan €1000</option>
                                                <option value="€1000 - €2000" {{ (old('budget', $lead->budget) == '€1000 - €2000') ? 'selected' : '' }} >€1000 - €2000</option>
                                                <option value="Meer dan €2000" {{ (old('budget', $lead->budget) == 'Meer dan €2000') ? 'selected' : '' }} >Meer dan €2000</option>
                                                <option value="Geen idee" {{ (old('budget', $lead->budget) == 'Geen idee') ? 'selected' : '' }} >Geen idee</option>
                                            </select>
                                            @if ($errors->has('budget'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('budget') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Price</label>
                                            <select class="form-select" id="price" name="price" required>
                                                @if($lead->price == 0.00)
                                                    <option value="{{ $settings->budget_price_1 }}" {{ (old('budget', $lead->budget) == 'Minder dan €1000') ? 'selected' : '' }} >{{ $settings->budget_price_1 }}</option>
                                                    <option value="{{ $settings->budget_price_2 }}" {{ (old('budget', $lead->budget) == '€1000 - €2000') ? 'selected' : '' }} >{{ $settings->budget_price_2 }}</option>
                                                    <option value="{{ $settings->budget_price_3 }}" {{ (old('budget', $lead->budget) == 'Meer dan €2000') ? 'selected' : '' }} >{{ $settings->budget_price_3 }}</option>
                                                    <option value="{{ $settings->budget_price_4 }}" {{ (old('budget', $lead->budget) == 'Geen idee') ? 'selected' : '' }} >{{ $settings->budget_price_4 }}</option>
                                                @else
                                                    <option value="{{ $settings->budget_price_1 }}" {{ $lead->price == $settings->budget_price_1 ? 'selected' : '' }}>
                                                        {{ $settings->budget_price_1 }}
                                                    </option>
                                                    <option value="{{ $settings->budget_price_2 }}" {{ $lead->price == $settings->budget_price_2 ? 'selected' : '' }}>
                                                        {{ $settings->budget_price_2 }}
                                                    </option>
                                                    <option value="{{ $settings->budget_price_3 }}" {{ $lead->price == $settings->budget_price_3 ? 'selected' : '' }}>
                                                        {{ $settings->budget_price_3 }}
                                                    </option>
                                                    <option value="{{ $settings->budget_price_4 }}" {{ $lead->price == $settings->budget_price_4 ? 'selected' : '' }}>
                                                        {{ $settings->budget_price_4 }}
                                                    </option>
                                                @endif
                                            </select>
                                            @if ($errors->has('price'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="extra-services">{{ __('Extra Services') }}</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="service-logo" name="services[]" value="Logo & Branding" 
                                                {{ is_array(old('services', json_decode($lead->services, true))) && in_array('Logo & Branding', old('services', json_decode($lead->services, true))) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="service-logo">Logo & Branding</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="service-seo" name="services[]" value="Google SEO" 
                                                {{ is_array(old('services', json_decode($lead->services, true))) && in_array('Google SEO', old('services', json_decode($lead->services, true))) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="service-seo">Google SEO</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="service-writing" name="services[]" value="Copy Writing" 
                                                {{ is_array(old('services', json_decode($lead->services, true))) && in_array('Copy Writing', old('services', json_decode($lead->services, true))) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="service-writing">Copy Writing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="service-ads" name="services[]" value="Social Media Advertenties" 
                                                {{ is_array(old('services', json_decode($lead->services, true))) && in_array('Social Media Advertenties', old('services', json_decode($lead->services, true))) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="service-ads">Social Media Advertenties</label>
                                            </div>
                                            @if ($errors->has('services'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('services') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-4 mt-4">{{ __('User Info') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $lead->name }}" placeholder="Enter name" required>
                                            @if ($errors->has('name'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $lead->phone }}" placeholder="Enter phone number" required>
                                            @if ($errors->has('phone'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $lead->email }}" placeholder="Enter email" required>
                                            @if ($errors->has('email'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="company">Company</label>
                                            <input type="text" class="form-control" id="company" name="company" value="{{ $lead->company }}" placeholder="Enter company number" required>
                                            @if ($errors->has('company'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('company') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="website-url">Website</label>
                                            <input type="text" class="form-control" id="website-url" name="website_url" value="{{ $lead->website_url }}" placeholder="Enter website URL number" required>
                                            @if ($errors->has('website_url'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('website_url') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="5" name="description" required>{{ $lead->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="text-danger mt-2">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-4">{{ __('Lead Status') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="status">{{ __('Status') }}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="0" {{ (old('status', $lead->status) == '0') ? 'selected' : '' }} >Pending</option>
                                                <option value="1" {{ (old('status', $lead->status) == '1') ? 'selected' : '' }} >Published</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="sold_count">{{ __('Sold Status') }}</label>
                                            <select class="form-select" id="sold_count" name="sold_count">
                                                <option value="0" {{ (old('sold_count', $lead->sold_count) == '0') ? 'selected' : '' }}>{{ __('New') }}</option>
                                                @for ($i = 1; $i < $settings->max_sold; $i++)
                                                    <option value="{{ $i }}" {{ (old('sold_count', $lead->sold_count) == $i) ? 'selected' : '' }}>{{ __('Sold') }} {{ $i }}</option>
                                                @endfor
                                                <option value="Full" {{ (old('sold_count', $lead->sold_count) == $settings->max_sold) ? 'selected' : '' }}>{{ __('Full') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary mb-4">{{ __('Update Lead') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  @endsection