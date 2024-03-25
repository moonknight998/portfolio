@extends('admin.layouts.layout')

@section('content')
    <!--Breadcrumb-->
    <header class="header header-sticky mb-4" style="z-index: 0">
        <div class="container-fluid m-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.components') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.home') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.contact_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/contact/contact.title') }}</a></li>
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
                            <div class="card-header">
                                <h2>{{ __('admin/contact/contact.update_title') }}</h2>
                            </div>
                            <form method="POST" id="data-form" class="was-validated" novalidate
                                action="{{ $contact_title == null ? route('admin.contact_title.store') : route('admin.contact_title.update', $contact_title->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($contact_title)
                                    @method('PATCH')
                                @endif
                                <div class="card-body">
                                    <div class="example">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                    data-coreui-toggle="tab" role="tab" aria-selected="true"
                                                    onclick="openTab(event, 'content_tab', 'preview_tab')">
                                                    <svg class="icon me-2">
                                                        <use
                                                            xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-media-play') }}">
                                                        </use>
                                                    </svg>{{ __('admin/common.content') }}</a>
                                            </li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-coreui-toggle="tab" role="tab" aria-selected="false"
                                                    onclick="openTab(event, 'preview_tab', 'content_tab')">
                                                    <svg class="icon me-2">
                                                        <use
                                                            xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-code') }}">
                                                        </use>
                                                    </svg>{{ __('admin/common.preview') }}</a>
                                            </li>
                                        </ul>
                                        <!--Edit Tab-->
                                        <div class="tab-content rounded-bottom" id="content_tab">
                                            <div class="tab-pane p-3 active preview" role="tabpanel">
                                                @if (session('status') === 'updated')
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/contact/contact.title_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('status') === 'required')
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/contact/contact.title_required') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.section_name_required')</label>
                                                    <input class="form-control" id="section_name" name="section_name"
                                                        type="text"
                                                        placeholder="{{ __('admin/common.section_name_placeholder') }}"
                                                        value="{{ ShowFormValue($contact_title, 'section_name') }}"
                                                        onchange="loadDocument(event, 'preview_section_name')" required>
                                                    @if ($errors->has('section_name'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('section_name') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.title_required')</label>
                                                    <textarea class="form-control" rows="5" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/common.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')" required>{{ ShowFormValue($contact_title, 'title') }}</textarea>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.status_required')</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option
                                                            {{ $contact_title ? ($contact_title->status == 1 ? 'selected' : '') : 'selected' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option
                                                            {{ $contact_title ? ($contact_title->status == 0 ? 'selected' : '') : '' }}
                                                            value="0">{{ __('admin/common.hide') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Edit Tab-->

                                        <!--Preview Tab-->
                                        <div class="tab-content rounded-bottom" id="preview_tab" style="display: none">
                                            <div class="tab-pane active preview" role="tabpanel">
                                                @if (MobileDetect()->isMobile())
                                                    <div class="alert alert-warning fade show mt-4" role="alert">
                                                        {{ __('admin/common.about_mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section id="contact" class="contact">
                                                    <div class="container" data-aos="fade-up">
                                                        <header class="section-header">
                                                            <h2 id="preview_section_name">
                                                                {{ ShowTextData($contact_title, 'section_name', __('admin/common.section_name_preview')) }}
                                                            </h2>
                                                            <p id="preview_title">
                                                                {{ ShowTextData($contact_title, 'title', __('admin/common.title_preview')) }}
                                                            </p>
                                                        </header>
                                                        <div class="row gy-4">
                                                            <div class="col-lg-6">
                                                                <div class="row gy-4">
                                                                    <div class="col-md-6">
                                                                        <div class="info-box">
                                                                            <i class="bi bi-geo-alt"></i>
                                                                            <h3>Address</h3>
                                                                            <p>A108 Adam Street,<br>New York, NY 535022</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="info-box">
                                                                            <i class="bi bi-telephone"></i>
                                                                            <h3>Call Us</h3>
                                                                            <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="info-box">
                                                                            <i class="bi bi-envelope"></i>
                                                                            <h3>Email Us</h3>
                                                                            <p>info@example.com<br>contact@example.com</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="info-box">
                                                                            <i class="bi bi-clock"></i>
                                                                            <h3>Open Hours</h3>
                                                                            <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="row gy-4">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="name" placeholder="@lang('admin/common.your_name_required')">
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <input type="email" class="form-control" name="email" placeholder="@lang('admin/common.your_email_required')">
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <input type="tel" class="form-control" name="phone_number" placeholder="@lang('admin/common.phone_number_required')">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" name="title_message" placeholder="@lang('admin/common.title_required')">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" name="message" rows="6" placeholder="@lang('admin/common.message_required')"></textarea>
                                                                    </div>
                                                                    <div class="col-md-12 text-center">
                                                                        <button disabled class="preview_send_message">Send Message</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <!--End Preview Tab-->
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <button class="btn btn-primary mb-3"
                                                type="submit">{{ __('admin/common.update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.notification.notification')
    </div>
    <!--End Main Part-->
@endsection
