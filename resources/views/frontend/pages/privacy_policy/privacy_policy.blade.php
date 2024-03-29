@extends('frontend.layout.layout')

@section('content')
@if ($privacy_policy)
    @if ($privacy_policy->status == 1)
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row" style="margin-top: 50pt">
                <div class="col-lg-12 entries">
                    <article class="entry entry-single">
                        <h2 class="entry-title">
                            <a id="preview_title">{{$privacy_policy ? $privacy_policy->title : __('admin/termsofservice/termsofservice.title_preview')}}</a>
                        </h2>
                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i><a>@lang('admin/common.admin')</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i><a><time>{{$privacy_policy ? __('admin/common.updated_at').':'.' '.date('d-m-Y', strtotime($privacy_policy->updated_at)) : __('admin/common.updated_at').':'.' '.date('d-m-Y')}}</time></a></li>
                            </ul>
                        </div>
                        <div id="preview_content" class="ck-content">
                            @if ($privacy_policy)
                                {!!$privacy_policy->content!!}
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
