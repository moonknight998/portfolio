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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.terms_of_service') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/termsofservice/termsofservice.update_section') }}</a>
                    </li>
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
                                <h2>@lang('admin/termsofservice/termsofservice.update_section')</h2>
                            </div>
                            <form class="was-validated" novalidate method="POST"
                                action="{{ $terms_of_service ? route('admin.terms_of_service.update', $terms_of_service->id) : route('admin.terms_of_service.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($terms_of_service)
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
                                                        @lang('admin/termsofservice/termsofservice.updated')
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label class="form-label">@lang('admin/termsofservice/termsofservice.title_required')</label>
                                                    <input class="form-control" name="title" type="text"
                                                        placeholder="@lang('admin/termsofservice/termsofservice.title_placeholder')"
                                                        onchange="loadDocument(event, 'preview_title')" required
                                                        minlength="3" maxlength="500"
                                                        value="{{ $terms_of_service ? $terms_of_service->title : '' }}"></input>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/termsofservice/termsofservice.content_required') }}</label>
                                                    <textarea class="form-control" rows="5" id="ckeditor5" name="content" type="text" required>{!! $terms_of_service ? $terms_of_service->content : '' !!}</textarea>
                                                    @if ($errors->has('content'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('content') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option
                                                            {{ $terms_of_service ? ($terms_of_service->status == 1 ? 'selected' : '') : 'selected' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option
                                                            {{ $terms_of_service ? ($terms_of_service->status == 0 ? 'selected' : '') : '' }}value="0">
                                                            {{ __('admin/common.hide') }}</option>
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
                                            </div>
                                            <section id="blog" class="blog">
                                                <div class="container" data-aos="fade-up">
                                                    <div class="row" style="margin-top: 50pt">
                                                        <div class="col-lg-12 entries">
                                                            <article class="entry entry-single">
                                                                <h2 class="entry-title">
                                                                    <a
                                                                        id="preview_title">{{ $terms_of_service ? $terms_of_service->title : __('admin/termsofservice/termsofservice.title_preview') }}</a>
                                                                </h2>
                                                                <div class="entry-meta">
                                                                    <ul>
                                                                        <li class="d-flex align-items-center"><i
                                                                                class="bi bi-person"></i><a>@lang('admin/common.admin')</a>
                                                                        </li>
                                                                        <li class="d-flex align-items-center"><i
                                                                                class="bi bi-clock"></i><a><time>{{ $terms_of_service ? __('admin/common.updated_at') . ':' . ' ' . date('d-m-Y', strtotime($terms_of_service->updated_at)) : __('admin/common.updated_at') . ':' . ' ' . date('d-m-Y') }}</time></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div id="preview_content" class="ck-content">
                                                                    @if ($terms_of_service)
                                                                        {!! $terms_of_service->content !!}
                                                                    @else
                                                                        <p>{{ __('admin/termsofservice/termsofservice.content_preview') }}
                                                                        </p>
                                                                    @endif
                                                                    <!--Post content-->
                                                                </div>
                                                            </article><!-- End blog entry -->
                                                        </div><!-- End blog entries list -->
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <!--End Preview Tab-->
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <button class="btn btn-primary mb-3"
                                                type="submit">{{ $terms_of_service ? __('admin/common.update') : __('admin/common.create_new') }}</button>
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
    <!--End Main Part-->
    @include('admin.pages.single.single_page_ckeditor5')
@endsection
