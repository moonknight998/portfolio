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
                    <li class="breadcrumb-item active"><a>{{ __('admin/count/count.create_count') }}</a></li>
                </ol>
            </nav>
        </div>
        <!--End Breadcumb-->
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
                                <h2>{{ __('admin/value/value-index.create_new_card') }}</h2>
                            </div>
                            <form method="POST" action="{{ route('admin.count.store') }}" enctype="multipart/form-data">
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
                                                        {{ __('admin/count/count.created') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/count/count.title') }}</label>
                                                    <input class="form-control" id="title" required name="title"
                                                        type="text"
                                                        placeholder="{{ __('admin/count/count.title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_title')">
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/count/count.quantity') }}
                                                        <a>({{ __('admin/common.only_nonnegative_integer') }})</a></label>
                                                    <input class="form-control" id="quantity" required name="quantity"
                                                        type="number" min="1" step="1"
                                                        placeholder="{{ __('admin/count/count.quantity_placeholder') }}"
                                                        onchange="changeAttribute(event, 'preview_quantity', 'data-purecounter-end')">
                                                    @if ($errors->has('quantity'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('quantity') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.icon') }} <a
                                                            href="https://icons.getbootstrap.com/"
                                                            target="_blank">({{ __('admin/count/count.choose_icon_here') }})</a></label>
                                                    <input class="form-control" id="icon" name="icon" type="text"
                                                        onchange="changeAttribute(event, 'preview_icon', 'class')">
                                                    @if ($errors->has('icon'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.icon_color') }}</label>
                                                    <input class="form-control form-control-color" id="icon_color"
                                                        name="icon_color" type="color" value="#f00000"
                                                        onchange="changeColor(event, 'preview_icon')">
                                                    @if ($errors->has('icon_color'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon_color') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status">
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
                                                @if ($detect->isMobile())
                                                    <div class="alert alert-warning fade show mt-4" role="alert">
                                                        {{ __('admin/common.about_mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section id="counts" class="counts">
                                                    <div class="container" data-aos="fade-up">
                                                        <div class="row gy-4" style="justify-content: center">
                                                            @if ($counts)
                                                                @foreach ($counts as $count)
                                                                    <div class="col-lg-3 col-md-6">
                                                                        <div class="count-box">
                                                                            <i class="{{ $count->icon }}"
                                                                                style="color: {{ $count->icon_color }}"></i>
                                                                            <div>
                                                                                <span data-purecounter-start="0"
                                                                                    data-purecounter-end="{{ $count->quantity }}"
                                                                                    data-purecounter-duration="1"
                                                                                    class="purecounter">1</span>
                                                                                <p>{{ $count->title }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="count-box">
                                                                    <i id="preview_icon" class="bi bi-emoji-smile"
                                                                        style="color: red"></i>
                                                                    <div>
                                                                        <span id="preview_quantity"
                                                                            data-purecounter-start="0"
                                                                            data-purecounter-end="1000"
                                                                            data-purecounter-duration="1"
                                                                            class="purecounter">1</span>
                                                                        <p id="preview_title">
                                                                            {{ __('admin/count/count.title_placeholder') }}
                                                                        </p>
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
    </div>
    <!--End Main Part-->

@endsection
