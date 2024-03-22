@extends('frontend.layout.layout')

@section('content')

<?php
$all_posts = GetAllActiveBlogPosts(); //For show all posts in sidebar
$blog_categories = \App\Models\BlogCategory::all()->where('status', 1);//For show categories and post count in sidebar
$blog_posts_recent = GetMostRecentBlogPosts(3); //For show recent posts in sidebar
$blog_posts_search_result = GetBlogPostSearchResult($search_results);
$blog_post_search_result_paginate = GetBlogPostsPerPage(5);
?>

<main id="main">
    <section class="breadcrumbs" style="background: rgb(182, 182, 182)">
        <div class="container">
          <h2>{{__('admin/common.search').': '.$blog_search_keyword}}</h2>
        </div>
    </section>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-down">
            <div class="row" style="margin-top: 50pt">
                <!-- Blog entries list -->
                <div class="col-lg-8 entries">
                    @if (count($blog_posts_search_result) > 0)
                    @foreach ($blog_posts_search_result as $search_result)
                        <article class="entry">
                            <div class="entry-img">
                                <img class="post-thumbnail" src="{{$search_result->searchable->thumbnail}}" alt="">
                            </div>
                            <h2 class="entry-title">
                                <a href="{{route('blog-details', $search_result->searchable->slug)}}">{{$search_result->searchable->post_title}}</a>
                            </h2>
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i><a>{{$search_result->searchable->post_author}}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><a><time>{{$search_result->searchable->created_at->format('d-m-Y')}}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i><a>12 {{__('admin/blog/blog.comments')}}</a></li>
                                </ul>
                            </div>
                            <div class="entry-content">
                                <p>
                                    {!!Str::limit(PostContentParse($search_result->searchable->post_content), 400)!!}
                                </p>
                                <div class="read-more">
                                    <a href="{{route('blog-details', $search_result->searchable->slug)}}">{{__('admin/common.read_more')}}</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    @else
                        <h2>{{__('admin/blog/blog.no_post_found')}}</h2>
                    @endif
                    <!-- Blog pagniation -->
                    <div class="blog-pagination">
                        {!!$blog_post_search_result_paginate->links('vendor.pagination.core-ui')!!}
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
                            <form id="search-form" novalidate method="GET" action="{{route('blogs.search-results')}}">
                                <input type="text" name="keyword" placeholder="{{__('admin/common.search_placeholder')}}" required>
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
                                    <h4><a href="{{route('blog-details', $blog_post_recent->slug)}}">{{$blog_post_recent->post_title}}</a></h4>
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
            @include('frontend.pages.blog.blog-toaster')
        </div>
    </section>
    <!-- End Blog Section -->
</main>
<!-- End #main -->

@endsection
