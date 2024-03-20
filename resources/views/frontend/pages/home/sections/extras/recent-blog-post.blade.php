@if ($blog_title)
    @if ($blog_title->status == 1)
        <section class="recent-blog-posts" id="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{$blog_title->section_name}}</h2>
                    <p>{{$blog_title->title}}</p>
                </header>
                <div class="row" style="justify-content: center">
                    @if (count($blog_posts) > 0)
                        @foreach ($blog_posts as $blog_post_local)
                            <div class="col-lg-4">
                                <div class="post-box">
                                    <div class="post-img">
                                        <img src="{{$blog_post_local->thumbnail ? asset($blog_post_local->thumbnail) : asset('frontend/assets/img/blog/blog-1.jpg')}}"
                                        class="img-fluid" alt="Blog Image 1"></div>
                                    <span class="post-date">{{date('d-m-Y', strtotime($blog_post_local->created_at))}}</span>
                                    <h3 class="post-title">{{$blog_post_local->post_title}}</h3>
                                    <a href="{{route('blog-details', $blog_post_local->id)}}" class="readmore stretched-link mt-auto"><span>{{__('admin/common.read_more')}}</span><i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-4">
                            <div class="post-box">
                                <div class="post-img"><img src="{{asset('frontend/assets/img/blog/blog-1.jpg')}}" class="img-fluid" alt="Blog Image 1"></div>
                                <span class="post-date">{{date('d-m-Y')}}</span>
                                <h3 class="post-title">{{__('admin/common.title_preview')}}</h3>
                                <a class="readmore stretched-link mt-auto"><span>{{__('')}}</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@else
<section class="recent-blog-posts" id="recent-blog-posts">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>{{__('admin/common.section_name_preview')}}</h2>
            <p>{{__('admin/common.title_preview')}}</p>
        </header>
        <div class="row" style="justify-content: center">
            <div class="col-lg-4">
                <div class="post-box">
                    <div class="post-img"><img src="{{asset('frontend/assets/img/blog/blog-1.jpg')}}" class="img-fluid" alt="Blog Image 1"></div>
                    <span class="post-date">{{date('d-m-Y')}}</span>
                    <h3 class="post-title">{{__('admin/common.title_preview')}}</h3>
                    <a class="readmore stretched-link mt-auto"><span>{{__('')}}</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

