@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.pricing_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/pricing/pricing.title')}}</a></li>
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
                        <div class="card-header"><h2>{{__('admin/pricing/pricing.update_title')}}</h2></div>
                        <form method="POST" action="{{$pricing_title == null ? route('admin.pricing_title.store') : route('admin.pricing_title.update', $pricing_title->id)}}" enctype="multipart/form-data">
                            @csrf
                            @if ($pricing_title)
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
                                                {{__('admin/pricing/pricing.title_updated')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('status') === 'required')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{__('admin/pricing/pricing.title_required')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/pricing/pricing.section_name')}}</label>
                                            <input class="form-control" id="section_name" name="section_name" type="text" placeholder="{{__('admin/common.section_name_placeholder')}}"
                                            value="{{$pricing_title ? ($pricing_title->section_name === '' ? old('section_name') : $pricing_title->section_name) : ''}}"
                                            onchange="loadDocument(event, 'preview_section_name')">
                                            @if ($errors->has('section_name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('section_name')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/feature/feature.title')}}</label>
                                            <textarea class="form-control" rows="5" id="title" name="title" type="text" placeholder="{{__('admin/common.title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_title')"
                                            onkeypress="detectEnterline(event, 'title'); loadDocument(event, 'preview_title')"
                                            >{{$pricing_title ? ($pricing_title->title === '' ? old('title') : $pricing_title->title) : ''}}</textarea>
                                            @if ($errors->has('title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$pricing_title ? ($pricing_title->status == 1 ? 'selected' : '') : 'selected'}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$pricing_title ? ($pricing_title->status == 0 ? 'selected' : '') : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                            <section id="pricing" class="pricing">
                                                <div class="container" data-aos="fade-up">
                                                    <header class="section-header">
                                                        <h2 id="preview_section_name">{{$pricing_title ? $pricing_title->section_name : __('admin/common.section_name_preview')}}</h2>
                                                        <p id="preview_title">{{$pricing_title ? $pricing_title->title : __('admin/common.title_preview')}}</p>
                                                    </header>
                                                    <div class="row gy-4" data-aos="fade-left" style="justify-content: center">
                                                        @if (count($pricing_items) > 0)
                                                            @foreach ($pricing_items as $pricing_item_local)
                                                                @if ($pricing_item_local->status == 1)
                                                                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100" style="display: flex">
                                                                        <div class="box">
                                                                            <span class="featured" style="display: {{$pricing_item_local->is_featured ? 'block' : 'none'}}">{{__('admin/common.featured')}}</span>
                                                                            <h3 style="color: {{$pricing_item_local->color}};">{{$pricing_item_local->pricing_name}}</h3>
                                                                            <div class="price">
                                                                                <span style="font-size: 1.5rem; color:rgb(65, 65, 65); font-weight:bold;">{{$pricing_item_local->price_per_month}}</span>
                                                                                <sup> {{$pricing_item_local->currency}}</sup>
                                                                                <span> / {{__('admin/common.month')}}</span>
                                                                            </div>
                                                                            <img src="{{isset($pricing_item_local->image) ? $pricing_item_local->image : asset('frontend/assets/img/pricing-free.png')}}" class="img-fluid" alt="">
                                                                            <ul><p style="line-height: 3rem;margin: 0px 20px 10px 20px;font-size: 18px;">{!!$pricing_item_local->benefit!!}</p></ul>
                                                                            <a href="#" class="btn-buy">{{__('admin/common.buy_now')}}</a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                        <div class="row gy-4" data-aos="fade-left" style="justify-content: center">
                                                            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100" style="display: flex">
                                                                <div class="box">
                                                                    <h3 style="color: #07d5c0;">{{__('admin/pricing/pricing.pricing_name')}}</h3>
                                                                    <div class="price">
                                                                        <span style="font-size: 1.5rem; color:rgb(65, 65, 65); font-weight:bold;">0</span>
                                                                        <sup>USD</sup>
                                                                        <span> / {{__('admin/common.month')}}</span>
                                                                    </div>
                                                                    <img src="{{asset('frontend/assets/img/pricing-free.png')}}" class="img-fluid" alt="">
                                                                    <ul>
                                                                        <li>{{__('admin/pricing/pricing.benefit')}} 1</li>
                                                                        <li>{{__('admin/pricing/pricing.benefit')}} 2</li>
                                                                        <li>{{__('admin/pricing/pricing.benefit')}} 3</li>
                                                                        <li>{{__('admin/pricing/pricing.benefit')}} 4</li>
                                                                        <li>{{__('admin/pricing/pricing.benefit')}} 5</li>
                                                                    </ul>
                                                                    <a href="#" class="btn-buy">{{__('admin/common.buy_now')}}</a>
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
