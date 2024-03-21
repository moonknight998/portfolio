@extends('frontend.layout.layout')

@section('content')

<?php

$blog_posts_recent = GetMostRecentBlogPosts(3);
$blog_categories = \App\Models\BlogCategory::all()->where('status', 1);
$all_posts = GetAllActiveBlogPosts();

?>

<main id="main">
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row" style="margin-top: 50pt">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        <div class="entry-img">
                            <img class="post-thumbnail" src="{{$blog_post->thumbnail ? asset($blog_post->thumbnail) : asset('frontend/assets/img/blog/blog-1.jpg')}}">
                        </div>
                        <h2 class="entry-title">
                            <a>{{$blog_post->post_title}}</a>
                        </h2>
                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a id="preview_post_author">{{$blog_post->post_author}}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a><time>{{date('d-m-Y', strtotime($blog_post->created_at))}}</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
                            </ul>
                        </div>
                        <div class="ck-content">
                            {!!$blog_post->post_content!!}
                        </div>
                        <div class="entry-footer">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="#">{{$blog_post->category->category_name}}</a></li>
                            </ul>
                        </div>
                    </article><!-- End blog entry -->
                    <div class="blog-author d-flex align-items-center">
                        <img src="{{asset('frontend/assets/img/blog/blog-author.jpg')}}" class="rounded-circle float-left" alt="">
                        <div>
                            <h4>{{$blog_post->post_author}}</h4>
                            <div class="social-links">
                                <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                                <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                            </div>
                            <p>
                                {{__('admin/common.description_preview')}}
                            </p>
                        </div>
                    </div>
                    <!-- End blog author bio -->
                    <div id="blog-comments" class="blog-comments">
                        <h4 class="comments-count">3 {{__('admin/blog/blog.comments')}}</h4>
                        <div id="comment-2" class="comment">
                            <div class="d-flex">
                                <div class="comment-img">C</div>
                                <div>
                                    <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan, 2020</time>
                                    <p>
                                        {{__('admin/common.comment_preview')}}
                                    </p>
                                </div>
                            </div>
                            <!-- End comment reply #1-->
                        </div>
                        <!-- End comment #2-->
                        <div class="reply-form">
                            <h4>{{__('admin/common.leave_a_comment')}}</h4>
                            <p>{{__('admin/common.info_not_published')}}</p>
                            <form method="POST" action="{{route('blogs.comment.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <input name="name" type="text" class="form-control" placeholder="{{__('admin/common.your_name_required')}}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input name="phone_number" type="tel" class="form-control" placeholder="{{__('admin/common.phone_number')}}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input name="email" type="email" class="form-control" placeholder="{{__('admin/common.your_email')}}">
                                    </div>
                                    <div class="col-md-4 form-group" style="display: none">
                                        <input name="blog_post_id" type="number" class="form-control" value="{{$blog_post->id}}">
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="comment" class="form-control" placeholder="{{__('admin/common.your_comment_required')}}"></textarea>
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-primary">{{__('admin/blog/blog.comments')}}</button>
                            </form>
                        </div>
                    </div>
                    <!-- End blog comments -->
                </div>
                <!-- End blog entries list -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <h3 class="sidebar-title">{{__('admin/common.search')}}</h3>
                        <div class="sidebar-item search-form">
                            <form method="GET" action="{{route('blogs.search-results')}}">
                                <input type="text" name="keyword" placeholder="{{__('admin/common.search_placeholder')}}">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <!-- End sidebar search form-->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.categories')}}</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="{{route('blogs')}}">{{__('admin/common.all_post')}}<span>({{count($all_posts)}})</span></a></li>
                            @foreach ($blog_categories as $blog_category)
                                <li><a href="{{route('blogs.by-category', $blog_category->slug)}}">{{$blog_category->category_name}}<span>({{ $blog_category->posts->count()}})</span></a></li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- End sidebar categories-->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.recent_posts')}}</h3>
                        <div class="sidebar-item recent-posts">
                        @foreach ($blog_posts_recent as $blog_post_recent)
                            <div class="post-item clearfix">
                                <img src="{{asset($blog_post_recent->thumbnail)}}" alt="">
                                <h4><a href="{{route('blog-details', $blog_post_recent->slug)}}">{{$blog_post_recent->post_title}}</a></h4>
                                <time>{{$blog_post_recent->created_at->format('d-m-Y')}}</time>
                            </div>
                        @endforeach
                        </div>
                        <!-- End sidebar recent posts-->
                    </div>
                    <!-- End sidebar tags-->
                </div>
                <!-- End sidebar -->
            </div>
            <!-- End blog sidebar -->
        </div>
    </section>
    <!-- End Blog Single Section -->

</main><!-- End #main -->

@endsection
