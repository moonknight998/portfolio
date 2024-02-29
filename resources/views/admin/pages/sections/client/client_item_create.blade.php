@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.client_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/client/client.create_item')}}</a></li>
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
                            <h2>{{__('admin/client/client.create_item')}}</h2>
                        </div>
                        <form method="POST" action="{{route('admin.client_item.store')}}" enctype="multipart/form-data">
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
                                            {{__('admin/client/client.item_created')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/client/client.brand_name')}}</label>
                                            <input class="form-control" id="brand_name" name="brand_name" type="text" placeholder="{{__('admin/client/client.brand_name_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_brand_name')"></input>
                                            @if ($errors->has('brand_name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('brand_name')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.logo')}}</label>
                                            <input class="form-control" id="logo" name="logo" type="file" onchange="loadFile(event, 'preview_logo')">
                                            @if ($errors->has('logo'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('logo')}}</div>
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
                                            <section id="clients" class="clients">
                                                <div class="container" data-aos="fade-up">
                                                    <header class="section-header">
                                                        <h2>{{ShowTextData($client_title, 'section_name', __('admin/common.section_name_preview'))}}</h2>
                                                        <p>{{ShowTextData($client_title, 'title', __('admin/common.title_preview'))}}</p>
                                                    </header>
                                                    <div class="clients-slider swiper">
                                                        <div class="{{count($client_items) > (MobileDetect()->isMobile() ? 0 : 4) ? "swiper-wrapper align-items-center" : "container-fluid little-item"}}">
                                                            @if (count($client_items) > 0)
                                                                @foreach ($client_items as $client_item_local)
                                                                <div class="{{count($client_items) > (MobileDetect()->isMobile() ? 0 : 4) ? "swiper-slide" : "image-container"}}"><img src="{{$client_item_local->logo}}" class="img-fluid" alt="{{$client_item_local->brand_name}}"></div>
                                                                @endforeach
                                                            @endif
                                                            <div class="{{count($client_items) > (MobileDetect()->isMobile() ? 0 : 4) ? "swiper-slide" : "image-container"}}"><img id="preview_logo" src="{{asset('frontend/assets/img/clients/preview-text-logo.png')}}" class="img-fluid" alt=""></div>
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>
                                                </div>
                                            </section>
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
