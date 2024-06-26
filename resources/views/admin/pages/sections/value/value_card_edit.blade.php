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
                    <li class="breadcrumb-item active"><a>{{ __('admin/value/value-index.value_section') }}</a></li>
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
                                <h2>{{ __('admin/value/value-index.edit_card') }}</h2>
                            </div>
                            <form method="POST" action="{{ route('admin.value_card.update', $value_card->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/value/value-index.title') }}</label>
                                                    <input class="form-control" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/value/value-index.title_placeholder') }}"
                                                        value="{{ $value_card->title }}"
                                                        onchange="loadDocument(event, 'preview_title')">
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/value/value-index.description') }}</label>
                                                    <textarea class="form-control" rows="5" id="description" name="description" type="text"
                                                        placeholder="{{ __('admin/value/value-index.description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_description')"
                                                        onkeypress="detectEnterline(event, 'description'); loadDocument(event, 'preview_description')">{{ $value_card->description }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('description') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.image') }}</label>
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
                                                        <option {!! $value_card->status == 1 ? 'selected' : '' !!} value="1">
                                                            {{ __('admin/common.display') }}</option>
                                                        <option {!! $value_card->status == 0 ? 'selected' : '' !!} value="0">
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
                                                            <h2>{!! $value_title->section_name !!}</h2>
                                                            <p>{!! $value_title->title !!}</p>
                                                        </header>
                                                        <div class="row" style="justify-content: center">

                                                            @foreach ($value_cards as $value_card_item)
                                                                <div class="col-lg-4 mb-3" data-aos="fade-up"
                                                                    data-aos-delay="200">
                                                                    <div class="box">
                                                                        <img id="{{ $value_card_item->id == $value_card->id ? 'preview_image' : '' }}"
                                                                            src="{{ $value_card_item->image === '' ? asset('frontend/assets/img/values-1.png') : asset($value_card_item->image) }}"
                                                                            class="img-fluid" alt="">
                                                                        <h3
                                                                            id="{{ $value_card_item->id == $value_card->id ? 'preview_title' : '' }}">
                                                                            {!! $value_card_item->title !!}</h3>
                                                                        <p
                                                                            id="{{ $value_card_item->id == $value_card->id ? 'preview_description' : '' }}">
                                                                            {!! $value_card_item->description !!}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
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
