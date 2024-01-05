<section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2
        >{{$value_title ?
            ($value_title->section_name === '' ? __('admin/value/value-index.section_name_placeholder') : $value_title->section_name)
            : __('admin/value/value-index.section_name_placeholder')
        }}</h2>
        <p
        >{!!$value_title ?
            ($value_title->title === '' ? __('admin/value/value-index.title_placeholder') : $value_title->title)
            : __('admin/value/value-index.title_placeholder')
        !!}</p>
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
        @endif
      </div>
    </div>
</section>
