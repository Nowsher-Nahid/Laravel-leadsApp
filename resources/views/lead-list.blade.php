@extends('layouts.main')
@section('title', 'Leads List')
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
                  <h2 class="mb-0">Leads List</h2>
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
                      <th>SN</th>
                      <th>Job Type</th>
                      <th>Service</th>
                      <th>Budget</th>
                      <th>Deadline</th>
                      <th>Status</th>
                      <th>Action</th>
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
            var table = $('#base-style').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lead.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'job_type', name: 'job_type'},
                    {data: 'services', name: 'services'},
                    {data: 'budget', name: 'budget'},
                    {data: 'deadline', name: 'deadline'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        // delete
        $(document).ready(function() {
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-lead/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Lead has been deleted.',
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