@extends('frontend.layout.layout')

@section('content')

<?php
$blog_posts = GetBlogPostsPerPage(5);
$blog_categories = \App\Models\BlogCategory::all()->where('status', 1);
$blog_posts_recent = GetMostRecentBlogPosts(3);
$all_posts = GetAllActiveBlogPosts();
?>

<main id="main">
    <div class="blog-header">
        <div class="container">
          <h2>{{__('admin/blog/blog.all_blog_post')}}</h2>
        </div>
    </div>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-down">
            <div class="row" style="margin-top: 50pt">
                <!-- Blog entries list -->
                <div class="col-lg-8 entries">
                    <!-- Blog entry -->
                    @if (count($blog_posts) > 0)                
                        @foreach ($blog_posts as $blog_post_local)
                            <article class="entry">
                                <div class="entry-img">
                                <img class="post-thumbnail" src="{{$blog_post_local->thumbnail}}" alt="">
                                </div>
                                <h2 class="entry-title">
                                <a href="{{route('blog-details', $blog_post_local->slug)}}">{{$blog_post_local->post_title}}</a>
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
                                    <a href="{{route('blog-details', $blog_post_local->slug)}}">{{__('admin/common.read_more')}}</a>
                                </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                    <h2>@lang('admin/common.no_post')</h2>
                    @endif
                    <!-- End blog entry -->
                    <!-- Blog pagniation -->
                    <div class="blog-pagination">
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
                            <form method="GET" action="{{route('blogs.search-results')}}">
                                <input type="text" name="keyword" placeholder="{{__('admin/common.search_placeholder')}}">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <!-- End sidebar search form -->
                        <!-- Sidebar categories -->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.categories')}}</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="{{route('blogs')}}">{{__('admin/common.all_post')}}<span>({{count($all_posts)}})</span></a></li>
                                @foreach ($blog_categories as $blog_category)
                                    <li><a href="{{route('blogs.by-category', $blog_category->slug)}}">{{$blog_category->category_name}}<span>({{ $blog_category->posts->where('status', 1)->count()}})</span></a></li>
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
                                    <h4><a href="{{route('blog-details', $blog_post_local->slug)}}">{{$blog_post_recent->post_title}}</a></h4>
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
