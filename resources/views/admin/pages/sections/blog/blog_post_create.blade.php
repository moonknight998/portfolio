@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.blog_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/blog/blog.create_post')}}</a></li>
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
                            <h2>{{__('admin/blog/blog.create_post')}}</h2>
                        </div>
                        <form method="POST" action="{{route('admin.blog_post.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="example">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li class="nav-item" role="presentation"><a class="nav-link active"
                                        data-coreui-toggle="tab" role="tab" aria-selected="true" onclick="openTab(event, 'content_tab', 'preview_tab')">
                                          <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-media-play')}}"></use>
                                          </svg>{{__('admin/common.content')}}</a>
                                        </li>
                                    <li class="nav-item" role="presentation"><a class="nav-link"
                                        data-coreui-toggle="tab" role="tab" aria-selected="false" onclick="openTab(event, 'preview_tab', 'content_tab')">
                                            <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-code')}}"></use>
                                            </svg>{{__('admin/common.preview')}}</a>
                                        </li>
                                    </ul>
                                    <!--Edit Tab-->
                                    <div class="tab-content rounded-bottom" id="content_tab">
                                      <div class="tab-pane p-3 active preview" role="tabpanel" >
                                        @if (session('status') === 'created')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{__('admin/blog/blog.post_created')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_title')}}</label>
                                            <input class="form-control" name="post_title" type="text" placeholder="{{__('admin/blog/blog.post_title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_post_title)"></input>
                                            @if ($errors->has('post_title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/sidebar.thumbnail')}}</label>
                                            <input class="form-control" name="thumbnail" type="file" onchange="loadFile(event, 'preview_thumbnail')">
                                            @if ($errors->has('thumbnail'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('thumbnail')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_content')}}</label>
                                            <textarea class="form-control" rows="5" id="summernote-full" name="post_content" type="text"
                                            onchange="loadDocument(event, 'preview_post_content')"
                                            onkeypress="detectEnterline(event, 'post_content'); loadDocument(event, 'preview_post_content')"></textarea>
                                            @if ($errors->has('post_content'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_content')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.categories')}}</label>
                                            <select class="form-select" name="blog_category">
                                                @foreach ($blog_categories as $blog_category)
                                                    <option @selected($loop->index == 0) value="{{$blog_category->id}}">{{$blog_category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_author')}}</label>
                                            <input class="form-control" name="post_author" type="text" placeholder="{{__('admin/blog/blog.post_author_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_post_author)"></input>
                                            @if ($errors->has('post_author'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_author')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option selected value="1">{{__('admin/common.display')}}</option>
                                                <option value="0">{{__('admin/common.hide')}}</option>
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
                                                {{__('admin/common.about_mobile_warning')}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--End Preview Tab-->
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <button class="btn btn-primary mb-3" type="submit">{{__('admin/common.create_new')}}</button>
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
