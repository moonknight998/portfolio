<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        @if ($pricing_title)
            @if ($pricing_title->status == 1)
            <header class="section-header">
                <h2>{{$pricing_title ? $pricing_title->section_name : __('admin/common.section_name_preview')}}</h2>
                <p>{{$pricing_title ? $pricing_title->title : __('admin/common.title_preview')}}</p>
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
                <div class="row gy-4" data-aos="fade-left">
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
            @endif
        @else
        <header class="section-header">
            <h2>Pricing</h2>
            <p>Check our Pricing</p>
        </header>
        <div class="row gy-4" data-aos="fade-left">
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
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
</section>
