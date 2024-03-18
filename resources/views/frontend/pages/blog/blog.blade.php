@extends('frontend.layout.layout')

@section('content')

<?php
$blog_posts = GetBlogPostsPerPage(5);
$blog_categories = \App\Models\BlogCategory::all()->where('status', 1);
$blog_posts_recent = GetMostRecentBlogPosts(3);
?>

<main id="main">
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-down">
            <div class="row" style="margin-top: 50pt">

                <!-- Blog entries list -->
                <div class="col-lg-8 entries">
                    <!-- Blog entry -->
                    @foreach ($blog_posts as $blog_post_local)
                        <article class="entry">
                            <div class="entry-img">
                            <img src="{{$blog_post_local->thumbnail}}" alt="" class="img-fluid">
                            </div>
                            <h2 class="entry-title">
                            <a href="{{route('blog-details', $blog_post_local->id)}}">{{$blog_post_local->post_title}}</a>
                            </h2>
                            <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i><a>{{$blog_post_local->post_author}}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i><a><time>{{$blog_post_local->created_at->format('d-m-Y')}}</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i><a>12 {{__('admin/blog/blog.comments')}}</a></li>
                            </ul>
                            </div>
                            <div class="entry-content">
                            <p>
                                {!!Str::limit(PostContentParse($blog_post_local->post_content), 400)!!}
                            </p>
                            <div class="read-more">
                                <a href="{{route('blog-details', $blog_post_local->id)}}">{{__('admin/common.read_more')}}</a>
                            </div>
                            </div>
                        </article>
                    @endforeach
                    <!-- End blog entry -->
                    <!-- Blog pagniation -->
                    <div class="blog-pagination">
                        {{-- <ul class="justify-content-center">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul> --}}
                        {!!$blog_posts->links('vendor.pagination.core-ui')!!}
                    </div>
                    <!-- End blog pagniation -->
                </div>
                <!-- End blog entries list -->
                <div class="col-lg-4">
                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar search form -->
                        <h3 class="sidebar-title">{{__('admin/common.search')}}</h3>
                        <div class="sidebar-item search-form">
                            <form action="">
                                <input type="text" name="search_key" placeholder="{{__('admin/common.search_placeholder')}}">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <!-- End sidebar search form -->
                        <!-- Sidebar categories -->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.categories')}}</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($blog_categories as $blog_category)
                                    <li><a href="#">{{$blog_category->category_name}}<span>({{ $blog_category->posts->count()}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End sidebar categories-->
                        <!-- Sidebar recent posts-->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.recent_posts')}}</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($blog_posts_recent as $blog_post_recent)
                                <div class="post-item clearfix">
                                    <img src="{{asset($blog_post_recent->thumbnail)}}" alt="">
                                    <h4><a href="{{route('blog-details', $blog_post_recent->id)}}">{{$blog_post_recent->post_title}}</a></h4>
                                    <time>{{$blog_post_recent->created_at->format('d-m-Y')}}</time>
                                </div>
                            @endforeach
                        </div>
                        <!-- End sidebar recent posts-->
                    </div>
                    <!-- End sidebar -->
                </div>
                <!-- End blog sidebar -->
            </div>
        </div>
    </section>
    <!-- End Blog Section -->
</main>
<!-- End #main -->

@endsection
