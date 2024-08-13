@extends('layouts.main')
@section('title', 'User Profile')
@section('content')

<div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                  @if ($user->type === 0)
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                  @endif
                  <li class="breadcrumb-item" aria-current="page">Account Profile</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Account Profile</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body py-0">
                <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="true">
                      <i class="ti ti-file-text me-2"></i>{{ __('Personal Details') }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab" aria-selected="true">
                      <i class="ti ti-lock me-2"></i>{{ __('Change Password') }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab" href="#profile-6" role="tab" aria-selected="true">
                      <i class="ti ti-settings me-2"></i>{{ __('Settings') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane show active" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="card">
                    <div class="card-header">
                      <h5>{{ __('Personal Information') }}</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12 text-center mb-3">
                          <div class="user-upload wid-75">
                            <img src="{{ file_exists(public_path($user->profile_picture)) && $user->profile_picture ? asset($user->profile_picture) : asset('assets/images/profile-pictures/placeholder.png') }}" alt="Profile Picture" class="img-fluid">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">{{ __('First Name') }}</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
                            @if ($errors->has('first_name'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('first_name') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">{{ __('Last Name') }}</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                            @if ($errors->has('last_name'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('last_name') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('email') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">{{ __('Phone Number') }}</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                          </div>
                        </div>

                        @if (Auth::user()->type === 1)
                          <div class="col-sm-6">
                            <div class="mb-3">
                              <label class="form-label">{{ __('Company Name') }}</label>
                              <input type="text" class="form-control" name="company_name" value="{{ $user->company_name }}">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="mb-3">
                              <label class="form-label">{{ __('Company VAT') }}</label>
                              <input type="text" class="form-control" name="company_vat" value="{{ $user->company_vat }}">
                            </div>
                          </div>
                        @endif
                        
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">{{ __('Profile Picture') }}</label>
                            <input type="file" class="form-control" name="profile_picture" accept="image/*">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-end btn-page">
                    <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                  </div>

                </form>

              </div>
              <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                  @csrf
                    <div class="card">
                      <div class="card-header">
                        <h5>{{ __('Change Password') }}</h5>
                      </div>
                        <div class="card-body">
                          <div class="mb-3">
                            <label class="form-label" for="current_password">{{ __('Current Password') }}</label>
                            <input type="password" id="current_password" class="form-control" name="current_password">
                            @if ($errors->has('current_password'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('current_password') }}
                              </div>
                            @endif
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="new_password">{{ __('New Password') }}</label>
                            <input type="password" id="new_password" class="form-control" name="password">
                            @if ($errors->has('password'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('password') }}
                              </div>
                            @endif
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                              <div class="text-danger mt-2">
                                  {{ $errors->first('password_confirmation') }}
                              </div>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="text-end btn-page">
                      <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                    </div>
                </form>

              </div>
              <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h5>{{ __('Email Settings') }}</h5>
                      </div>
                      <div class="card-body">
                        <h6 class="mb-4">Setup Email Notification</h6>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Email Notification</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Send Copy To Personal Email</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5>Updates from System Notification</h5>
                      </div>
                      <div class="card-body">
                        <h6 class="mb-4">Email you with?</h6>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">News about PCT-themes products and feature updates</p>
                          </div>
                          <div class="form-check p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Tips on getting more out of PCT-themes</p>
                          </div>
                          <div class="form-check p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Things you missed since you last logged into PCT-themes</p>
                          </div>
                          <div class="form-check p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">News about products and other services</p>
                          </div>
                          <div class="form-check p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Tips and Document business products</p>
                          </div>
                          <div class="form-check p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h5>Activity Related Emails</h5>
                      </div>
                      <div class="card-body">
                        <h6 class="mb-4">When to email?</h6>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Have new notifications</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">You're sent a direct message</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Someone adds you as a connection</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <hr class="my-4 border border-secondary-subtle" />
                        <h6 class="mb-4">When to escalate emails?</h6>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Upon new order</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">New membership approval</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" />
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <div>
                            <p class="text-muted mb-0">Member registration</p>
                          </div>
                          <div class="form-check form-switch p-0">
                            <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 text-end btn-page">
                    <div class="btn btn-outline-secondary">Cancel</div>
                    <div class="btn btn-primary">Update Profile</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('#myTab a');
        const storedTab = localStorage.getItem('activeTab');
        
        if (storedTab) {
            const activeTab = document.querySelector(`#myTab a[href="${storedTab}"]`);
            if (activeTab) {
                const tabId = activeTab.getAttribute('href');
                new bootstrap.Tab(activeTab).show();
                document.querySelector(tabId).classList.add('show', 'active');
            }
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                localStorage.setItem('activeTab', this.getAttribute('href'));
            });
        });
    });
</script>
@endpush