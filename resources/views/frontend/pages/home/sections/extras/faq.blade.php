@if ($faq_title)
    @if ($faq_title->status == 1)
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2 id="preview_section_name">{{$faq_title && $faq_title->section_name !== '' ? $faq_title->section_name : __('admin/common.section_name_preview')}}</h2>
                    <p id="preview_title">{{$faq_title && $faq_title->title !== '' ? $faq_title->title : __('admin/common.title_preview')}}</p>
                </header>
                <div class="row" id="faqlist">
                    <div class="col-lg-6">
                        <!-- F.A.Q List 1-->
                        <div class="accordion accordion-flush" style="--cui-accordion-bg: transparent">
                            @if (count($faq_items_active) > 0)
                                @foreach ($faq_items_active as $faq_item_local)
                                    @if (($loop->index + 2) % 2 == 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{$loop->index}}">
                                                {!!$faq_item_local->question!!}
                                                </button>
                                            </h2>
                                            <div id="faq-content-{{$loop->index}}" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                                <div class="accordion-body">
                                                {!!$faq_item_local->answer!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-x">
                                    {{__('admin/common.question_preview')}}
                                    </button>
                                </h2>
                                <div id="faq-content-x" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                    <div class="accordion-body">
                                    {{__('admin/common.answer_preview')}}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- F.A.Q List 2-->
                        <div class="accordion accordion-flush" style="--cui-accordion-bg: transparent">
                            @if (count($faq_items_active) > 0)
                                @foreach ($faq_items_active as $faq_item_local)
                                    @if (($loop->index + 2) % 2 != 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{$loop->index}}">
                                                {!!$faq_item_local->question!!}
                                                </button>
                                            </h2>
                                            <div id="faq-content-{{$loop->index}}" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                                <div class="accordion-body">
                                                {!!$faq_item_local->answer!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-y">
                                    {{__('admin/common.question_preview')}}
                                    </button>
                                </h2>
                                <div id="faq-content-y" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                    <div class="accordion-body">
                                    {{__('admin/common.answer_preview')}}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@else
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2 id="preview_section_name">{{__('admin/common.section_name_preview')}}</h2>
                <p id="preview_title">{{__('admin/common.title_preview')}}</p>
            </header>
            <div class="row" id="faqlist">
                <div class="col-lg-6">
                    <!-- F.A.Q List 1-->
                    <div class="accordion accordion-flush" style="--cui-accordion-bg: transparent">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-x">
                                {{__('admin/common.question_preview')}}
                                </button>
                            </h2>
                            <div id="faq-content-x" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                <div class="accordion-body">
                                {{__('admin/common.answer_preview')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- F.A.Q List 2-->
                    <div class="accordion accordion-flush" style="--cui-accordion-bg: transparent">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-y">
                                {{__('admin/common.question_preview')}}
                                </button>
                            </h2>
                            <div id="faq-content-y" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                <div class="accordion-body">
                                {{__('admin/common.answer_preview')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
