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
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="card email-app">
                <div class="card-body">
                    <div class="btn-toolbar mb-4">
                        <div class="btn-group me-1 d-lg-inline-flex d-none">
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-star') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-bookmark') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                        <div class="btn-group me-1 d-lg-none">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                    </use>
                                </svg><span class="caret"></span>
                            </button>
                            <div class="dropdown-menu message-option">
                                <div class="btn-group me-1">
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-star') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-bookmark') }}">
                                            </use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="btn-group me-1">
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-all') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <button class="btn btn-secondary" type="button">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-boxed') }}">
                                            </use>
                                        </svg>
                                    </button>
                                </div>
                                <button class="btn btn-secondary me-1" type="button">
                                    <svg class="icon">
                                        <use
                                            xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                        </use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="btn-group me-1 d-lg-inline-flex d-none">
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-all') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-boxed') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                        <button class="btn btn-secondary me-1 d-lg-inline-flex d-none" type="button">
                            <svg class="icon">
                                <use
                                    xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-tras') }}h">
                                </use>
                            </svg>
                        </button>
                        <div class="btn-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-tags') }}">
                                    </use>
                                </svg><span class="caret"></span>
                            </button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">add label<span
                                        class="badge bg-danger-gradient ms-2"> Home</span></a><a class="dropdown-item"
                                    href="#">add label<span class="badge bg-info-gradient ms-2"> Job</span></a><a
                                    class="dropdown-item" href="#">add label<span
                                        class="badge bg-success-gradient ms-2"> Clients</span></a><a class="dropdown-item"
                                    href="#">add label<span class="badge bg-warning-gradient ms-2"> News</span></a>
                            </div>
                        </div>
                        <div class="btn-group d-none ms-auto">
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-chevron-left') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-chevron-right') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="message">
                        <div class="message-details flex-wrap pb-3">
                            <div class="message-headers d-flex flex-col flex-lg-wrap">
                                <div class="message-headers-subject w-100 fs-5 fw-semibold">
                                    {{ $contact_message->message_title }}</div>
                                <div class="row justify-between">
                                    <div class="col-lg d-lg-flex d-block overflow-hidden">
                                        <div class="message-headers-from">{{ $contact_message->name }}<span
                                            class="text-body-secondary"> {{$contact_message->email === null ? '('.__('admin/common.no_email').')' : '('.$contact_message->email.')'}}</span></div>
                                    </div>
                                    <div class="col-lg d-lg-flex d-block justify-content-lg-end overflow-hidden">
                                        <div class="message-headers-date ms-lg-auto">
                                            {{-- <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-paperclip') }}">
                                                </use>
                                            </svg> --}}
                                            {{ $contact_message->created_at->format('h:m, d-m-Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="message-body">
                                <p>{{ $contact_message->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Part-->
@endsection
