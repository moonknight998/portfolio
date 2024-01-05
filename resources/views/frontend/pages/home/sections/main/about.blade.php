@if ($about)
    @if ($about->status == 1)
        <section id="about" class="about">
            <div class="container mt-5" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h3>{{$about ? ($about->question === '' ? __('admin/about/about-index.question-placeholder') : $about->question) : __('admin/about/about-index.question-placeholder')}}</h3>
                    <h2>{!!$about ? ($about->title === '' ? __('admin/about/about-index.title_placeholder') : $about->title) : __('admin/about/about-index.title_placeholder')!!}</h2>
                    <p>{!!$about ? ($about->summary === '' ? __('admin/about/about-index.summary_placeholder') : $about->summary) : __('admin/about/about-index.summary_placeholder')!!}</p>
                    <div class="text-center text-lg-start">
                        <a href="{{$about ? ($about->button_url === '' ? '#' : $about->button_url) : '#'}}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>{{$about ? ($about->button_text === '' ? __('admin/common.read_more') : $about->button_text) : __('admin/common.read_more')}}</span>
                        <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{$about ? ($about->image === '' ? asset('frontend/assets/img/about.jpg') : asset($about->image)) : asset('frontend/assets/img/about.jpg')}}" class="img-fluid" alt="">
                </div>

            </div>
            </div>
        </section>
    @endif
@endif

@if ($about == null)
<section id="about" class="about">
    <div class="container mt-5" data-aos="fade-up">
    <div class="row gx-0">

        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="content">
            <h3>{{__('admin/about/about-index.question-placeholder')}}</h3>
            <h2>{!!__('admin/about/about-index.title_placeholder')!!}</h2>
            <p>{!!__('admin/about/about-index.summary_placeholder')!!}</p>
            <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                <span>{{__('admin/common.read_more')}}</span>
                <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
        <img src="{{asset('frontend/assets/img/about.jpg')}}" class="img-fluid" alt="">
        </div>
    </div>
    </div>
</section>
@endif
