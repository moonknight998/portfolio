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
            <li class="breadcrumb-item active"><a>{{__('admin/feature/feature.feature_tab_title')}}</a></li>
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
                        <div class="card-header"><h2>{{__('admin/feature/feature.update_feature_tab_title')}}</h2></div>
                        <form method="POST" action="{{$feature_tab_title == null ? route('admin.feature_tab_title.store') : route('admin.feature_tab_title.update', $feature_tab_title->id)}}" enctype="multipart/form-data">
                            @csrf
                            @if ($feature_tab_title)
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
                                            {{__('admin/feature/feature.tab_title_updated')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        @if (session('status') === 'required')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{__('admin/feature/feature.feature_tab_title_required')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/feature/feature.title')}}</label>
                                            <textarea class="form-control" rows="1" id="title" name="title" type="text" placeholder="{{__('admin/feature/feature.title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_title')"
                                            onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')"
                                            >{{$feature_tab_title ? ($feature_tab_title->title === '' ? old('title') : $feature_tab_title->title) : ''}}</textarea>
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
                                            <label class="form-label">{{__('admin/feature/feature.tab_quantity')}}</label>
                                            <input class="form-control" id="tab_quantity" name="tab_quantity" type="number" readonly value="3" style="background-color: rgba(187, 187, 187, 0.4)">
                                            @if ($errors->has('tab_quantity'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('tab_quantity')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$feature_tab_title ? ($feature_tab_title->status == 1 ? 'selected' : '') : 'selected'}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$feature_tab_title ? ($feature_tab_title->status == 0 ? 'selected' : '') : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                                    <div class="row feture-tabs" data-aos="fade-up">
                                                        <div class="col-lg-6">
                                                        <h3 id="preview_title">{{$feature_tab_title ? ($feature_tab_title->title === '' ? __('admin/feature/feature.title_placeholder') : $feature_tab_title->title) : __('admin/feature/feature.title_placeholder')}}</h3>
                                                            <ul class="nav mb-3">
                                                                <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Preview tab 1</a></li>
                                                                <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Preview tab 2</a></li>
                                                                <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">Preview tab 3</a></li>
                                                            </ul>
                                                            <div class="tab-content custom">
                                                                <div class="tab-pane fade show active" id="tab1">
                                                                    <p>Preview tab 1 paragraph 1</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 1</h4>
                                                                    </div>
                                                                    <p>Preview tab 1 paragraph 2</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 2</h4>
                                                                    </div>
                                                                    <p>Preview tab 1 paragraph 3</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="tab2">
                                                                    <p>Preview tab 2 paragraph 1</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 1</h4>
                                                                    </div>
                                                                    <p>Preview tab 2 paragraph 2</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 2</h4>
                                                                    </div>
                                                                    <p>Preview tab 2 paragraph 3</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="tab3">
                                                                    <p>Preview tab 3 paragraph 1</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 1</h4>
                                                                    </div>
                                                                    <p>Preview tab 3 paragraph 2</p>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-check2"></i>
                                                                        <h4>Preview tab 1 tick 2</h4>
                                                                    </div>
                                                                    <p>Preview tab 3 paragraph 3</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <img src="{{asset('frontend/assets/img/features-2.png')}}" class="img-fluid" alt="">
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
