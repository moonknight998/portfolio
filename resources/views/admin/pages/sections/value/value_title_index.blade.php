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
                    <li class="breadcrumb-item"><a>{{ __('admin/value/value-index.value_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/sidebar.value-title') }}</a></li>
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
                                <h2>{{ __('admin/value/value-index.edit') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ $value_title == null ? route('admin.value_title.store') : route('admin.value_title.update', $value_title->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($value_title)
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
                                                        {{ __('admin/value/value-index.updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('status') === 'required')
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/value/value-index.value_title_required') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.question') }}</label>
                                                    <input class="form-control" id="section_name" name="section_name"
                                                        type="text"
                                                        placeholder="{{ __('admin/value/value-index.section_name_placeholder') }}"
                                                        value="{{ $value_title ? ($value_title->section_name === '' ? old('section_name') : $value_title->section_name) : '' }}"
                                                        onchange="loadDocument(event, 'preview_section_name')">
                                                    @if ($errors->has('section_name'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('section_name') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.title') }}</label>
                                                    <textarea class="form-control" rows="5" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/value/value-index.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')">{{ $value_title ? ($value_title->title === '' ? old('title') : $value_title->title) : '' }}</textarea>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.status') }}</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option {!! $value_title ? ($value_title->status == 1 ? 'selected' : '') : 'selected' !!} value="1">
                                                            {{ __('admin/common.display') }}</option>
                                                        <option {!! $value_title ? ($value_title->status == 0 ? 'selected' : '') : '' !!} value="0">
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
                                                <section id="values" class="values">
                                                    <div class="container" data-aos="fade-up">
                                                        <header class="section-header">
                                                            <h2 id="preview_section_name">
                                                                {{ $value_title
                                                                    ? ($value_title->section_name === ''
                                                                        ? __('admin/value/value-index.section_name_placeholder')
                                                                        : $value_title->section_name)
                                                                    : __('admin/value/value-index.section_name_placeholder') }}
                                                            </h2>
                                                            <p id="preview_title">{!! $value_title
                                                                ? ($value_title->title === ''
                                                                    ? __('admin/value/value-index.title_placeholder')
                                                                    : $value_title->title)
                                                                : __('admin/value/value-index.title_placeholder') !!}</p>
                                                        </header>
                                                        <div class="row" style="justify-content: center">
                                                            @if (count($value_cards) > 0)
                                                                @foreach ($value_cards as $value_card_item)
                                                                    <div class="col-lg-4 mb-3" data-aos="fade-up"
                                                                        data-aos-delay="200">
                                                                        <div class="box">
                                                                            <img src="{{ $value_card_item->image === '' ? asset('frontend/assets/img/values-1.png') : asset($value_card_item->image) }}"
                                                                                class="img-fluid" alt="">
                                                                            <h3>{!! $value_card_item->title !!}</h3>
                                                                            <p>{!! $value_card_item->description !!}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-4 mb-3" data-aos="fade-up"
                                                                    data-aos-delay="200">
                                                                    <div class="box">
                                                                        <img src="{{ asset('frontend/assets/img/values-1.png') }}"
                                                                            class="img-fluid" alt="">
                                                                        <h3>{!! __('admin/value/value-index.title_placeholder') !!}</h3>
                                                                        <p>{!! __('admin/value/value-index.description_placeholder') !!}</p>
                                                                    </div>
                                                                </div>
                                                            @endif
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
