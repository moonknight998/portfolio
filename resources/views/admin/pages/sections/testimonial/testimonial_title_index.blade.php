@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.testimonial_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/testimonial/testimonial.title')}}</a></li>
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
                        <div class="card-header"><h2>{{__('admin/testimonial/testimonial.update_title')}}</h2></div>
                        <form method="POST" action="{{$testimonial_title == null ? route('admin.testimonial_title.store') : route('admin.testimonial_title.update', $testimonial_title->id)}}" enctype="multipart/form-data">
                            @csrf
                            @if ($testimonial_title)
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
                                                {{__('admin/faq/faq.title_updated')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('status') === 'required')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{__('admin/faq/faq.title_required')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/pricing/pricing.section_name')}}</label>
                                            <input class="form-control" id="section_name" name="section_name" type="text" placeholder="{{__('admin/common.section_name_placeholder')}}"
                                            value="{{$testimonial_title ? ($testimonial_title->section_name === '' ? old('section_name') : $testimonial_title->section_name) : ''}}"
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
                                            >{{$testimonial_title ? ($testimonial_title->title === '' ? old('title') : $testimonial_title->title) : ''}}</textarea>
                                            @if ($errors->has('title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$testimonial_title ? ($testimonial_title->status == 1 ? 'selected' : '') : 'selected'}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$testimonial_title ? ($testimonial_title->status == 0 ? 'selected' : '') : ''}} value="0">{{__('admin/common.hide')}}</option>
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
                                            <section id="testimonials" class="testimonials">
                                                <div class="container" data-aos="fade-up">
                                                    <header class="section-header">
                                                        <h2 id="preview_section_name">{{$testimonial_title && $testimonial_title->section_name !== '' ? $testimonial_title->section_name : __('admin/common.section_name_preview')}}</h2>
                                                        <p id="preview_title">{{$testimonial_title && $testimonial_title->title !== '' ? $testimonial_title->title : __('admin/common.title_preview')}}</p>
                                                    </header>
                                                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                                                        <div class="swiper-wrapper">
                                                            @if (count($testimonial_items) > 0)
                                                                @foreach ($testimonial_items as $testimonial_item_local)
                                                                    <div class="swiper-slide">
                                                                        <div class="testimonial-item">
                                                                        <div class="stars">
                                                                            @for ($star = 1; $star <= $testimonial_item_local->rated; $star++)
                                                                            <i class="bi bi-star-fill"></i>
                                                                            @endfor
                                                                        </div>
                                                                        <p>{{$testimonial_item_local->feedback}}</p>
                                                                        <div class="profile mt-auto">
                                                                            <img style="object-fit:cover; width:82px; height:82px;" src="{{$testimonial_item_local->image !== '' ? $testimonial_item_local->image : asset('frontend/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
                                                                            <h3>{{$testimonial_item_local->name}}</h3>
                                                                            <h4>{{$testimonial_item_local->career}}</h4>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="swiper-slide">
                                                                    <div class="testimonial-item">
                                                                    <div class="stars">
                                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                                    </div>
                                                                    <p id="preview_feedback">{{__('admin/testimonial/testimonial.feedback_preview')}}</p>
                                                                    <div class="profile mt-auto">
                                                                        <img id="preview_image" src="{{asset('frontend/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
                                                                        <h3 id="preview_name">{{__('admin/common.name_preview')}}</h3>
                                                                        <h4 id="preview_career">{{__('admin/testimonial/testimonial.career_preview')}}</h4>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            @endif
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
