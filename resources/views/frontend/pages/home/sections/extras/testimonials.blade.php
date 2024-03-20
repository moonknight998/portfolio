@if ($testimonial_title)
    @if ($testimonial_title->status == 1)
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{$testimonial_title && $testimonial_title->section_name !== '' ? $testimonial_title->section_name : __('admin/common.section_name_preview')}}</h2>
                    <p>{{$testimonial_title && $testimonial_title->title !== '' ? $testimonial_title->title : __('admin/common.title_preview')}}</p>
                </header>
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="{{count($testimonial_items) > (MobileDetect()->isMobile() ? 1 : 3) ? "swiper-wrapper align-items-center" : "container-fluid"}}">
                        @if (count($testimonial_items) > 0)
                            @foreach ($testimonial_items as $testimonial_item_local)
                                <div class="{{count($testimonial_items) > (MobileDetect()->isMobile() ? 1 : 3) ? "swiper-slide" : "image-container"}}">
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
                                <p>{{__('admin/testimonial/testimonial.feedback_preview')}}</p>
                                <div class="profile mt-auto">
                                    <img src="{{asset('frontend/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
                                    <h3>{{__('admin/common.name_preview')}}</h3>
                                    <h4>{{__('admin/testimonial/testimonial.career_preview')}}</h4>
                                </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
@else
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>{{__('admin/common.section_name_preview')}}</h2>
                <p>{{__('admin/common.title_preview')}}</p>
            </header>
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="container-fluid">
                    <div class="image-container">
                        <div class="testimonial-item">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p id="preview_feedback">{{__('admin/testimonial/testimonial.feedback_preview')}}</p>
                        <div class="profile mt-auto">
                            <img src="{{asset('frontend/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
                            <h3>{{__('admin/common.name_preview')}}</h3>
                            <h4>{{__('admin/testimonial/testimonial.career_preview')}}</h4>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif
