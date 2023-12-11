<!DOCTYPE html><!--
    * CoreUI - Free Bootstrap Admin Template
    * @version v4.2.2
    * @link https://coreui.io/product/free-bootstrap-admin-template/
    * Copyright (c) 2023 creativeLabs Łukasz Holeczek
    * Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
    --><!-- Breadcrumb-->
    <html lang="en">
      <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Admin Portfolio</title>
        <!-- CSS Libraries -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('backend/assets/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('backend/assets/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('backend/assets/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('backend/assets/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('backend/assets/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('backend/assets/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('backend/assets/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('backend/assets/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('backend/assets/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('backend/assets/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend/assets/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('backend/assets/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/assets/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('backend/assets/favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('backend/assets/favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- Vendors styles-->
        <link rel="stylesheet" href="{{asset('backend/assets/vendors/simplebar/css/simplebar.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/vendors/simplebar.css')}}">
        <!-- Main styles for this application-->
        <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">
        <!-- We use those styles to show code examples, you should remove them in your application.-->
        <link href="{{asset('backend/assets/css/examples.css')}}" rel="stylesheet">
        <link href="{{asset('backend/assets/vendors/@coreui/chartjs/css/coreui-chartjs.css')}}" rel="stylesheet">
      </head>
      <body>
        <!--Start Sidebar-->
        @include('admin.layouts.sidebar')
        <!--End Sidebar-->

        <!--Start Main Part-->
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
          <!--Start Header-->
          <header class="header header-sticky">
            <div class="container-fluid">
              <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                  <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
                </svg>
              </button>
              <a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                  <use xlink:href="{{asset('backend/assets/brand/coreui.svg#full')}}"></use>
                </svg>
              </a>
              <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">{{__('admin-header.dashboard')}}</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li> --}}
              </ul>
              <ul class="header-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg></a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                    </svg></a></li>
                <li class="nav-item"><a class="nav-link" href="#">
                    <svg class="icon icon-lg">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></a></li> --}}
              </ul>
              <ul class="header-nav ms-3">
                <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img" src="{{asset('backend/assets/img/avatars/8.jpg')}}" alt="user@email.com"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                      <div class="fw-semibold">Account</div>
                    </div><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                      </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                      </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                      </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                      </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                    <div class="dropdown-header bg-light py-2">
                      <div class="fw-semibold">Settings</div>
                    </div><a class="dropdown-item" href="{{route('profile.edit')}}">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg> Profile</a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg> Settings</a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                      </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
                      <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                      </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                    <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="#">
                            <svg class="icon me-2">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                            </svg>
                        Lock Account
                        </a> --}}
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                                <svg class="icon me-2">
                                <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                                </svg>
                            Logout
                            </a>
                        </form>
                  </div>
                </li>
              </ul>
            </div>
            {{-- <div class="header-divider"></div> --}}
            {{-- <div class="container-fluid">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                  <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>Home</span>
                  </li>
                  <li class="breadcrumb-item active"><span>Dashboard</span></li>
                </ol>
              </nav>
            </div> --}}
          </header>
          <!--End Header-->

          <!--Start Body-->
          @yield('content')
          <!--End Body

          <!--Start Footer-->
          <footer class="footer footer-sticky mt-4">
            <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
          </footer>
          <!--End Footer-->
        </div>
        <!--End Main Part-->

        <!-- CoreUI and necessary plugins-->
        <script src="{{asset('backend/assets/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendors/simplebar/js/simplebar.min.js')}}"></script>
        <!-- Plugins and scripts required by this view-->
        <script src="{{asset('backend/assets/vendors/chart.js/js/chart.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
        <script src="{{asset('backend/assets/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
        <script src="{{asset('backend/assets/js/main.js')}}"></script>
        <script>
        </script>

      </body>
    </html>
