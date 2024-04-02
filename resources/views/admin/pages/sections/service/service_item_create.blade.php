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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.service_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/service/service.create_item') }}</a></li>
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
                                <h2>{{ __('admin/service/service.create_item') }}</h2>
                            </div>
                            <form method="POST" action="{{ route('admin.service_item.store') }}"
                                enctype="multipart/form-data">
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
                                                        {{ __('admin/service/service.item_created') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/count/count.title') }}</label>
                                                    <input class="form-control" id="title" required name="title"
                                                        type="text"
                                                        placeholder="{{ __('admin/feature/feature.title_placeholder') }}"
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
                                                        class="form-label">{{ __('admin/feature/feature.description') }}</label>
                                                    <textarea class="form-control" rows="1" id="description" name="description" type="text"
                                                        placeholder="{{ __('admin/feature/feature.description_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_item_description')"
                                                        onkeypress="detectEnterline(event, 'description'); loadDocument(event, 'preview_item_description')"></textarea>
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
                                                        onchange="changeClassWithExtraParam(event, 'preview_icon', 'icon-backend')">
                                                    @if ($errors->has('icon'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('icon') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.button_text') }}</label>
                                                    <input class="form-control" id="button_text" required name="button_text"
                                                        type="text" placeholder="{{ __('admin/common.read_more') }}"
                                                        value="{{ __('admin/common.read_more') }}"
                                                        onchange="loadDocument(event, 'preview_button_text')">
                                                    @if ($errors->has('button_text'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('button_text') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.button_url') }}</label>
                                                    <input class="form-control" id="button_url" required
                                                        name="button_url" type="url"
                                                        placeholder="https://www.google.com/"
                                                        value="https://www.google.com/">
                                                    @if ($errors->has('button_url'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('button_url') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.main_color') }}</label>
                                                    <input class="form-control form-control-color" id="main_color"
                                                        name="main_color" type="color" value="#00eeff"
                                                        onchange="changeColor(event, 'preview_icon'); changeColor(event, 'preview_button'); changeStyle(event, 'preview_border_bottom', 'borderBottomColor')">
                                                    @if ($errors->has('main_color'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('main_color') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.extra_color') }}</label>
                                                    <input class="form-control form-control-color" id="extra_color"
                                                        name="extra_color" type="color" value="#c8fbfe"
                                                        onchange="changeBackground(event, 'preview_icon')">
                                                    @if ($errors->has('extra_color'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('extra_color') }}</div>
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
                                                <section id="services" class="services">
                                                    <div class="container aos-init aos-animate" data-aos="fade-up">
                                                        <header class="section-header">
                                                            <h2>{{ $service_title ? $service_title->section_name : __('admin/feature/feature.section_name_placeholder') }}
                                                            </h2>
                                                            <p>{{ $service_title ? $service_title->title : __('admin/feature/feature.title_placeholder') }}
                                                            </p>
                                                        </header>
                                                        <div class="row gy-4" style="justify-content: center">
                                                            @if (count($service_items) > 0)
                                                                @foreach ($service_items as $service_item)
                                                                    <div class="col-lg-4 col-md-6 aos-init aos-animate"
                                                                        data-aos="fade-up" data-aos-delay="200">
                                                                        <div id="border{{ $loop->index }}"
                                                                            class="service-box"
                                                                            style="border-bottom-style: solid;  border-bottom-width: 3px; border-bottom-color: {{ $service_item->main_color }};"
                                                                            onmouseover="changeBackgroundToWhite(event, 'icon{{ $loop->index }}'); changeBackgroundByColorCode(event, 'border{{ $loop->index }}', '{{ $service_item->main_color }}'); changeColorWithColorName(event, 'url{{ $loop->index }}', 'white')"
                                                                            onmouseout="changeBackgroundByColorCode(event, 'icon{{ $loop->index }}', '{{ $service_item->extra_color }}'); changeBackgroundToWhite(event, 'border{{ $loop->index }}'); changeColorWithColorName(event, 'url{{ $loop->index }}', '{{ $service_item->main_color }}')">
                                                                            <i id="icon{{ $loop->index }}"
                                                                                class="{{ $service_item->icon }} icon-backend"
                                                                                style="color: {{ $service_item->main_color }}; background: {{ $service_item->extra_color }}; padding: 20px 20px;"></i>
                                                                            <h3>{{ $service_item->title }}</h3>
                                                                            <p>{{ $service_item->description }}</p>
                                                                            <a id="url{{ $loop->index }}"
                                                                                href="{{ $service_item->button_url }}"
                                                                                target="_blank" class="read-more"
                                                                                style="color: {{ $service_item->main_color }};"><span>{{ $service_item->button_text }}</span><i
                                                                                    class="bi bi-arrow-right"></i></a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="col-lg-4 col-md-6 aos-init aos-animate"
                                                                data-aos="fade-up" data-aos-delay="200">
                                                                <div id="preview_border_bottom"
                                                                    onmouseover="changeBackgroundByInput(event, 'preview_border_bottom', 'main_color'); changeBackgroundToWhite(event, 'preview_icon'); changeColorWithColorName(event, 'preview_button', 'white')"
                                                                    onmouseout="changeBackgroundToWhite(event, 'preview_border_bottom'); changeBackgroundByInput(event, 'preview_icon', 'extra_color'); changeColorByInput(event, 'preview_button', 'main_color')"
                                                                    class="service-box"
                                                                    style="border-bottom-style: solid;  border-bottom-width: 3px; border-bottom-color: #00eeff;">
                                                                    <i id="preview_icon"
                                                                        class="bi bi-check-square icon-backend"
                                                                        style="color: #00eeff; background: #c8fbfe; padding: 20px 20px;"></i>
                                                                    <h3 id="preview_title">Nesciunt Mete</h3>
                                                                    <p id="preview_item_description">Provident nihil minus
                                                                        qui consequatur non omnis maiores. Eos accusantium
                                                                        minus dolores iure perferendis tempore et
                                                                        consequatur.</p>
                                                                    <a id="preview_button" href="#"
                                                                        class="read-more" style="color: #00eeff;"><span
                                                                            id="preview_button_text">{{ __('admin/common.read_more') }}</span><i
                                                                            class="bi bi-arrow-right"></i></a>
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
