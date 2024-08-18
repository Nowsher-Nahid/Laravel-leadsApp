<!doctype html>
<html lang="en">

  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}" />
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
  </head>

  <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">

    <div class="page-loader">
        <div class="bar"></div>
    </div>

    @if (!Route::is('login') && !Route::is('register'))

        <nav class="pc-sidebar">
            <div class="navbar-wrapper">
                <div class="m-header">
                <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                    <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo" />
                </a>
                </div>
                <div class="navbar-content">
                <div class="card pc-user-card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ file_exists(public_path(Auth::user()->profile_picture)) && Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets/images/profile-pictures/placeholder.png') }}" alt="user-image" class="user-avtar wid-45 rounded-circle">
                            
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                        <h6 class="mb-0">{{ Auth::user()->first_name }}</h6>
                        <small>
                            @if (Auth::user()->type == 1)
                                {{ __('User') }}
                            @else
                                {{ __('Administrator') }}
                            @endif
                        </small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-sort-outline"></use>
                        </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('profile.edit') }}">
                                <i class="ti ti-user"></i>
                                <span>{{ __('My Account') }}</span>
                            </a>

                            @if (Auth::user()->type === 0)
                                <a href="{{ route('settings') }}">
                                    <i class="ti ti-settings"></i>
                                    <span>{{ __('Settings') }}</span>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-power"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>{{ __('Navigation') }}</label>
                    </li>
                    @if (Auth::user()->type === 0)
                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-status-up"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    @endif
                    <li class="pc-item">
                        <a href="{{ route('lead.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-keyboard"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">{{ __('Leads') }}</span>
                        </a>
                    </li>
                    @if (Auth::user()->type === 0)
                    <li class="pc-item">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-profile-2user-outline"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">{{ __('Partners') }}</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('settings') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">{{ __('Settings') }}</span>
                        </a>
                    </li>
                    @endif
                    <li class="pc-item">
                        <a href="{{ route('transactions.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-text-align-justify-center"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">{{ __('Transactions') }}</span>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <header class="pc-header">
            <div class="header-wrapper">
                <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    </li>
                </ul>
                </div>
                <div class="ms-auto">
                    <ul class="list-unstyled">
                        <li class="dropdown pc-h-item">
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>{{ __('My Account') }}</span>
                            </a>
                            @if (Auth::user()->type === 0)
                                <a href="{{ route('settings') }}" class="dropdown-item">
                                    <i class="ti ti-settings"></i>
                                    <span>{{ __('Settings') }}</span>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            {{-- <a href="" class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>{{ __('Logout') }}</span>
                            </a> --}}
                        </div>
                        </li>
                        <li class="dropdown pc-h-item header-user-profile">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                        >
                            <img src="{{ file_exists(public_path(Auth::user()->profile_picture)) && Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets/images/profile-pictures/placeholder.png') }}" alt="user-image" class="user-avtar">
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="{{ file_exists(public_path(Auth::user()->profile_picture)) && Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets/images/profile-pictures/placeholder.png') }}" alt="user-image" class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 🖖</h6>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                                </div>
                                <hr class="border-secondary border-opacity-50" />
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <span>
                                        <i class="ti ti-user"></i>
                                        <span>{{ __('My Account') }}</span>
                                    </span>
                                </a>

                                @if (Auth::user()->type === 0)
                                    <a href="{{ route('settings') }}" class="dropdown-item">
                                        <span>
                                            <svg class="pc-icon text-muted me-2">
                                            <use xlink:href="#custom-setting-outline"></use>
                                            </svg>
                                            <span>{{ __('Settings') }}</span>
                                        </span>
                                    </a>
                                @endif

                                <hr class="border-secondary border-opacity-50" />
                                <div class="d-grid mb-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            <svg class="pc-icon me-2">
                                            <use xlink:href="#custom-logout-1-outline"></use></svg>{{ __('Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

    @endif

    @yield('content')

    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0"
              >Able Pro &#9829; crafted by Team <a href="https://themeforest.net/user/phoenixcoded" target="_blank">Phoenixcoded</a></p
            >
          </div>
          <div class="col-auto my-1">
            <ul class="list-inline footer-link mb-0">
              <li class="list-inline-item"><a href="../index.html">Home</a></li>
              <li class="list-inline-item"><a href="https://phoenixcoded.gitbook.io/able-pro/" target="_blank">Documentation</a></li>
              <li class="list-inline-item"><a href="https://phoenixcoded.authordesk.app/" target="_blank">Support</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <!-- datatable Js -->
    <script src="{{ asset('assets/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Stripe js --}}
    <script src="https://js.stripe.com/v3/"></script>
    
    <script>
        @if (session('success'))
          Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Ok'
          })
        @endif

        // @if (session('success'))
        //     Swal.fire({
        //         title: 'Error!',
        //         text: "{{ session('error') }}",
        //         icon: 'error',
        //         confirmButtonText: 'Ok'
        //     })
        // @endif
    </script>

    @stack('scripts')

  </body>
</html>
