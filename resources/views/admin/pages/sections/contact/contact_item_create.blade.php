@extends('admin.layouts.layout')

@section('content')
    <!--Header-->
    <header class="header header-sticky p-0 mb-4">
        @include('admin.layouts.user_option')
        <!-- Breadcrumb-->
        <div class="container-fluid px-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0">
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.components') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.home') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.contact_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>@lang('admin/contact/contact.create_item')</a></li>
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
                            <div class="card-header">
                                <h2>{{ __('admin/contact/contact.create_item') }}</h2>
                            </div>
                            <form method="POST" id="data-form" class="was-validated" novalidate
                                action="{{ route('admin.contact_item.store') }}" enctype="multipart/form-data">
                                @csrf
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
                                                @if (session('status') === 'created')
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/contact/contact.item_created') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.title_required')</label>
                                                    <input class="form-control" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/common.title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_title')" required>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/contact/contact.first_line_required')</label>
                                                    <textarea class="form-control" rows="5" id="first_line" name="first_line" type="text"
                                                        placeholder="@lang('admin/contact/contact.info_placeholder')" onchange="loadDocument(event, 'preview_first_line')"
                                                        onkeypress="detectEnterline(event, 'preview_first_line'); loadDocument(event, 'preview_first_line')" required></textarea>
                                                    @if ($errors->has('first_line'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('first_line') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/contact/contact.second_line_required')</label>
                                                    <textarea class="form-control" rows="5" id="second_line" name="second_line" type="text"
                                                        placeholder="@lang('admin/contact/contact.info_placeholder')" onchange="loadDocument(event, 'preview_second_line')"
                                                        onkeypress="detectEnterline(event, 'preview_second_line'); loadDocument(event, 'preview_second_line')" required></textarea>
                                                    @if ($errors->has('second_line'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('second_line') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.icon_required') <a
                                                            href="https://icons.getbootstrap.com/"
                                                            target="_blank">({{ __('admin/count/count.choose_icon_here') }})</a></label>
                                                    <input class="form-control" id="icon" name="icon" type="text"
                                                        onchange="changeAttribute(event, 'preview_icon', 'class')"
                                                        value="bi bi-geo-alt" required>
                                                    @if ($errors->has('icon'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/common.status_required')</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option selected value="1">{{ __('admin/common.display') }}
                                                        </option>
                                                        <option value="0">{{ __('admin/common.hide') }}</option>
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
                                                            <h2>
                                                                {{ ShowTextData($contact_title, 'section_name', __('admin/common.section_name_preview')) }}
                                                            </h2>
                                                            <p>
                                                                {{ ShowTextData($contact_title, 'title', __('admin/common.title_preview')) }}
                                                            </p>
                                                        </header>
                                                        <div class="row gy-4">
                                                            <div class="col-lg-6">
                                                                <div class="row gy-4">
                                                                    @foreach ($contact_items as $contact_item_local)
                                                                        <div class="col-md-6">
                                                                            <div class="info-box">
                                                                                <i
                                                                                    class="{{ $contact_item_local->icon }}"></i>
                                                                                <h3>{{ $contact_item_local->title }}</h3>
                                                                                <p>{{ $contact_item_local->first_line }}
                                                                                </p>
                                                                                <p>{{ $contact_item_local->second_line }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="col-md-6">
                                                                        <div class="info-box">
                                                                            <i id="preview_icon"
                                                                                class="bi bi-geo-alt"></i>
                                                                            <h3 id="preview_title">@lang('admin/common.title')</h3>
                                                                            <p id="preview_first_line">@lang('admin/contact/contact.first_line')
                                                                            </p>
                                                                            <p id="preview_second_line">@lang('admin/contact/contact.second_line')
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="row gy-4">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control"
                                                                            name="name"
                                                                            placeholder="@lang('admin/common.your_name_required')">
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <input type="email" class="form-control"
                                                                            name="email"
                                                                            placeholder="@lang('admin/common.your_email_required')">
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <input type="tel" class="form-control"
                                                                            name="phone_number"
                                                                            placeholder="@lang('admin/common.phone_number_required')">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control"
                                                                            name="title_message"
                                                                            placeholder="@lang('admin/common.title_required')">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" name="message" rows="6" placeholder="@lang('admin/common.message_required')"></textarea>
                                                                    </div>
                                                                    <div class="col-md-12 text-center">
                                                                        <button disabled class="preview_send_message">Send
                                                                            Message</button>
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
                                                type="submit">{{ __('admin/common.create_new') }}</button>
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
