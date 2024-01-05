@extends('admin.layouts.layout')

@section('content')

<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.feature_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/common.main_title')}}</a></li>
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
                        <div class="card-header"><h2>{{__('admin/value/value-index.edit')}}</h2></div>
                        <form method="POST" action="{{$feature_title == null ? route('admin.feature_title.store') : route('admin.feature_title.update', $feature_title->id)}}" enctype="multipart/form-data">
                            @csrf
                            @if ($feature_title)
                            @method('PATCH')
                            @endif
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
                                        @if (session('status') === 'updated')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{__('admin/feature/feature.updated')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/feature/feature.section_name')}}</label>
                                            <input class="form-control" id="section_name" name="section_name" type="text" placeholder="{{__('admin/feature/feature.section_name_placeholder')}}"
                                            value="{{$feature_title ? ($feature_title->section_name === '' ? old('section_name') : $feature_title->section_name) : ''}}"
                                            onchange="loadDocument(event, 'preview_section_name')">
                                            @if ($errors->has('section_name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('section_name')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/feature/feature.title')}}</label>
                                            <textarea class="form-control" rows="5" id="title" name="title" type="text" placeholder="{{__('admin/feature/feature.title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_title')"
                                            onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')"
                                            >{{$feature_title ? ($feature_title->title === '' ? old('title') : $feature_title->title) : ''}}</textarea>
                                            @if ($errors->has('title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/about/about-index.image')}}</label>
                                            <input class="form-control" id="image" name="image" type="file" onchange="loadFile(event, 'preview_image')">
                                            @if ($errors->has('image'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('image')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$feature_title ? ($feature_title->status == 1 ? 'selected' : '') : 'selected'}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$feature_title ? ($feature_title->status == 0 ? 'selected' : '') : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                                {{__('admin/common.about_mobile_warning')}}
                                            </div>
                                            @endif
                                            <section id="features" class="features">
                                                <div class="container-fluid aos-init aos-animate" data-aos="fade-up">
                                                    @if ($feature_title && $feature_title->status == 1)
                                                        <header class="section-header" style="display: block;">
                                                            <h2 id="preview_section_name">{{$feature_title->section_name ? $feature_title->section_name : __('admin/feature/feature.section_name_placeholder')}}</h2>
                                                            <p id="preview_title">{{$feature_title->title ? $feature_title->title : __('admin/feature/feature.title_placeholder')}}</p>
                                                        </header>
                                                    @else <!--If feature_title not exist-->
                                                        <header class="section-header" style="display: block;">
                                                            <h2 id="preview_section_name">{{ __('admin/feature/feature.section_name_placeholder')}}</h2>
                                                            <p id="preview_title">{{__('admin/feature/feature.title_placeholder')}}</p>
                                                        </header>   
                                                    @endif
                                                    <div class="row">
                                                        @if ($feature_title && $feature_title->status == 1)
                                                            <div class="col-lg-6" style="display: flex; justify-content: center; align-content: center;">
                                                                <img id="preview_image" src="{{$feature_title->image ? asset($feature_title->image) : asset('/frontend/assets/img/features.png')}}" class="img-fluid" alt="">
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6" style="display: flex; justify-content: center; align-content: center;">
                                                                <img id="preview_image" src="{{asset('/frontend/assets/img/features.png')}}" class="img-fluid" alt="">
                                                            </div>
                                                        @endif
                                                        @if (count($feature_lists) > 0)
                                                            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                                                                <div class="row-md-6 align-self-center gy-4" style="width: 100%">
                                                                    @foreach ($feature_lists as $feature_list_item)
                                                                        @if ($feature_list_item->status == 1)
                                                                            <div class="col-md-6 aos-init aos-animate py-1" data-aos="zoom-out" data-aos-delay="200" style="width: 100%">
                                                                                <div class="feature-box d-flex align-items-center" style="width: 100%">
                                                                                    <i class="{{$feature_list_item->icon}}"></i>
                                                                                    <h3>{{$feature_list_item->title}}</h3>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                                                                <div class="row-md-6 align-self-center gy-4" style="width: 100%">
                                                                    <div class="col-md-6 aos-init aos-animate py-1" data-aos="zoom-out" data-aos-delay="200" style="width: 100%">
                                                                        <div class="feature-box d-flex align-items-center" style="width: 100%">
                                                                            <i class="bi bi-check"></i>
                                                                            <h3>{{__('admin/feature/feature.title_placeholder')}}</h3>
                                                                        </div>
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
                                        <button class="btn btn-primary mb-3" type="submit">{{__('admin/common.update')}}</button>
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
