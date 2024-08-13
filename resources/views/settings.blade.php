@extends('layouts.main')
@section('title', 'Settings')
@section('content')

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page">Settings</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Settings</h2>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body py-0">
                <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="true">
                      <i class="ti ti-file-text me-2"></i>{{ __('Leads Sold') }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab" aria-selected="true">
                      <i class="ti ti-lock me-2"></i>{{ __('Leads Budget') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">

                    <form action="{{ route('max_sold.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-header">
                            <h5>{{ __('Maximum Leads Sold') }}</h5>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Maximum Leads Sold') }}</label>
                                    <input type="text" class="form-control" name="max_sold" value="{{ $settings->max_sold }}" required>
                                        @if ($errors->has('max_sold'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('max_sold') }}
                                        </div>
                                        @endif
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="text-end btn-page">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>

                </div>
                <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">

                    <form method="post" action="{{ route('budget.update') }}" class="mt-6 space-y-6">
                    @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Leads Budget Price') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3 my-auto">
                                            <h6>Minder dan €1000 : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" step="0.01" class="form-control" name="budget_price_1" placeholder="{{ __('Enter Price') }}" value="{{ $settings->budget_price_1 }}" required>
                                        </div>
                                    </div>
                                        @if ($errors->has('current_password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                        @endif
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3 my-auto">
                                            <h6>€1000 - €2000 : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" step="0.01" class="form-control" name="budget_price_2" placeholder="{{ __('Enter Price') }}" value="{{ $settings->budget_price_2 }}">
                                        </div>
                                    </div>
                                        @if ($errors->has('current_password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                        @endif
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3 my-auto">
                                            <h6>Meer dan €2000 : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" step="0.01" class="form-control" name="budget_price_3" placeholder="{{ __('Enter Price') }}" value="{{ $settings->budget_price_3 }}">
                                        </div>
                                    </div>
                                        @if ($errors->has('current_password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                        @endif
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-3 my-auto">
                                            <h6>Geen idee : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" step="0.01" class="form-control" name="budget_price_4" placeholder="{{ __('Enter Price') }}" value="{{ $settings->budget_price_4 }}">
                                        </div>
                                    </div>
                                        @if ($errors->has('current_password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-end btn-page">
                        <button type="submit" class="btn btn-primary">{{ __('Update Price') }}</button>
                        </div>
                    </form>

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