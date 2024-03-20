@if ($client_title)
    @if ($client_title->status == 1)
        <section id="clients" class="clients">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2 id="preview_section_name">{{ShowTextData($client_title, 'section_name', __('admin/common.section_name_preview'))}}</h2>
                    <p id="preview_title">{{ShowTextData($client_title, 'title', __('admin/common.title_preview'))}}</p>
                </header>
                <div class="clients-slider swiper">
                    <div class="{{count($client_items_active) > (MobileDetect()->isMobile() ? 1 : 5) ? "swiper-wrapper align-items-center" : "container-fluid little-item"}}">
                        @if (count($client_items_active) > 0)
                            @foreach ($client_items_active as $client_item_local)
                            <div class="{{count($client_items_active) > (MobileDetect()->isMobile() ? 1 : 5) ? "swiper-slide" : "image-container"}}"><img src="{{$client_item_local->logo}}" class="img-fluid" alt="{{$client_item_local->brand_name}}"></div>
                            @endforeach
                        @else
                        <div class="image-container"><img src="{{asset('frontend/assets/img/clients/preview-text-logo.png')}}" class="img-fluid" alt=""></div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
@else
<section id="clients" class="clients">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>{{__('admin/common.section_name_preview')}}</h2>
            <p>{{__('admin/common.title_preview')}}</p>
        </header>
        <div class="clients-slider swiper">
            <div class="container-fluid little-item">
                <div class="image-container"><img src="{{asset('frontend/assets/img/clients/preview-text-logo.png')}}" class="img-fluid" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
