@extends('admin.layouts.layout')

@section('content')
<style>
    .services .service-box.blue:hover {
     background: #fa2ddf;
    }
</style>
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.service_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/service/service.title')}}</a></li>
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
                        <div class="card-header"><h2>{{__('admin/service/service.update_title')}}</h2></div>
                        <form method="POST" action="{{$service_title == null ? route('admin.service_title.store') : route('admin.service_title.update', $service_title->id)}}" enctype="multipart/form-data">
                            @csrf
                            @if ($service_title)
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
                                                {{__('admin/service/service.title_updated')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('status') === 'required')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{__('admin/service/service.title_required')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/feature/feature.section_name')}}</label>
                                            <input class="form-control" id="section_name" name="section_name" type="text" placeholder="{{__('admin/feature/feature.section_name_placeholder')}}"
                                            value="{{$service_title ? ($service_title->section_name === '' ? old('section_name') : $service_title->section_name) : ''}}"
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
                                            >{{$service_title ? ($service_title->title === '' ? old('title') : $service_title->title) : ''}}</textarea>
                                            @if ($errors->has('title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$service_title ? ($service_title->status == 1 ? 'selected' : '') : 'selected'}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$service_title ? ($service_title->status == 0 ? 'selected' : '') : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                            <section id="services" class="services">
                                                <div class="container aos-init aos-animate" data-aos="fade-up">
                                                    <header class="section-header">
                                                        <h2 id="preview_section_name">{{$service_title ? $service_title->section_name : __('admin/feature/feature.section_name_placeholder')}}</h2>
                                                        <p id="preview_title">{{$service_title ? $service_title->title : __('admin/feature/feature.title_placeholder')}}</p>
                                                    </header>
                                                    <div class="row gy-4" style="justify-content: center">
                                                        @if (count($service_items) > 0)
                                                            @foreach ($service_items as $service_item)
                                                                @if ($service_item->status == 1)
                                                                <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                                                    <div
                                                                    id="border{{$loop->index}}"
                                                                    class="service-box"
                                                                    style="border-bottom-style: solid;  border-bottom-width: 3px; border-bottom-color: {{$service_item->main_color}};"
                                                                    onmouseover="changeBackgroundToWhite(event, 'icon{{$loop->index}}'); changeBackgroundByColorCode(event, 'border{{$loop->index}}', '{{$service_item->main_color}}'); changeColorWithColorName(event, 'url{{$loop->index}}', 'white')"
                                                                    onmouseout="changeBackgroundByColorCode(event, 'icon{{$loop->index}}', '{{$service_item->extra_color}}'); changeBackgroundToWhite(event, 'border{{$loop->index}}'); changeColorWithColorName(event, 'url{{$loop->index}}', '{{$service_item->main_color}}')">
                                                                        <i id="icon{{$loop->index}}" class="{{$service_item->icon}} icon-backend" style="color: {{$service_item->main_color}}; background: {{$service_item->extra_color}}; padding: 20px 20px;"></i>
                                                                        <h3>{{$service_item->title}}</h3>
                                                                        <p>{{$service_item->description}}</p>
                                                                        <a id="url{{$loop->index}}" href="{{$service_item->button_url}}" target="_blank" class="read-more" style="color: {{$service_item->main_color}};"><span>{{$service_item->button_text}}</span><i class="bi bi-arrow-right"></i></a>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                        <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                                            <div class="service-box" style="border-bottom-style: solid;  border-bottom-width: 3px; border-bottom-color: #2db6fa;">
                                                                <i class="ri-discuss-line icon-backend" style="color: #2db6fa; background: #dbf3fe"></i>
                                                                <h3>{{__('admin/common.title_preview')}}</h3>
                                                                <p>{!!__('admin/common.description_preview')!!}</p>
                                                                <a href="#" class="read-more"><span>{{__('admin/common.read_more')}}</span> <i class="bi bi-arrow-right"></i></a>
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
