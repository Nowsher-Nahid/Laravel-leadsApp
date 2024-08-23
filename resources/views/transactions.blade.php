@extends('layouts.main')
@section('title', __('messages.transaction_list'))
@section('content')

  <section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                  <li class="breadcrumb-item" aria-current="page">{{ __('messages.leads') }}</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">{{ __('messages.transaction_list') }}</h2>
                </div>
              </div>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="base-style" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                        <th>{{ __('messages.job_type') }}</th>
                        <th>{{ __('messages.services') }}</th>
                        <th>{{ __('messages.budget') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.purchase_date') }}</th>
                        @if(Auth::user()->type === 0)
                          <th>{{ __('messages.purchased_by') }}</th>
                        @endif
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection

@push('scripts')
    <script>
        $(function () {
            var columns = [
                { data: 'job_type', name: 'job_type' },
                { data: 'services', name: 'services' },
                { data: 'budget', name: 'budget' },
                { data: 'name', name: 'name' },
                { data: 'purchased_date', name: 'purchased_date' },
            ];

            @if(Auth::user()->type === 0)
                columns.push({ data: 'purchased_by', name: 'purchased_by' });
            @endif

            columns.push({ data: 'action', name: 'action', orderable: false, searchable: false });

            var table = $('#base-style').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transactions.data') }}",
                columns: columns,
                language: languageOptions[userLang] || languageOptions.en
            });
        });
    </script>
@endpush
