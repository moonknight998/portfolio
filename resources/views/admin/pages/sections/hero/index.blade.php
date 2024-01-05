@extends('admin.layouts.layout')

@section('content')

<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/sidebar.hero-section')}}</a></li>
          </ol>
        </nav>
      </div>
</header>
<!--End Breadcrumb-->

<!--Main Part-->
<div class="body flex-grow-1 px-1">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header"><h2>{{__('admin/hero/hero-index.edit')}}</h2></div>
                        <form method="POST" action="{{route('admin.hero.update', 1)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="padding-top: 10pt">
                                @if (session('status') === 'updated')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{__('admin/hero/hero-index.updated')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.slogan')}}</label>
                                    <input class="form-control" id="slogan" name="slogan" type="text" placeholder="{{__('admin/hero/hero-index.slogan-placeholder')}}" value="{{$hero->slogan === '' ? old('slogan') : $hero->slogan}}">
                                    @if ($errors->has('slogan'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('slogan')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.short-description')}}</label>
                                    <textarea class="form-control" rows="5" id="short_description" name="short_description" type="text" placeholder="{{__('admin/hero/hero-index.short-description-placeholder')}}">{{$hero->short_description === '' ? old('slogan') : $hero->short_description}}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('short_description')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.button-text')}}</label>
                                    <input class="form-control" id="button_text" name="button_text" type="text" value="{{$hero->button_text === '' ? __('admin/hero/hero-index.find-out-now') : $hero->button_text}}">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.button-url')}}</label>
                                    <input class="form-control" id="button_url" name="button_url" type="url" readonly="" value="about" style="background-color: yellow">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.image')}}</label>
                                    <input class="form-control" id="image" name="image" type="file">
                                    @if ($errors->has('image'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('image')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($hero->image)
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="form-label">{{__('admin/hero/hero-index.preview')}}</label>
                                        <img class="w-25" src="{{asset($hero->image)}}"></img>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="form-label">{{__('admin/hero/hero-index.status')}}</label>
                                        <select class="form-select mx-2" id="status" name="status">
                                            <option {!!$hero->status == 1 ? 'selected' : ''!!} value="1">{{__('admin/hero/hero-index.display')}}</option>
                                            <option {!!$hero->status == 0 ? 'selected' : ''!!} value="0">{{__('admin/hero/hero-index.hide')}}</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <button class="btn btn-primary mb-3" type="submit">{{__('admin/hero/hero-index.update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header"><h2>{{__('admin/hero/hero-index.edit')}}</h2></div>
                        <form method="POST" action="{{$hero ? route('admin.hero.update', $hero->id) : route('admin.hero.store')}}" enctype="multipart/form-data">
                            @csrf
                            @if ($hero)
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
                                            {{__('admin/hero/hero-index.updated')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/hero/hero-index.slogan')}}</label>
                                            <input class="form-control" id="slogan" name="slogan" type="text" placeholder="{{__('admin/hero/hero-index.slogan-placeholder')}}"
                                            value="{{$hero ? ($hero->slogan === '' ? old('slogan') : $hero->slogan): ''}}"
                                            onchange="loadDocument(event, 'preview_slogan')">
                                            @if ($errors->has('slogan'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('slogan')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/hero/hero-index.short-description')}}</label>
                                            <textarea class="form-control" rows="3" id="short_description" name="short_description" type="text" placeholder="{{__('admin/hero/hero-index.short-description-placeholder')}}"
                                            onchange="loadDocument(event, 'preview_short_description')"
                                            onkeypress="detectEnterline(event, 'short_description'); loadDocument(event, 'preview_short_description')"
                                            >{{$hero ? ($hero->short_description === '' ? old('short_description') : $hero->short_description) : ''}}</textarea>
                                            @if ($errors->has('short_description'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('short_description')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.button_text')}}</label>
                                            <input class="form-control" id="button_text" name="button_text" type="text" placeholder="{{__('admin/common.get_started')}}"
                                            value="{{$hero ? ($hero->button_text === '' ? old('button_text') : $hero->button_text) : ''}}"
                                            onchange="loadDocument(event, 'preview_button_text')">
                                            @if ($errors->has('button_text'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('button_text')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/hero/hero-index.button-url')}}</label>
                                            <input class="form-control" id="button_url" readonly name="button_url" type="url" value="about" style="background-color: gray">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.image')}}</label>
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
                                                <option {!!$hero ? ($hero->status == 1 ? 'selected' : '') : 'selected'!!} value="1">{{__('admin/common.display')}}</option>
                                                <option {!!$hero ? ($hero->status == 0 ? 'selected' : '') : ''!!} value="0">{{__('admin/common.hide')}}</option>
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
                                            <section id="hero" class="hero d-flex align-items-center">
                                                <div class="container">
                                                  <div class="row">
                                                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                                                      <h1 data-aos="fade-up" id="preview_slogan">{{$hero ? ($hero->slogan === '' ? __('admin/hero/hero-index.slogan-placeholder') : $hero->slogan) : __('admin/hero/hero-index.slogan-placeholder')}}</h1>
                                                      <h2 data-aos="fade-up" data-aos-delay="400" id="preview_short_description">{!!$hero ? ($hero->short_description === '' ? __('admin/hero/hero-index.short-description-placeholder') : $hero->short_description) : __('admin/hero/hero-index.short-description-placeholder')!!}</h2>
                                                      <div data-aos="fade-up" data-aos-delay="600">
                                                        <div class="text-center text-lg-start">
                                                            <a href="#{{$hero ? ($hero->button_url === '' ? 'about' : $hero->button_url) : 'about'}}"
                                                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                                                 <span id="preview_button_text">{{$hero ? ($hero->button_text === '' ? __('admin/common.get_started') : $hero->button_text) : __('admin/common.get_started')}}</span>
                                                                 <i class="bi bi-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                                                      <img id="preview_image" src="{{$hero ? ($hero->image === '' ? asset('frontend/assets/img/hero-img.png') : $hero->image) : asset('frontend/assets/img/hero-img.png')}}" class="img-fluid" alt="">
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
