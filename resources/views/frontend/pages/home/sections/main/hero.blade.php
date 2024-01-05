@if ($hero)
    @if ($hero->status == 1)
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
              <h1 data-aos="fade-up">{{$hero->slogan}}</h1>
              <h2 data-aos="fade-up" data-aos-delay="400">{{$hero->short_description}}</h2>
              <div data-aos="fade-up" data-aos-delay="600">
                <div class="text-center text-lg-start">
                    <a href="#{{$hero->button_url}}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>{{$hero->button_text}}</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
              <img src="{{$hero->image === '' ? asset('frontend/assets/img/hero-img.png') : asset($hero->image)}}" class="img-fluid" alt="">
            </div>
          </div>
        </div>
    </section>
    @endif
@endif

@if ($hero == null)
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">{{__('admin/hero/hero-index.slogan-placeholder')}}</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">{{__('admin/hero/hero-index.short-description-placeholder')}}</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
                <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>{{__('admin/common.get_started')}}</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{asset('frontend/assets/img/hero-img.png')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>
</section>
@endif
