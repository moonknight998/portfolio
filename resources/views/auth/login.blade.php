<!DOCTYPE html>
<html lang="vi">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{__('login.login')}}</title>
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
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
              <div class="card-group d-block d-md-flex row">
                <div class="card-transparent col-md-14 p-4 mb-0" style="background-color: #fff0">
                  <div class="card-body" style="text-align: center">
                    <a class="header-brand d-md-inline" href="#">
                        <svg width="256" height="120" alt="CoreUI Logo">
                          <use xlink:href="{{asset('backend/assets/brand/coreui.svg#full')}}"></use>
                        </svg>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <h1>{{__('login.login')}}</h1>
                  <p class="text-medium-emphasis">{{__('login.login_to_your_account')}}</p>
                  @if (session()->has('status'))
                    <div class="row mb-0">
                        <div class="valid-feedback mb-4" style="display: inline; color: rgb(25, 192, 25);">
                            {{session()->get('status')}}
                        </div>
                    </div>
                  @endif
                  <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-2">
                        <div class="input-group mb-1"><span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                            </svg></span>
                          <input id="email" class="form-control" type="email" placeholder="{{__('login.email')}}" name="email" value="{{old('email')}}" required>
                        </div>
                        @if ($errors->has('email'))
                        <div class="valid-feedback" style="display: inline; color: red;">
                            {{$errors->first('email')}}
                        </div>
                        @endif
                    </div>
                    <div class="row mb-2">
                        <div class="input-group mb-1"><span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                            </svg></span>
                          <input class="form-control" type="password" placeholder="{{__('login.password')}}" name="password" min="6" required>
                        </div>
                        @if ($errors->has('password'))
                            <div class="valid-feedback" style="display: inline; color: red;">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">{{__('login.login')}}</button>
                        </div>
                      </div>
                      <div class="col-6 text-end">
                        <button class="btn btn-link px-0" type="button"><a href="{{route('password.request')}}">{{__('login.forgot_password')}}</a></button>
                      </div>
                    </div>
                  </form>
                  <div class="row" style="margin-top: 5%">
                    <div class="col-6">
                      <p>Bạn chưa có tài khoản?</p>
                    </div>
                    <div class="col-6" style="text-align: right">
                      <a href="{{route('register.create')}}">Đăng ký ngay!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('backend/assets/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('functions/functions.js')}}"></script>
    <script>
    </script>
  </body>
</html>
