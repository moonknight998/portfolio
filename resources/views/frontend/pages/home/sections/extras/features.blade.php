<section id="features" class="features">

    <div class="container" data-aos="fade-up">
        @if ($feature_title)
            @if ($feature_title->status == 1)
                <header class="section-header" style="display: block; justify-content: center; align-content: center;">
                    <h2>{{$feature_title->section_name ? $feature_title->section_name : __('admin/feature/feature.section_name_placeholder')}}</h2>
                    <p>{{$feature_title->title ? $feature_title->title : __('admin/feature/feature.title_placeholder')}}</p>
                </header>
                <div class="row">
                    <div class="col-lg-6" style="display: flex; justify-content: center; align-content: center;">
                        <img src="{{$feature_title->image ? asset($feature_title->image) : asset('/frontend/assets/img/features.png')}}" class="img-fluid" alt="">
                    </div>
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
            @endif
        @else <!--Show default value if title not exist yet-->
            <header class="section-header" style="display: block; justify-content: center; align-content: center;">
                <h2>{{__('admin/feature/feature.section_name_placeholder')}}</h2>
                <p>{{__('admin/feature/feature.title_placeholder')}}</p>
            </header>
            <div class="row">
                <div class="col-lg-6" style="display: flex; justify-content: center; align-content: center;">
                    <img src="{{asset('/frontend/assets/img/features.png')}}" class="img-fluid" alt="">
                </div>
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
        @endif


        <!-- Feature Tabs -->
        @if ($feature_tab_title)
            @if ($feature_tab_title->status == 1)
                <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>{{$feature_tab_title->title}}</h3>
                        <ul class="nav nav-pills mb-3">
                            @if (count($feature_tab_items) > 0)
                                @foreach ($feature_tab_items as $feature_tab_item)
                                    @if ($feature_tab_item->status == 1)
                                        <li><a class="nav-link {{$feature_tab_item->tab_id === 'tab1' ? 'active' : ''}}" data-bs-toggle="pill" href="#{{$feature_tab_item->tab_id}}">{{$feature_tab_item->tab_name}}</a></li>
                                    @endif
                                @endforeach
                            @else
                            <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">{{__('admin/feature/feature.tab_item_name_placeholder')}}</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            @if (count($feature_tab_items) > 0)
                                @foreach ($feature_tab_items as $feature_tab_item)
                                    @if ($feature_tab_item->status == 1)
                                        <div class="tab-pane fade {{$feature_tab_item->tab_id === 'tab1' ? 'show active' : ''}}" id="{{$feature_tab_item->tab_id}}">
                                            <p>{{$feature_tab_item->first_description}}</p>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="bi bi-check2"></i>
                                                <h4>{{$feature_tab_item->first_title}}</h4>
                                            </div>
                                            <p>{{$feature_tab_item->second_description}}</p>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="bi bi-check2"></i>
                                                <h4>{{$feature_tab_item->second_title}}</h4>
                                            </div>
                                            <p>{{$feature_tab_item->third_description}}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                            <div class="tab-pane fade show active" id="tab1">
                                <p>{{__('admin/feature/feature.tab_item_first_description_placeholder')}}</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{__('admin/feature/feature.tab_item_first_title_placeholder')}}</h4>
                                </div>
                                <p>{{__('admin/feature/feature.tab_item_second_description_placeholder')}}</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{__('admin/feature/feature.tab_item_second_title_placeholder')}}</h4>
                                </div>
                                <p>{{__('admin/feature/feature.tab_item_third_description_placeholder')}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{$feature_tab_title ? ($feature_tab_title->image === '' ? asset('frontend/assets/img/features-2.png') : $feature_tab_title->image) : asset('frontend/assets/img/features-2.png')}}" class="img-fluid" alt="">
                    </div>
                </div>
            @endif
        @else <!--Show default value if title not exist yet-->
            <div class="row feture-tabs" data-aos="fade-up">
                <div class="col-lg-6">
                    <h3>{{__('admin/feature/feature.title_placeholder')}}</h3>
                    <ul class="nav nav-pills mb-3">
                        @if (count($feature_tab_items) > 0)
                            @foreach ($feature_tab_items as $feature_tab_item)
                                @if ($feature_tab_item->status == 1)
                                    <li><a class="nav-link {{$feature_tab_item->tab_id === 'tab1' ? 'active' : ''}}" data-bs-toggle="pill" href="#{{$feature_tab_item->tab_id}}">{{$feature_tab_item->tab_name}}</a></li>
                                @endif
                            @endforeach
                        @else
                        <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">{{__('admin/feature/feature.tab_item_name_placeholder')}}</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if (count($feature_tab_items) > 0)
                            @foreach ($feature_tab_items as $feature_tab_item)
                                @if ($feature_tab_item->status == 1)
                                    <div class="tab-pane fade {{$feature_tab_item->tab_id === 'tab1' ? 'show active' : ''}}" id="{{$feature_tab_item->tab_id}}">
                                        <p>{{$feature_tab_item->first_description}}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check2"></i>
                                            <h4>{{$feature_tab_item->first_title}}</h4>
                                        </div>
                                        <p>{{$feature_tab_item->second_description}}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check2"></i>
                                            <h4>{{$feature_tab_item->second_title}}</h4>
                                        </div>
                                        <p>{{$feature_tab_item->third_description}}</p>
                                    </div>
                                @endif
                            @endforeach
                        @else
                        <div class="tab-pane fade show active" id="tab1">
                            <p>{{__('admin/feature/feature.tab_item_first_description_placeholder')}}</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-check2"></i>
                                <h4>{{__('admin/feature/feature.tab_item_first_title_placeholder')}}</h4>
                            </div>
                            <p>{{__('admin/feature/feature.tab_item_second_description_placeholder')}}</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-check2"></i>
                                <h4>{{__('admin/feature/feature.tab_item_second_title_placeholder')}}</h4>
                            </div>
                            <p>{{__('admin/feature/feature.tab_item_third_description_placeholder')}}</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{$feature_tab_title ? ($feature_tab_title->image === '' ? asset('frontend/assets/img/features-2.png') : $feature_tab_title->image) : asset('frontend/assets/img/features-2.png')}}" class="img-fluid" alt="">
                </div>
            </div><!-- End Feature Tabs -->
        @endif


        <!-- Feature Icons -->
        @if ($feature_icon_title)
            @if ($feature_icon_title->status == '1')
                <div class="row feature-icons" data-aos="fade-up">
                    <h3>{{$feature_icon_title->title}}</h3>
                    <div class="row">
                        <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                            <img src="{{$feature_icon_title->image === '' ? asset('frontend/assets/img/features-3.png') : $feature_icon_title->image}}" class="img-fluid p-4" alt="">
                        </div>
                        <div class="col-xl-8 d-flex content">
                            <div class="row align-self-center gy-4" style="width: 100%">
                                @if (count($feature_icon_items) > 0)
                                    @foreach ($feature_icon_items as $feature_icon_item_local)
                                        <div class="col-md-6 icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                            <i class="{{$feature_icon_item_local->icon}}"></i>
                                            <div>
                                                <h4>{{$feature_icon_item_local->title}}</h4>
                                                <p>{{$feature_icon_item_local->description}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-6 icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                        <i class="bi bi-check2-all"></i>
                                        <div>
                                            <h4>{{__('admin/feature/feature.title_placeholder')}}</h4>
                                            <p>{{__('admin/feature/feature.description_placeholder')}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="row feature-icons" data-aos="fade-up">
                <h3>{{__('admin/feature/feature.title_placeholder')}}</h3>
                <div class="row">
                    <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{asset('frontend/assets/img/features-3.png')}}" class="img-fluid p-4" alt="">
                    </div>
                    <div class="col-xl-8 d-flex content">
                        <div class="row align-self-center gy-4" style="width: 100%">
                            <div class="col-md-6 icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-check2-all"></i>
                                <div>
                                    <h4>{{__('admin/feature/feature.title_placeholder')}}</h4>
                                    <p>{{__('admin/feature/feature.description_placeholder')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- End Feature Icons -->
    </div>
</section>
