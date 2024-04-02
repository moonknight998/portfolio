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
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.blog_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/client/client.title') }}</a></li>
                </ol>
            </nav>
        </div>
    </header>
    <!--End Breadcrumb-->

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
                            <form method="POST" class="was-validated" novalidate id="data-form"
                                action="{{ $blog_title == null ? route('admin.blog_title.store') : route('admin.blog_title.update', $blog_title->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($blog_title)
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
                                                        {{ __('admin/blog/blog.title_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('status') === 'required')
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        {{ __('admin/blog/blog.title_required') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/common.section_name_required') }}</label>
                                                    <input class="form-control" id="section_name" name="section_name"
                                                        type="text"
                                                        placeholder="{{ __('admin/common.section_name_placeholder') }}"
                                                        value="{{ ShowFormValue($blog_title, 'section_name') }}"
                                                        onchange="loadDocument(event, 'preview_section_name')" required>
                                                    @if ($errors->has('section_name'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('section_name') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/common.title_required') }}</label>
                                                    <textarea class="form-control" rows="5" id="title" name="title" type="text"
                                                        placeholder="{{ __('admin/common.title_placeholder') }}" onchange="loadDocument(event, 'preview_title')"
                                                        onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')" required>{{ ShowFormValue($blog_title, 'title') }}</textarea>
                                                    @if ($errors->has('title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/common.status_required') }}</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option
                                                            {{ $blog_title ? ($blog_title->status == 1 ? 'selected' : '') : 'selected' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option
                                                            {{ $blog_title ? ($blog_title->status == 0 ? 'selected' : '') : '' }}
                                                            value="0">{{ __('admin/common.hide') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Edit Tab-->

                                        <!--Preview Tab-->
                                        <div class="tab-content rounded-bottom" id="preview_tab" style="display: none">
                                            <div class="tab-pane active preview" role="tabpanel">
                                                @if (MobileDetect()->isMobile())
                                                    <div class="alert alert-warning fade show mt-4" role="alert">
                                                        {{ __('admin/common.about_mobile_warning') }}
                                                    </div>
                                                @endif
                                                <section class="recent-blog-posts" id="recent-blog-posts">
                                                    <div class="container" data-aos="fade-up">
                                                        <header class="section-header">
                                                            <h2 id="preview_section_name">
                                                                {{ ShowTextData($blog_title, 'section_name', __('admin/common.section_name_preview')) }}
                                                            </h2>
                                                            <p id="preview_title">
                                                                {{ ShowTextData($blog_title, 'title', __('admin/common.title_preview')) }}
                                                            </p>
                                                        </header>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="post-box">
                                                                    <div class="post-img"><img
                                                                            src="{{ asset('frontend/assets/img/blog/blog-1.jpg') }}"
                                                                            class="img-fluid" alt="Blog Image 1"></div>
                                                                    <span class="post-date">Tue, September 15</span>
                                                                    <h3 class="post-title">Eum ad dolor et. Autem aut
                                                                        fugiat debitis voluptatem consequuntur sit</h3>
                                                                    <a href="blog-single.html"
                                                                        class="readmore stretched-link mt-auto"><span>Read
                                                                            More</span><i
                                                                            class="bi bi-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="post-box">
                                                                    <div class="post-img"><img
                                                                            src="{{ asset('frontend/assets/img/blog/blog-2.jpg') }}"
                                                                            class="img-fluid" alt="Blog Image 2"></div>
                                                                    <span class="post-date">Fri, August 28</span>
                                                                    <h3 class="post-title">Et repellendus molestiae qui est
                                                                        sed omnis voluptates magnam</h3>
                                                                    <a href="blog-single.html"
                                                                        class="readmore stretched-link mt-auto"><span>Read
                                                                            More</span><i
                                                                            class="bi bi-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="post-box">
                                                                    <div class="post-img"><img
                                                                            src="{{ asset('frontend/assets/img/blog/blog-3.jpg') }}"
                                                                            class="img-fluid" alt="Blog Image 3"></div>
                                                                    <span class="post-date">Mon, July 11</span>
                                                                    <h3 class="post-title">Quia assumenda est et veritatis
                                                                        aut quae</h3>
                                                                    <a href="blog-single.html"
                                                                        class="readmore stretched-link mt-auto"><span>Read
                                                                            More</span><i
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
        @include('admin.notification.notification')
    </div>
    <!--End Main Part-->
@endsection
