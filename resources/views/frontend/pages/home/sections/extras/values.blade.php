<section id="values" class="values">
    @if ($value_title)
        @if ($value_title->status == 1)
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{$value_title->section_name === '' ? __('admin/value/value-index.section_name_placeholder') : $value_title->section_name}}</h2>
                    <p>{!!$value_title->title === '' ? __('admin/value/value-index.title_placeholder') : $value_title->title!!}</p>
                </header>
                <div class="row" style="justify-content: center">
                    @if ($value_cards != null)
                        @foreach ($value_cards as $value_card_item)
                            <div class="col-lg-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                                <div class="box">
                                    <img src="{{$value_card_item->image === '' ? (asset('frontend/assets/img/values-1.png')) : asset($value_card_item->image)}}" class="img-fluid" alt="">
                                    <h3>{!!$value_card_item->title!!}</h3>
                                    <p>{!!$value_card_item->description!!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="box">
                                <img src="{{asset('frontend/assets/img/values-1.png')}}" class="img-fluid" alt="">
                                <h3>{!!__('admin/value/value-index.title_placeholder')!!}</h3>
                                <p>{!!__('admin/value/value-index.description_placeholder')!!}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>{{__('admin/value/value-index.section_name_placeholder')}}</h2>
                <p>{!!__('admin/value/value-index.title_placeholder')!!}</p>
            </header>
            <div class="row" style="justify-content: center">
                <div class="col-lg-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="box">
                        <img src="{{asset('frontend/assets/img/values-1.png')}}" class="img-fluid" alt="">
                        <h3>{!!__('admin/value/value-index.title_placeholder')!!}</h3>
                        <p>{!!__('admin/value/value-index.description_placeholder')!!}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
