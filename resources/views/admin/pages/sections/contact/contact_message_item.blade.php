@extends('admin.layouts.layout')

@section('content')
    <!--Breadcrumb-->
    <header class="header header-sticky mb-4" style="z-index: 0">
        <div class="container-fluid m-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item"><a>{{ __('admin/common.user') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/common.messages') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/common.all_messages') }}</a></li>
                </ol>
            </nav>
        </div>
    </header>
    <!--End Breadcrumb-->

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
                                <div class="col-lg">
                                    <div class="p-3 border-bottom">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                                    </svg>
                                                    <h4 class="me-1">@lang('admin/common.inbox')</h4>
                                                    <span class="text-muted">(2 new messages)</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" placeholder="Search mail...">
                                                    <button class="btn btn-light btn-icon" type="button"
                                                        id="button-search-addon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-search">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65"
                                                                y2="16.65"></line>
                                                        </svg></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="d-flex align-items-center justify-content-end flex-grow-1">
                                            <span class="me-2">1-10 of 253</span>
                                            <div class="btn-group">
                                                <button class="btn btn-outline-secondary btn-icon" type="button"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-chevron-left">
                                                        <polyline points="15 18 9 12 15 6"></polyline>
                                                    </svg></button>
                                                <button class="btn btn-outline-secondary btn-icon" type="button"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-list">

                                        <!-- email list item -->
                                        <div class="email-list-item email-list-item--unread">
                                            <div class="email-list-actions">
                                              <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                              </div>
                                              <a class="favorite"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span></a>
                                            </div>
                                            <a class="email-list-detail">
                                              <div class="content">
                                                <span class="from">Cedric Kelly</span>
                                                <p class="msg">Urgent message!</p>
                                              </div>
                                              <span class="date">
                                                08 Jan
                                              </span>
                                            </a>
                                        </div>
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
