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
            <div class="card mb-4">
                <div class="card-body">
                    <div class="btn-toolbar mb-4">
                        <div class="btn-group me-1 d-lg-inline-flex d-none">
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-star') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-bookmark') }}">
                                    </use>
                                </svg>
                            </button>
                        </div>
                        <div class="btn-group me-1 d-lg-inline-flex d-none">
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share') }}">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-al') }}l">
                                    </use>
                                </svg>
                            </button>
                            <button class="btn btn-secondary d-inline-block" type="button">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-share-boxed') }}">
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
                        <div class="btn-group ms-auto">
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
                    <div class="messages">
                        @if (count($contact_messages) > 0)
                            @foreach ($contact_messages as $contact_message_local)
                                <a class="message d-flex mb-3 text-{{ $contact_message_local->status->value === 'seen' ? 'body-secondary' : 'high-emphasis' }} text-decoration-none"
                                    href="{{ route('admin.contact_message.message_details', $contact_message_local->slug) }}">
                                    <div class="message-actions me-3">
                                        <svg class="icon">
                                            <use
                                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-star') }}">
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="container-fluid px-0 message-details flex-wrap pb-3 border-bottom">
                                        <div class="message-headers flex-wrap">
                                            <div class="container-fluid px-0">
                                                <div class="row justify-between">
                                                    <div class="col-lg d-lg-flex d-block justify-content-lg-start">
                                                        <div class="message-headers-from">{{ $contact_message_local->name }}</div>
                                                    </div>
                                                    <div class="col-lg d-lg-flex d-block justify-content-lg-end">
                                                        <div class="message-headers-date">
                                                            {{-- <svg class="icon">
                                                                <use
                                                                    xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-paperclip') }}">
                                                                </use>
                                                            </svg> --}}
                                                            {{ $contact_message_local->created_at->format('H:m d-m-Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid px-0">
                                                <div class="row d-flex justify-start">
                                                    <div class="message-headers-subject w-100 fs-5 fw-semibold">
                                                        {{ $contact_message_local->message_title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="message-body">{{ $contact_message_local->message }}</div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Part-->
@endsection
