@extends('layouts.main')
@section('title', 'Lead Details')
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
                                  <p class="mb-0">
                                      @php
                                          $servicesArray = json_decode($lead->services, true);
                                      @endphp
                                      @if(is_array($servicesArray))
                                          {{ implode(', ', $servicesArray) }}
                                      @else
                                          {{ __('No extra services selected') }}
                                      @endif
                                  </p>
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

                      @if(($userHasPurchased && Auth::user()->type === 1) || Auth::user()->type === 0)
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
                      @endif

                </div>
            </div>

            @if (Auth::user()->type === 1)
                @if($isSoldOut)
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="alert alert-warning mb-4 text-center">This lead is already sold out.</div>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                @elseif(!$userHasPurchased)
                  <div class="text-end">
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#paymentModal">Buy Now</button>
                  </div>
                @else
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="alert alert-success mb-4 text-center">You have already purchased this lead.</div>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                @endif
            @endif

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="paymentModalLabel">Enter Card Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="payment-form" action="{{ route('leads.buy', $lead->id) }}" method="POST">
                      @csrf
                      <div id="card-element" class="my-3">
                          <!-- Stripe Card Element will be inserted here. -->
                      </div>
                      <div id="card-errors" role="alert" class="text-danger my-2"></div>
                      <button id="submit-button" class="btn btn-success w-100">Submit Payment</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

  @endsection

  @push('scripts')
  <script>
      // Initialize Stripe
      var stripe = Stripe('{{ env('STRIPE_KEY') }}');
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
  </script>
  @endpush
