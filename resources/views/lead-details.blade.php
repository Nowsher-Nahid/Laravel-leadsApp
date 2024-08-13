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
                                <h2 class="mb-0">{{ __('Lead Details') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h5>{{ __('Primary Details') }}</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Job Type') }}</p>
                                  <p class="mb-0">{{ $lead->job_type }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Extra Services') }}</p>
                                  <p class="mb-0">{{ $lead->services }}</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Budget') }}</p>
                                  <p class="mb-0">{{ $lead->budget }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Deadline') }}</p>
                                  <p class="mb-0">{{ $lead->deadline }}</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0 pb-0">
                              <p class="mb-1 text-muted">{{ __('Description') }}</p>
                              <p class="mb-0">{{ $lead->description }}</p>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <h5>{{ __('Contact Details') }}</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Name') }}</p>
                                  <p class="mb-0">{{ $lead->name }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Phone') }}</p>
                                  <p class="mb-0">{{ $lead->phone }}</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Email') }}</p>
                                  <p class="mb-0">{{ $lead->email }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Company Name') }}</p>
                                  <p class="mb-0">{{ $lead->company }}</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0 pb-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">{{ __('Website URL') }}</p>
                                  <p class="mb-0">{{ $lead->website_url }}</p>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                </div>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-primary mb-4">Buy Now</button>
            </div>

        </div>
    </section>

  @endsection