@extends('admin.layouts.layout')

@section('content')
    <!--Breadcrumb-->
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><a
                            href="{{ route('dashboard') }}">{{ __('admin-header.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active"><a>{{ __('admin-profile.profile') }}</a></li>
                </ol>
            </nav>
        </div>
    </header>
    <!--End Breadcrumb-->
    <!--Main Part-->
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h2 class="mb-4">{{ __('admin-profile.edit_profile') }}</h2>
                                @if (session('status') === 'profile-updated')
                                    <div class="row mb-0">
                                        <div class="valid-feedback mb-4" style="display: inline; color: rgb(25, 192, 25);">
                                            {{ __('admin-profile.profile_updated') }}
                                        </div>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row mb-2">
                                        <div class="input-group mb-1"><span class="input-group-text">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                                                    </use>
                                                </svg></span>
                                            <input id="name" class="form-control" type="text"
                                                placeholder="{{ __('admin-profile.name') }}" name="name" value="{{ $user->name }}">
                                        </div>
                                        @if ($errors->has('name'))
                                            <div class="valid-feedback" style="display: inline; color: red;">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-2">
                                        <div class="input-group mb-1"><span class="input-group-text">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed') }}">
                                                    </use>
                                                </svg></span>
                                            <input id="email" name="email" type="email" class="form-control"
                                                readonly value="{{ $user->email }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="valid-feedback" style="display: inline; color: red;">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary px-2 rounded">@lang('admin/common.update')</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-12">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h2 class="mb-4">{{ __('admin-profile.edit_password') }}</h2>
                                @if (session('status') === 'password-updated')
                                    <div class="row mb-0">
                                        <div class="valid-feedback mb-4" style="display: inline; color: rgb(25, 192, 25);">
                                            {{ __('admin-profile.password_updated') }}
                                        </div>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-2">
                                        <div class="input-group mb-1"><span class="input-group-text">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                    </use>
                                                </svg></span>
                                            <input id="update_password_current_password" name="current_password"
                                                type="password" class="form-control"
                                                placeholder="{{ __('admin-profile.current_password') }}">
                                        </div>
                                        @if ($errors->updatePassword->has('current_password'))
                                            <div class="valid-feedback" style="display: inline; color: red;">
                                                {{ $errors->updatePassword->first('current_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-2">
                                        <div class="input-group mb-1"><span class="input-group-text">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                    </use>
                                                </svg></span>
                                            <input id="update_password_password" name="new_password" type="password"
                                                class="form-control" placeholder="{{ __('admin-profile.new_password') }}">
                                        </div>
                                        @if ($errors->updatePassword->has('new_password'))
                                            <div class="valid-feedback" style="display: inline; color: red;">
                                                {{ $errors->updatePassword->first('new_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mb-2">
                                        <div class="input-group mb-1"><span class="input-group-text">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                    </use>
                                                </svg></span>
                                            <input id="update_password_password_confirmation" name="new_password_confirmation"
                                                type="password" class="form-control"
                                                placeholder="{{ __('admin-profile.confirm_password') }}">
                                        </div>
                                        @if ($errors->updatePassword->has('new_password_confirmation'))
                                            <div class="valid-feedback" style="display: inline; color: red;">
                                                {{ $errors->updatePassword->first('new_password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary px-2 rounded">@lang('admin/common.update')</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Part-->
@endsection
