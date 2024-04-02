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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.feature_tab_items') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/feature/feature.edit_tab_item') }}</a></li>
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
                                <h2>{{ __('admin/feature/feature.edit_tab_item') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ route('admin.feature_tab_item.update', $feature_tab_item->id) }}"
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
                                                        {{ __('admin/feature/feature.tab_item_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_name') }}</label>
                                                    <input class="form-control" id="tab_name" name="tab_name"
                                                        type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_name_placeholder') }}"
                                                        value="{{ $feature_tab_item->tab_name }}"
                                                        onchange="loadDocument(event, 'preview_tab_name')">
                                                    @if ($errors->has('tab_name'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('tab_name') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_id') }}</label>
                                                    <input class="form-control" id="tab_id" name="tab_id" type="text"
                                                        readonly style="background-color: rgba(187, 187, 187, 0.4)"
                                                        value="{{ $feature_tab_item->tab_id }}">
                                                    @if ($errors->has('tab_id'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('tab_id') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_first_description') }}</label>
                                                    <textarea class="form-control" rows="1" id="first_description" name="first_description" type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_first_description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_first_description')"
                                                        onkeypress="detectEnterline(event, 'first_description'); loadDocument(event, 'preview_first_description')">{{ $feature_tab_item->first_description }}</textarea>
                                                    @if ($errors->has('first_description'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('first_description') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_first_title') }}</label>
                                                    <textarea class="form-control" rows="1" id="first_title" name="first_title" type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_first_title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_first_title')"
                                                        onkeypress="detectEnterline(event, 'first_title'); loadDocument(event, 'preview_first_title')">{{ $feature_tab_item->first_title }}</textarea>
                                                    @if ($errors->has('first_title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('first_title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_second_description') }}</label>
                                                    <textarea class="form-control" rows="1" id="second_description" name="second_description" type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_second_description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_second_description')"
                                                        onkeypress="detectEnterline(event, 'second_description'); loadDocument(event, 'preview_second_description')">{{ $feature_tab_item->second_description }}</textarea>
                                                    @if ($errors->has('second_description'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('second_description') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_second_title') }}</label>
                                                    <textarea class="form-control" rows="1" id="second_title" name="second_title" type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_second_title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_second_title')"
                                                        onkeypress="detectEnterline(event, 'second_title'); loadDocument(event, 'preview_second_title')">{{ $feature_tab_item->second_title }}</textarea>
                                                    @if ($errors->has('second_title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('second_title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.tab_item_third_description') }}</label>
                                                    <textarea class="form-control" rows="1" id="third_description" name="third_description" type="text"
                                                        placeholder="{{ __('admin/feature/feature.tab_item_third_description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_third_description')"
                                                        onkeypress="detectEnterline(event, 'third_description'); loadDocument(event, 'preview_third_description')">{{ $feature_tab_item->third_description }}</textarea>
                                                    @if ($errors->has('third_description'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('third_description') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status"
                                                        onchange="changeStatus(event, 'status', 'can-hide')">
                                                        <option {!! $feature_tab_item->status == 1 ? 'selected' : '' !!} value="1">
                                                            {{ __('admin/common.display') }}</option>
                                                        <option {!! $feature_tab_item->status == 0 ? 'selected' : '' !!} value="0">
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
                                                        <div class="row feture-tabs" data-aos="fade-up">
                                                            <div class="col-lg-6">
                                                                <h3 id="preview_title">
                                                                    {{ $feature_tab_title ? ($feature_tab_title->title === '' ? __('admin/feature/feature.title_placeholder') : $feature_tab_title->title) : __('admin/feature/feature.title_placeholder') }}
                                                                </h3>
                                                                <ul class="nav mb-3">
                                                                    @if (count($feature_tab_items) > 0)
                                                                        @foreach ($feature_tab_items as $feature_tab_item_local)
                                                                            <li><a id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_tab_name' : '' }}"
                                                                                    class="nav-link {{ $feature_tab_item_local->id == $feature_tab_item->id ? 'active' : '' }}"
                                                                                    data-bs-toggle="pill"
                                                                                    href="#{{ $feature_tab_item_local->tab_id }}">{{ $feature_tab_item_local->tab_name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                                <div class="tab-content custom">
                                                                    @if (count($feature_tab_items) > 0)
                                                                        @foreach ($feature_tab_items as $feature_tab_item_local)
                                                                            <div class="tab-pane fade {{ $feature_tab_item_local->id == $feature_tab_item->id ? 'show active' : '' }}"
                                                                                id="{{ $feature_tab_item_local->tab_id }}">
                                                                                <p
                                                                                    id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_first_description' : '' }}">
                                                                                    {{ $feature_tab_item_local->first_description }}
                                                                                </p>
                                                                                <div
                                                                                    class="d-flex align-items-center mb-2">
                                                                                    <i class="bi bi-check2"></i>
                                                                                    <h4
                                                                                        id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_first_title' : '' }}">
                                                                                        {{ $feature_tab_item_local->first_title }}
                                                                                    </h4>
                                                                                </div>
                                                                                <p
                                                                                    id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_second_description' : '' }}">
                                                                                    {{ $feature_tab_item_local->second_description }}
                                                                                </p>
                                                                                <div
                                                                                    class="d-flex align-items-center mb-2">
                                                                                    <i class="bi bi-check2"></i>
                                                                                    <h4
                                                                                        id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_second_title' : '' }}">
                                                                                        {{ $feature_tab_item_local->second_title }}
                                                                                    </h4>
                                                                                </div>
                                                                                <p
                                                                                    id="{{ $feature_tab_item_local->id == $feature_tab_item->id ? 'preview_third_description' : '' }}">
                                                                                    {{ $feature_tab_item_local->third_description }}
                                                                                </p>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <img src="{{ asset('frontend/assets/img/features-2.png') }}"
                                                                    class="img-fluid" alt="">
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
