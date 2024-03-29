@extends('frontend.layout.layout')

@section('content')
@if ($terms_of_service)
    @if ($terms_of_service->status == 1)
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row" style="margin-top: 50pt">
                <div class="col-lg-12 entries">
                    <article class="entry entry-single">
                        <h2 class="entry-title">
                            <a id="preview_title">{{$terms_of_service ? $terms_of_service->title : __('admin/termsofservice/termsofservice.title_preview')}}</a>
                        </h2>
                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i><a>@lang('admin/common.admin')</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i><a><time>{{$terms_of_service ? __('admin/common.updated_at').':'.' '.date('d-m-Y', strtotime($terms_of_service->updated_at)) : __('admin/common.updated_at').':'.' '.date('d-m-Y')}}</time></a></li>
                            </ul>
                        </div>
                        <div id="preview_content" class="ck-content">
                            @if ($terms_of_service)
                                {!!$terms_of_service->content!!}
                            @else
                                <p>{{__('admin/termsofservice/termsofservice.content_preview')}}</p>
                            @endif
                            <!--Post content-->
                        </div>
                    </article><!-- End blog entry -->
                </div><!-- End blog entries list -->
            </div>
        </div>
    </section>
    @endif
@endif
@include('admin.pages.single.single_page_ckeditor5')
@endsection
