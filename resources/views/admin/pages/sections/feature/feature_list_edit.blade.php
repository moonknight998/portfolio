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
                    <li class="breadcrumb-item"><a>{{ __('admin/feature/feature.feature_list') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/feature/feature.edit_feature') }}</a></li>
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
                                <h2>{{ __('admin/feature/feature.edit_feature') }}</h2>
                            </div>
                            <form method="POST" action="{{ route('admin.feature_list.update', $feature_list_item->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
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
                                                        {{ __('admin/feature/feature.feature_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.title') }}</label>
                                                    <input class="form-control" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/feature/feature.title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_feature_list_title')"
                                                        value="{{ $feature_list_item->title }}">
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.icon') }} <a
                                                            href="https://icons.getbootstrap.com/"
                                                            target="_blank">({{ __('admin/count/count.choose_icon_here') }})</a></label>
                                                    <input class="form-control" id="icon" name="icon"
                                                        type="text"
                                                        onchange="changeAttribute(event, 'preview_icon', 'class')"
                                                        value="{{ $feature_list_item->icon }}">
                                                    @if ($errors->has('icon'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status"
                                                        onchange="changeStatus(event, 'status', 'can-hide')">
                                                        <option {!! $feature_list_item->status == 1 ? 'selected' : '' !!} value="1">
                                                            {{ __('admin/common.display') }}</option>
                                                        <option {!! $feature_list_item->status == 0 ? 'selected' : '' !!} value="0">
                                                            {{ __('admin/common.hide') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Edit Tab-->

                                        <!--Preview Tab-->
                                        <div class="tab-content rounded-bottom" id="preview_tab" style="display: none">
                                            <div class="tab-pane active preview" role="tabpanel">
                                                @if ($detect->isMobile())
                                                    <div class="alert alert-warning fade show mt-4" role="alert">
                                                        {{ __('admin/common.about_mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section id="features" class="features">
                                                    <div class="container-fluid aos-init aos-animate" data-aos="fade-up">
                                                        @if ($feature_title && $feature_title->status == 1)
                                                            <header class="section-header" style="display: block;">
                                                                <h2 id="preview_section_name">
                                                                    {{ $feature_title->section_name ? $feature_title->section_name : __('admin/feature/feature.section_name_placeholder') }}
                                                                </h2>
                                                                <p id="preview_title">
                                                                    {{ $feature_title->title ? $feature_title->title : __('admin/feature/feature.title_placeholder') }}
                                                                </p>
                                                            </header>
                                                        @else
                                                            <!--If feature_title not exist-->
                                                            <header class="section-header" style="display: block;">
                                                                <h2 id="preview_section_name">
                                                                    {{ __('admin/feature/feature.section_name_placeholder') }}
                                                                </h2>
                                                                <p id="preview_title">
                                                                    {{ __('admin/feature/feature.title_placeholder') }}</p>
                                                            </header>
                                                        @endif
                                                        <div class="row">
                                                            @if ($feature_title && $feature_title->status == 1)
                                                                <div class="col-lg-6"
                                                                    style="display: flex; justify-content: center; align-content: center;">
                                                                    <img src="{{ $feature_title->image ? asset($feature_title->image) : asset('/frontend/assets/img/features.png') }}"
                                                                        class="img-fluid" alt="">
                                                                </div>
                                                            @else
                                                                <div class="col-lg-6"
                                                                    style="display: flex; justify-content: center; align-content: center;">
                                                                    <img src="{{ asset('/frontend/assets/img/features.png') }}"
                                                                        class="img-fluid" alt="">
                                                                </div>
                                                            @endif
                                                            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                                                                <div class="row-md-6 align-self-center gy-4"
                                                                    style="width: 100%">
                                                                    @if (count($feature_lists) > 0)
                                                                        @foreach ($feature_lists as $feature_list_item_local)
                                                                            <div class="col-md-6 aos-init aos-animate py-1"
                                                                                data-aos="zoom-out" data-aos-delay="200"
                                                                                style="width: 100%; display: block">
                                                                                <div class="feature-box d-flex align-items-center"
                                                                                    style="width: 100%;">
                                                                                    <i id="{{ $feature_list_item_local->id == $feature_list_item->id ? 'preview_icon' : '' }}"
                                                                                        class="{{ $feature_list_item_local->icon }}"></i>
                                                                                    <h3
                                                                                        id="{{ $feature_list_item_local->id == $feature_list_item->id ? 'preview_feature_list_title' : '' }}">
                                                                                        {{ $feature_list_item_local->title }}
                                                                                    </h3>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
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
    </div>
    <!--End Main Part-->

@endsection
