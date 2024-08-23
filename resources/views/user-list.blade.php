@extends('layouts.main')
@section('title', __('messages.user_list'))
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
                  <h2 class="mb-0">Partner List</h2>
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
                <table id="base-style" class="table table-striped table-bordered nowrap user-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.sn') }}</th>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.email') }}</th>
                            <th>{{ __('messages.phone') }}</th>
                            <th>{{ __('messages.company_name') }}</th>
                            <th>{{ __('messages.company_vat') }}</th>
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
              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
              { data: 'full_name', name: 'full_name' },
              { data: 'email', name: 'email' },
              { data: 'phone', name: 'phone' },
              { data: 'company_name', name: 'company_name' },
              { data: 'company_vat', name: 'company_vat' },
              { data: 'action', name: 'action', orderable: false, searchable: false }
          ];

          var table = $('#base-style').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('user.index') }}",
              columns: columns,
              language: languageOptions[userLang] || languageOptions.en
          });
      });

        // delete
        $(document).ready(function() {
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: '{{ __('messages.are_you_sure') }}',
                    text: "{{ __('messages.no_revert') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('messages.yes_delete') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-user/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        '{{ __('messages.deleted') }}',
                                        '{{ __('messages.user_deleted') }}',
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });

    </script>
@endpush