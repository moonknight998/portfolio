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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.feature_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/feature/feature.icon_title') }}</a></li>
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
                                <h2>{{ __('admin/feature/feature.update_icon_title') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ $feature_icon_title == null ? route('admin.feature_icon_title.store') : route('admin.feature_icon_title.update', $feature_icon_title->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($feature_icon_title)
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
                                                        {{ __('admin/feature/feature.icon_title_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('status') === 'required')
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/feature/feature.feature_title_required') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.title') }}</label>
                                                    <textarea class="form-control" rows="1" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/feature/feature.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')">{{ $feature_icon_title ? ($feature_icon_title->title === '' ? old('title') : $feature_icon_title->title) : '' }}</textarea>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.image') }}</label>
                                                    <input class="form-control" id="image" name="image" type="file"
                                                        onchange="loadFile(event, 'preview_image')">
                                                    @if ($errors->has('image'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('image') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option
                                                            {{ $feature_icon_title ? ($feature_icon_title->status == 1 ? 'selected' : '') : 'selected' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option
                                                            {{ $feature_icon_title ? ($feature_icon_title->status == 0 ? 'selected' : '') : '' }}
                                                            value="0">{{ __('admin/common.hide') }}</option>
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
                                                        {{ __('admin/common.mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section id="features" class="features">
                                                    <div class="row feature-icons aos-init aos-animate" data-aos="fade-up">
                                                        <h3 id="preview_title">
                                                            {{ $feature_icon_title ? ($feature_icon_title->title === '' ? old('title') : $feature_icon_title->title) : __('admin/feature/feature.title_placeholder') }}
                                                        </h3>
                                                        <div class="row">
                                                            <div class="col-xl-4 text-center aos-init aos-animate"
                                                                data-aos="fade-right" data-aos-delay="100">
                                                                <img src="{{ $feature_icon_title ? ($feature_icon_title->image === '' ? asset('frontend/assets/img/features-3.png') : $feature_icon_title->image) : asset('frontend/assets/img/features-3.png') }}"
                                                                    class="img-fluid p-4" alt="">
                                                            </div>
                                                            <div class="col-xl-8 d-flex content">
                                                                <div class="row align-self-center gy-4"
                                                                    style="width: 100%">
                                                                    @if (count($feature_icon_items) > 0)
                                                                        @foreach ($feature_icon_items as $feature_icon_item_local)
                                                                            <div class="col-md-6 icon-box aos-init aos-animate"
                                                                                data-aos="fade-up" data-aos-delay="300">
                                                                                <i
                                                                                    class="{{ $feature_icon_item_local->icon }}"></i>
                                                                                <div>
                                                                                    <h4>{{ $feature_icon_item_local->title }}
                                                                                    </h4>
                                                                                    <p>{{ $feature_icon_item_local->description }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-6 icon-box aos-init aos-animate"
                                                                            data-aos="fade-up" data-aos-delay="300">
                                                                            <i class="bi bi-check2-all"></i>
                                                                            <div>
                                                                                <h4>{{ __('admin/common.title_preview') }}
                                                                                </h4>
                                                                                <p>{{ __('admin/common.description_preview') }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
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
