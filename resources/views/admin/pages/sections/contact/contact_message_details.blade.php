@extends('admin.layouts.layout')

@section('content')
    <!--Header-->
    <header class="header header-sticky p-0 mb-4">
        @include('admin.layouts.user_option')
        <!-- Breadcrumb-->
        <div class="container-fluid px-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0">
                    <li class="breadcrumb-item"><a>{{ __('admin/common.user') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/common.messages') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/common.all_messages') }}</a></li>
                </ol>
            </nav>
        </div>
    </header>
    <!--End Header-->

    <!--Main Part-->
    <div class="body flex-grow-1 px-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-2 mb-4">
                            {{-- <div class="card-header">
                                <h2>@lang('admin/common.all_messages')</h2>
                            </div> --}}
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom tx-16">
                                        <div class="d-flex align-items-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                                <path
                                                    d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                            </svg>
                                            <span class="ms-3"
                                                style="font-size: 20px; font-weight: 500">@lang('admin/common.messages')</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar">
                                                <img src="{{ asset('backend/assets/img/avatars/blank_avatar.jpg') }}"
                                                    width="32" height="32" alt="Avatar" class="avatar-img">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a
                                                    class="text-center text-decoration-none px-2">{{ $contact_message->name }}</a>
                                                <span
                                                    class="text-muted px-2 d-none d-md-inline">{{ $contact_message->email }}</span>
                                                <div class="actions dropdown">
                                                    <a href="#" data-bs-toggle="dropdown"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-chevron-down icon-lg text-muted">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></a>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="#">Mark as read</a>
                                                        <a class="dropdown-item" href="#">Mark as unread</a>
                                                        <a class="dropdown-item" href="#">Spam</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tx-13 text-muted mt-sm-0">
                                            {{ $contact_message->created_at->format('d-m-Y') }}</div>
                                    </div>
                                </div>
                                <div class="p-4 border-bottom">
                                    <p class="mb-0 tx-13">{{ $contact_message->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--End Main Part-->
@endsection
