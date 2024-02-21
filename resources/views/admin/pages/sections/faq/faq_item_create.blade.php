@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.faq_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/faq/faq.create_item')}}</a></li>
          </ol>
        </nav>
      </div>
</header>
<!--End Breadcrumb-->

<!--Main Part-->
<div class="body flex-grow-1 px-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header">
                            <h2>{{__('admin/faq/faq.create_item')}}</h2>
                        </div>
                        <form method="POST" action="{{route('admin.faq_item.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="example">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li class="nav-item" role="presentation"><a class="nav-link active"
                                        data-coreui-toggle="tab" role="tab" aria-selected="true" onclick="openTab(event, 'content_tab', 'preview_tab')">
                                          <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-media-play')}}"></use>
                                          </svg>{{__('admin/common.content')}}</a>
                                        </li>
                                    <li class="nav-item" role="presentation"><a class="nav-link"
                                        data-coreui-toggle="tab" role="tab" aria-selected="false" onclick="openTab(event, 'preview_tab', 'content_tab')">
                                            <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-code')}}"></use>
                                            </svg>{{__('admin/common.preview')}}</a>
                                        </li>
                                    </ul>
                                    <!--Edit Tab-->
                                    <div class="tab-content rounded-bottom" id="content_tab">
                                      <div class="tab-pane p-3 active preview" role="tabpanel" >
                                        @if (session('status') === 'created')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{__('admin/faq/faq.item_created')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.question')}}</label>
                                            <textarea class="form-control" rows="5" id="question" name="question" type="text"
                                            onchange="loadDocument(event, 'preview_question')"
                                            onkeypress="detectEnterline(event, 'question'); loadDocument(event, 'preview_question')"></textarea>
                                            @if ($errors->has('question'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('question')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.answer')}}</label>
                                            <textarea class="form-control" rows="5" id="answer" name="answer" type="text"
                                            onchange="loadDocument(event, 'preview_answer')"
                                            onkeypress="detectEnterline(event, 'answer'); loadDocument(event, 'preview_answer')"></textarea>
                                            @if ($errors->has('answer'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('answer')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option selected value="1">{{__('admin/common.display')}}</option>
                                                <option value="0">{{__('admin/common.hide')}}</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!--End Edit Tab-->

                                    <!--Preview Tab-->
                                    <div class="tab-content rounded-bottom" id="preview_tab" style="display: none">
                                        <div class="tab-pane active preview" role="tabpanel">
                                            @if ($detect->isMobile())
                                            <div class="alert alert-warning fade show mt-4" role="alert">
                                                {{__('admin/common.about_mobile_warning')}}
                                            </div>
                                            @endif
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
                                                                    @if ((count($faq_items_active) + 2) % 2 == 0)
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header">
                                                                                <button id="preview_question" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-x">
                                                                                {{__('admin/common.question_preview')}}
                                                                                </button>
                                                                            </h2>
                                                                            <div id="faq-content-x" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                                                                <div class="accordion-body" id="preview_answer">
                                                                                {{__('admin/common.answer_preview')}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button id="preview_question" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-x">
                                                                        {{__('admin/common.question_preview')}}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="faq-content-x" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                                                        <div class="accordion-body" id="preview_answer">
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
                                                                    @if ((count($faq_items_active) + 2) % 2 != 0)
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header">
                                                                                <button id="preview_question" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-y">
                                                                                {{__('admin/common.question_preview')}}
                                                                                </button>
                                                                            </h2>
                                                                            <div id="faq-content-y" class="accordion-collapse collapse" data-bs-parent="#faqlist" style="visibility: visible">
                                                                                <div class="accordion-body" id="preview_answer">
                                                                                {{__('admin/common.answer_preview')}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
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
                                        </div>
                                    </div>
                                    <!--End Preview Tab-->
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <button class="btn btn-primary mb-3" type="submit">{{__('admin/common.create_new')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Part-->

@endsection
