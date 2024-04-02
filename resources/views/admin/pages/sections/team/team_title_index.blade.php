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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.team_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/team/team.title') }}</a></li>
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
                                <h2>{{ __('admin/team/team.update_title') }}</h2>
                            </div>
                            <form method="POST"
                                action="{{ $team_title == null ? route('admin.team_title.store') : route('admin.team_title.update', $team_title->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($team_title)
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
                                                        {{ __('admin/team/team.title_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('status') === 'required')
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/team/team.title_required') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/team/team.section_name') }}</label>
                                                    <input class="form-control" id="section_name" name="section_name"
                                                        type="text"
                                                        placeholder="{{ __('admin/common.section_name_placeholder') }}"
                                                        value="{{ ShowFormValue($team_title, 'section_name') }}"
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
                                                        class="form-label">{{ __('admin/feature/feature.title') }}</label>
                                                    <textarea class="form-control" rows="5" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/common.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')">{{ ShowFormValue($team_title, 'title') }}</textarea>
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
                                                        <option
                                                            {{ $team_title ? ($team_title->status == 1 ? 'selected' : '') : 'selected' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option
                                                            {{ $team_title ? ($team_title->status == 0 ? 'selected' : '') : '' }}
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
                                                <section id="team" class="team">
                                                    <div class="container" data-aos="fade-up">
                                                        <header class="section-header">
                                                            <h2 id="preview_section_name">
                                                                {{ ShowTextData($team_title, 'section_name', __('admin/common.section_name_preview')) }}
                                                            </h2>
                                                            <p id="preview_title">
                                                                {{ ShowTextData($team_title, 'title', __('admin/common.title_preview')) }}
                                                            </p>
                                                        </header>
                                                        <div class="row gy-4" style="justify-content: center">
                                                            @if (count($team_items) > 0)
                                                                @foreach ($team_items as $team_item_local)
                                                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch"
                                                                        data-aos="fade-up" data-aos-delay="200">
                                                                        <div class="member">
                                                                            <div class="member-img">
                                                                                <img src="{{ $team_item_local->image === '' ? asset('frontend/assets/img/team/team-2.jpg') : $team_item_local->image }}"
                                                                                    class="img-fluid mem-img"
                                                                                    alt="">
                                                                                <div class="social">
                                                                                    <a href="{{ $team_item_local->facebook_url }}"
                                                                                        target="_blank"><i
                                                                                            class="bi bi-facebook"></i></a>
                                                                                    {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                                                                    <a href="{{ $team_item_local->instagram_url }}"
                                                                                        target="_blank"><i
                                                                                            class="bi bi-instagram"></i></a>
                                                                                    <a href="{{ $team_item_local->telegram_url }}"
                                                                                        target="_blank"><i
                                                                                            class="bi bi-telegram"></i></a>
                                                                                    {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="member-info">
                                                                                <h4>{{ $team_item_local->name }}</h4>
                                                                                <span>{{ $team_item_local->work_title }}</span>
                                                                                <p>{{ $team_item_local->description }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch"
                                                                    data-aos="fade-up" data-aos-delay="100">
                                                                    <div class="member">
                                                                        <div class="member-img">
                                                                            <img src="{{ asset('frontend/assets/img/team/team-1.jpg') }}"
                                                                                class="img-fluid mem-img" alt="">
                                                                            <div class="social">
                                                                                <a href=""><i
                                                                                        class="bi bi-facebook"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                                                                <a href=""><i
                                                                                        class="bi bi-instagram"></i></a>
                                                                                <a href=""><i
                                                                                        class="bi bi-telegram"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="member-info">
                                                                            <h4>{{ __('admin/common.name_preview') }}</h4>
                                                                            <span>{{ __('admin/team/team.work_title_preview') }}</span>
                                                                            <p>{{ __('admin/common.description_preview') }}
                                                                            </p>
                                                                        </div>
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
