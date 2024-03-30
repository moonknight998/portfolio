@extends('admin.layouts.layout')

@section('content')
    <!--Header-->
    <header class="header header-sticky p-0 mb-4">
        @include('admin.layouts.user_option')
        <!-- Breadcrumb-->
        <div class="container-fluid m-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.components') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.home') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/about/about-index.about-section') }}</a></li>
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
                                <h2>{{ __('admin/about/about-index.edit') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ $about == null ? route('admin.about.store') : route('admin.about.update', $about->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($about)
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
                                                        {{ __('admin/about/about-index.updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.question') }}</label>
                                                    <input class="form-control" id="question" name="question"
                                                        type="text"
                                                        placeholder="{{ __('admin/about/about-index.question-placeholder') }}"
                                                        value="{{ $about ? ($about->question === '' ? old('question') : $about->question) : '' }}"
                                                        onchange="loadDocument(event, 'preview_question')">
                                                    @if ($errors->has('question'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('question') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.title') }}</label>
                                                    <textarea class="form-control" rows="5" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/about/about-index.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')">{{ $about ? ($about->title === '' ? old('title') : $about->title) : '' }}</textarea>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.summary') }}</label>
                                                    <textarea class="form-control" rows="5" id="summary" name="summary" type="text"
                                                        placeholder="{{ __('admin/about/about-index.summary_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_summary')"
                                                        onkeypress="detectEnterline(event, 'summary'); loadDocument(event, 'preview_summary')">{{ $about ? ($about->summary === '' ? old('summary') : $about->summary) : '' }}</textarea>
                                                    @if ($errors->has('summary'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('summary') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.button_text') }}</label>
                                                    <input class="form-control" id="button_text" name="button_text"
                                                        type="text"
                                                        value="{{ $about ? ($about->button_text === '' ? __('admin/common.read_more') : $about->button_text) : __('admin/common.read_more') }}"
                                                        onchange="loadDocument(event, 'preview_button_text')">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.button_url') }}</label>
                                                    <input class="form-control" id="button_url" name="button_url"
                                                        type="url"
                                                        value="{{ $about ? ($about->button_url === '' ? '#' : $about->button_url) : '#' }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/about/about-index.image') }}</label>
                                                    <input class="form-control" id="image" name="image"
                                                        type="file" onchange="loadFile(event, 'preview_image')">
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
                                                        <option {!! $about ? ($about->status == 1 ? 'selected' : '') : 'selected' !!} value="1">
                                                            {{ __('admin/common.display') }}</option>
                                                        <option {!! $about ? ($about->status == 0 ? 'selected' : '') : '' !!} value="0">
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
                                                <section id="about" class="about">
                                                    <div class="container mt-5" data-aos="fade-up">
                                                        <div class="row">
                                                            <div class="col-lg-6 d-flex flex-column justify-content-center"
                                                                data-aos="fade-up" data-aos-delay="200">
                                                                <div class="content">
                                                                    <h3 id="preview_question">
                                                                        {{ $about ? ($about->question === '' ? __('admin/about/about-index.question-placeholder') : $about->question) : __('admin/about/about-index.question-placeholder') }}
                                                                    </h3>
                                                                    <h2 id="preview_title">{!! $about
                                                                        ? ($about->title === ''
                                                                            ? __('admin/about/about-index.title_placeholder')
                                                                            : $about->title)
                                                                        : __('admin/about/about-index.title_placeholder') !!}</h2>
                                                                    <p id="preview_summary">{!! $about
                                                                        ? ($about->summary === ''
                                                                            ? __('admin/about/about-index.summary_placeholder')
                                                                            : $about->summary)
                                                                        : __('admin/about/about-index.summary_placeholder') !!}</p>
                                                                    <div class="text-center text-lg-start">
                                                                        <a href="{{ $about ? ($about->button_url === '' ? '#' : $about->button_url) : '#' }}"
                                                                            class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                                                            <span
                                                                                id="preview_button_text">{{ $about ? ($about->button_text === '' ? __('admin/common.read_more') : $about->button_text) : __('admin/common.read_more') }}</span>
                                                                            <i class="bi bi-arrow-right"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 d-flex align-items-center"
                                                                data-aos="zoom-out" data-aos-delay="200">
                                                                <img id="preview_image"
                                                                    src="{{ $about ? ($about->image === '' ? asset('frontend/assets/img/about.jpg') : asset($about->image)) : asset('frontend/assets/img/about.jpg') }}"
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
