@if ($service_title)
    @if ($service_title->status == 1)
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>{{$service_title->section_name}}</h2>
                <p>{!!$service_title->title!!}</p>
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
                <div class="row gy-4" style="justify-content: center">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-box blue">
                            <i class="ri-discuss-line icon"></i>
                            <h3>{{__('admin/common.title_preview')}}</h3>
                            <p>{{__('admin/common.description_preview')}}</p>
                            <a href="#" class="read-more"><span>{{__('admin/common.read_more')}}</span> <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif
@else
<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>{{__('admin/common.section_name_preview')}}</h2>
            <p>{!!__('admin/common.title_preview')!!}</p>
        </header>
        <div class="row gy-4" style="justify-content: center">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-box blue">
                    <i class="ri-discuss-line icon"></i>
                    <h3>{{__('admin/common.title_preview')}}</h3>
                    <p>{{__('admin/common.description_preview')}}</p>
                    <a href="#" class="read-more"><span>{{__('admin/common.read_more')}}</span> <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
