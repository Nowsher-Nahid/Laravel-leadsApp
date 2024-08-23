@extends('layouts.main')
@section('title', __('messages.leads_list'))
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
                  <h2 class="mb-0">{{ __('messages.leads_list') }}</h2>
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
                      <th>{{ __('messages.sn') }}</th>
                      @if (Auth::user()->type === 1)
                        <th>{{ __('messages.information_of_the_assignment') }}</th>
                        <th>{{ __('messages.published_date') }}</th>
                      @else
                        <th>{{ __('messages.job_type') }}</th>
                        <th>{{ __('messages.service') }}</th>
                        <th>{{ __('messages.budget') }}</th>
                        <th>{{ __('messages.deadline') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.sold') }}</th>
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

  <!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="paymentModalLabel">{{ __('messages.enter_card_details') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="payment-form" action="{{ route('leads.buy', 0) }}" method="POST">
                  @csrf
                  <div id="card-element" class="my-3">
                      <!-- Stripe Card Element will be inserted here. -->
                  </div>
                  <div id="card-errors" role="alert" class="text-danger my-2"></div>
                  <button id="submit-button" class="btn btn-success w-100">{{ __('messages.submit_payment') }}</button>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection

@push('scripts')
    <script>
        $(function () {
          var columns = [
              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            ];
            @if(Auth::user()->type === 1)
                columns.push({ data: 'lead_info', name: 'lead_info' });
                columns.push({ data: 'published_date', name: 'published_date' });
            @else
              columns.push({data: 'job_type', name: 'job_type'});
              columns.push({data: 'services', name: 'services'});
              columns.push({data: 'budget', name: 'budget'});
              columns.push({data: 'deadline', name: 'deadline'});
              columns.push({data: 'status', name: 'status'});
              columns.push({ data: 'sold', name: 'sold'});
            @endif

            columns.push({ data: 'action', name: 'action', orderable: false, searchable: false });

            var table = $('#base-style').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lead.index') }}",
                columns: columns,
                language: languageOptions[userLang] || languageOptions.en
            });
            
        });

        document.addEventListener('DOMContentLoaded', function () {
            // When the payment modal is opened
            $('#paymentModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var leadId = button.data('id'); // Extract info from data-* attributes

                // Update the form action to include the correct lead ID
                var formAction = "{{ route('leads.buy', ':id') }}";
                formAction = formAction.replace(':id', leadId);

                $(this).find('#payment-form').attr('action', formAction);
            });
        });

        // Initialize Stripe
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');
        card.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    console.error(result.error.message);
                } else {
                    // Send the token to your server
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
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
                            url: '/delete-lead/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        '{{ __('messages.deleted') }}',
                                        '{{ __('messages.lead_deleted') }}',
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
