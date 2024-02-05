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
            <li class="breadcrumb-item active"><a>{{__('admin/pricing/pricing.edit_item')}}</a></li>
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
                            <h2>{{__('admin/pricing/pricing.edit_item')}}</h2>
                        </div>
                        <form method="POST" action="{{route('admin.pricing_item.update', $pricing_item->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
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
                                            {{__('admin/pricing/pricing.item_updated')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/pricing/pricing.pricing_name')}}</label>
                                            <input class="form-control" id="pricing_name" required name="pricing_name" type="text" placeholder="{{__('admin/pricing/pricing.pricing_name')}}"
                                            value="{{$pricing_item->pricing_name}}"
                                            onchange="loadDocument(event, 'preview_pricing_name')">
                                            @if ($errors->has('pricing_name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('pricing_name')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.color')}}</label>
                                            <input class="form-control form-control-color" id="color" name="color" type="color" value="{{$pricing_item->color}}" onchange="changeColor(event, 'preview_pricing_name')">
                                            @if ($errors->has('color'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('color')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/pricing/pricing.price_per_month')}}</label>
                                            <input class="form-control" id="price_per_month" required name="price_per_month" type="text" placeholder="{{__('admin/pricing/pricing.price_per_month')}}"
                                            value="{{$pricing_item->price_per_month}}"
                                            onchange="loadDocument(event, 'preview_price_per_month')">
                                            @if ($errors->has('price_per_month'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('price_per_month')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.currency')}}</label>
                                            <select class="form-select" id="currency" name="currency" onchange="loadDocument(event, 'preview_currency')">
                                                <option {{$pricing_item->currency === 'VND' ? 'selected' : ''}} value="VND">VND</option>
                                                <option {{$pricing_item->currency === 'USD' ? 'selected' : ''}} value="USD">USD</option>
                                                <option {{$pricing_item->currency === 'EUR' ? 'selected' : ''}} value="EUR">EUR</option>
                                            </select>
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
                                            <label class="form-label">{{__('admin/pricing/pricing.benefit')}}</label>
                                            <textarea class="form-control" rows="5" id="benefit" name="benefit" type="text" placeholder="{{__('admin/pricing/pricing.benefit')}}"
                                            onchange="loadDocument(event, 'preview_benefit')"
                                            onkeypress="detectEnterline(event, 'benefit'); loadDocument(event, 'preview_benefit')">{{$pricing_item->benefit}}</textarea>
                                            @if ($errors->has('benefit'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('benefit')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.button_name')}}</label>
                                            <input class="form-control" id="button_name" required name="button_name" type="text" placeholder="{{__('admin/common.buy_now')}}" value="{{__('admin/common.buy_now')}}"
                                            value="{{$pricing_item->button_name}}"
                                            onchange="loadDocument(event, 'preview_button_name')">
                                            @if ($errors->has('button_name'))
                                            <div class="row mb-0">
                                                <div class="invalid-feedback" style="display: inline;">{{$errors->first('button_name')}}</div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.button_url')}}</label>
                                            <input class="form-control" id="button_url" required name="button_url" type="url" placeholder="https://www.google.com/" value="{{$pricing_item->button_url}}">
                                            @if ($errors->has('button_url'))
                                            <div class="row mb-0">
                                                <div class="invalid-feedback" style="display: inline;">{{$errors->first('button_url')}}</div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.is_featured')}}</label>
                                            <select class="form-select" id="is_featured" name="is_featured" onchange="changeStatusOne(event, 'is_featured', 'preview_is_featured')">
                                                <option {{$pricing_item->is_featured == 1 ? 'selected' : ''}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$pricing_item->is_featured == 0 ? 'selected' : ''}} value="0">{{__('admin/common.hide')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$pricing_item->is_featured == 1 ? 'selected' : ''}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$pricing_item->is_featured == 0 ? 'selected' : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                                        @foreach ($pricing_items as $pricing_item_local)
                                                            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100" style="display: flex">
                                                                <div class="box">
                                                                    <span id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_is_featured' : ''}}" class="featured" style="display: {{$pricing_item_local->is_featured ? 'block' : 'none'}}">{{__('admin/common.featured')}}</span>
                                                                    <h3 id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_pricing_name' : ''}}" style="color: {{$pricing_item_local->color}};">{{$pricing_item_local->pricing_name}}</h3>
                                                                    <div class="price">
                                                                        <span id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_price_per_month' : ''}}" style="font-size: 1.5rem; color:rgb(65, 65, 65); font-weight:bold;">{{$pricing_item_local->price_per_month}}</span>
                                                                        <sup id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_currency' : ''}}"> {{$pricing_item_local->currency}}</sup>
                                                                        <span> / {{__('admin/common.month')}}</span>
                                                                    </div>
                                                                    <img id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_image' : ''}}" src="{{isset($pricing_item_local->image) ? $pricing_item_local->image : asset('frontend/assets/img/pricing-free.png')}}" class="img-fluid" alt="">
                                                                    <ul><p id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_benefit' : ''}}" style="line-height: 3rem;margin: 0px 20px 10px 20px;font-size: 18px;">{!!$pricing_item_local->benefit!!}</p></ul>
                                                                    <a id="{{$pricing_item_local->id == $pricing_item->id ? 'preview_button_name' : ''}}" href="#" class="btn-buy">{{__('admin/common.buy_now')}}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
