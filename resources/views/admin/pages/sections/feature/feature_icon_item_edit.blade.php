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
                    <li class="breadcrumb-item active"><a>{{ __('admin/feature/feature.edit_icon_item') }}</a></li>
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
                                <h2>{{ __('admin/feature/feature.edit_icon_item') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ route('admin.feature_icon_item.update', $feature_icon_item->id) }}"
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
                                                        {{ __('admin/feature/feature.icon_item_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.title') }}</label>
                                                    <input class="form-control" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/feature/feature.title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_item_title')"
                                                        value="{{ $feature_icon_item->title }}">
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/feature/feature.description') }}</label>
                                                    <textarea class="form-control" rows="1" id="description" name="description" type="text"
                                                        placeholder="{{ __('admin/feature/feature.description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_item_description')"
                                                        onkeypress="detectEnterline(event, 'description'); loadDocument(event, 'preview_item_description')">{{ $feature_icon_item->description }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('description') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.icon') }} <a
                                                            href="https://icons.getbootstrap.com/"
                                                            target="_blank">({{ __('admin/count/count.choose_icon_here') }})</a></label>
                                                    <input class="form-control" id="icon" name="icon" type="text"
                                                        onchange="changeAttribute(event, 'preview_item_icon', 'class')"
                                                        value="{{ $feature_icon_item->icon }}">
                                                    @if ($errors->has('icon'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option {{ $feature_icon_item->status == '1' ? 'selected' : '' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option {{ $feature_icon_item->status == '0' ? 'selected' : '' }}
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
                                                        {{ __('admin/common.about_mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section id="features" class="features">
                                                    <div class="row feature-icons aos-init aos-animate"
                                                        data-aos="fade-up">
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
                                                                    @foreach ($feature_icon_items as $feature_icon_item_local)
                                                                        <div class="col-md-6 icon-box aos-init aos-animate"
                                                                            data-aos="fade-up" data-aos-delay="300">
                                                                            <i id="{{ $feature_icon_item_local->id == $feature_icon_item->id ? 'preview_item_icon' : '' }}"
                                                                                class="{{ $feature_icon_item_local->icon }}"></i>
                                                                            <div>
                                                                                <h4
                                                                                    id="{{ $feature_icon_item_local->id == $feature_icon_item->id ? 'preview_item_title' : '' }}">
                                                                                    {{ $feature_icon_item_local->title }}
                                                                                </h4>
                                                                                <p
                                                                                    id="{{ $feature_icon_item_local->id == $feature_icon_item->id ? 'preview_item_description' : '' }}">
                                                                                    {{ $feature_icon_item_local->description }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
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
