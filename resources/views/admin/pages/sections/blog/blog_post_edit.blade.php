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
                    <li class="breadcrumb-item active"><a>{{ __('admin/blog/blog.edit_item') }}</a></li>
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
                                <h2>{{ __('admin/blog/blog.edit_item') }}</h2>
                            </div>
                            <form class="was-validated" novalidate method="POST"
                                action="{{ route('blog.blog_post.update', $blog_post->id) }}" enctype="multipart/form-data">
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
                                                        {{ __('admin/blog/blog.post_updated') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/blog/blog.post_title_required') }}</label>
                                                    <input class="form-control" name="post_title" type="text"
                                                        placeholder="{{ __('admin/blog/blog.post_title_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_post_title')"
                                                        value="{{ $blog_post->post_title }}" required minlength="3"
                                                        maxlength="500"></input>
                                                    @if ($errors->has('post_title'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('post_title') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ __('admin/common.thumbnail') }}</label>
                                                    <input class="form-control" id="file-upload" name="thumbnail"
                                                        type="file" onchange="loadFile(event, 'preview_thumbnail')"
                                                        accept="image/png, image/jpeg"
                                                        max-size-error="{{ __('admin/common.file-big-error') }}"
                                                        max-size="{{ GetMaxFileSizeUpload() }}"></input>
                                                    @if ($errors->has('thumbnail'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('thumbnail') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/blog/blog.post_content') }}</label>
                                                    <textarea class="form-control" rows="5" id="ckeditor5" name="post_content" type="text" required>{{ $blog_post->post_content }}</textarea>
                                                    @if ($errors->has('post_content'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('post_content') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/blog/blog.categories_required') }}</label>
                                                    <select class="form-select" name="category_id"
                                                        onchange="loadDocumentOption(event, 'preview_category')" required>
                                                        @foreach ($blog_categories as $blog_category)
                                                            <option
                                                                {{ $blog_post->category_id == $blog_category->id ? 'selected' : '' }}
                                                                value="{{ $blog_category->id }}">
                                                                {{ $blog_category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/blog/blog.post_author') }}</label>
                                                    <input class="form-control" name="post_author" type="text"
                                                        placeholder="{{ __('admin/blog/blog.post_author_placeholder') }}"
                                                        onchange="loadDocument(event, 'preview_post_author')"
                                                        value="{{ $blog_post->post_author }}" required minlength="3"
                                                        maxlength="100"></input>
                                                    @if ($errors->has('post_author'))
                                                        <div class="row mb-0">
                                                            <div class="invalid-feedback" style="display: inline;">
                                                                {{ $errors->first('post_author') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="form-label">{{ __('admin/common.status_required') }}</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option {{ $blog_post->status == 1 ? 'selected' : '' }}
                                                            value="1">{{ __('admin/common.display') }}</option>
                                                        <option {{ $blog_post->status == 0 ? 'selected' : '' }}
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
                                                <section id="blog" class="blog">
                                                    <div class="container" data-aos="fade-up">
                                                        <div class="row" style="margin-top: 50pt">
                                                            <div class="col-lg-8 entries">
                                                                <article class="entry entry-single">
                                                                    <div class="entry-img">
                                                                        <img class="post-thumbnail" id="preview_thumbnail"
                                                                            src="{{ $blog_post->thumbnail }}"
                                                                            alt="">
                                                                    </div>
                                                                    <h2 class="entry-title">
                                                                        <a
                                                                            id="preview_post_title">{{ $blog_post->post_title }}</a>
                                                                    </h2>
                                                                    <div class="entry-meta">
                                                                        <ul>
                                                                            <li class="d-flex align-items-center"><i
                                                                                    class="bi bi-person"></i> <a
                                                                                    id="preview_post_author">{{ $blog_post->post_author }}</a>
                                                                            </li>
                                                                            <li class="d-flex align-items-center"><i
                                                                                    class="bi bi-clock"></i>
                                                                                <a><time>{{ date('d-m-Y', strtotime($blog_post->created_at)) }}</time></a>
                                                                            </li>
                                                                            <li class="d-flex align-items-center"><i
                                                                                    class="bi bi-chat-dots"></i> <a
                                                                                    href="blog-single.html">12 Comments</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div id="preview_post_content" class="ck-content">
                                                                        {!! $blog_post->post_content !!}
                                                                    </div>
                                                                    <div class="entry-footer">
                                                                        <i class="bi bi-folder"></i>
                                                                        <ul class="cats">
                                                                            <li><a
                                                                                    id="preview_category">{{ $blog_post->category->category_name }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </article><!-- End blog entry -->
                                                                <div class="blog-author d-flex align-items-center">
                                                                    <img src="{{ asset('frontend/assets/img/blog/blog-author.jpg') }}"
                                                                        class="rounded-circle float-left" alt="">
                                                                    <div>
                                                                        <h4 id="preview_post_author">
                                                                            {{ $blog_post->post_author }}</h4>
                                                                        <div class="social-links">
                                                                            <a href="https://twitters.com/#"><i
                                                                                    class="bi bi-twitter"></i></a>
                                                                            <a href="https://facebook.com/#"><i
                                                                                    class="bi bi-facebook"></i></a>
                                                                            <a href="https://instagram.com/#"><i
                                                                                    class="biu bi-instagram"></i></a>
                                                                        </div>
                                                                        <p>
                                                                            {{ __('admin/common.description_preview') }}
                                                                        </p>
                                                                    </div>
                                                                </div><!-- End blog author bio -->
                                                            </div><!-- End blog entries list -->
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
    @include('admin.pages.sections.blog.blog_post_ckeditor5')
@endsection
