@extends('frontend.layout.layout')

@section('content')

<?php

$blog_posts_recent = \App\Models\BlogPost::all()->where('status', 1)->take(3);
$blog_categories = \App\Models\BlogCategory::all()->where('status', 1);

?>

<main id="main">
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row" style="margin-top: 50pt">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        <div class="entry-img">
                            <img src="{{$blog_post->thumbnail ? asset($blog_post->thumbnail) : asset('frontend/assets/img/blog/blog-1.jpg')}}" alt="" class="img-fluid">
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
                            <li><a id="preview_category" href="#">{{$blog_post->category->category_name}}</a></li>
                        </ul>
                        </div>
                    </article><!-- End blog entry -->
                    <div class="blog-author d-flex align-items-center">
                        <img src="{{asset('frontend/assets/img/blog/blog-author.jpg')}}" class="rounded-circle float-left" alt="">
                        <div>
                        <h4>Jane Smith</h4>
                        <div class="social-links">
                            <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                            <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                        </div>
                        <p>
                            {{__('admin/common.description_preview')}}
                        </p>
                        </div>
                    </div><!-- End blog author bio -->
                    <div class="blog-comments">
                        <h4 class="comments-count">8 {{__('admin/blog/blog.comments')}}</h4>
                        <div id="comment-1" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-1.jpg')}}" alt=""></div>
                                <div>
                                <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                    Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut sapiente quis molestiae est qui cum soluta.
                                    Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                                </p>
                                </div>
                            </div>
                        </div><!-- End comment #1 -->
                        <div id="comment-2" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-2.jpg')}}" alt=""></div>
                                <div>
                                <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                    Ipsam tempora sequi voluptatem quis sapiente non. Autem itaque eveniet saepe. Officiis illo ut beatae.
                                </p>
                                </div>
                            </div>
                        <div id="comment-reply-1" class="comment comment-reply">
                            <div class="d-flex">
                            <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-3.jpg')}}" alt=""></div>
                            <div>
                                <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                Enim ipsa eum fugiat fuga repellat. Commodi quo quo dicta. Est ullam aspernatur ut vitae quia mollitia id non. Qui ad quas nostrum rerum sed necessitatibus aut est. Eum officiis sed repellat maxime vero nisi natus. Amet nesciunt nesciunt qui illum omnis est et dolor recusandae.

                                Recusandae sit ad aut impedit et. Ipsa labore dolor impedit et natus in porro aut. Magnam qui cum. Illo similique occaecati nihil modi eligendi. Pariatur distinctio labore omnis incidunt et illum. Expedita et dignissimos distinctio laborum minima fugiat.

                                Libero corporis qui. Nam illo odio beatae enim ducimus. Harum reiciendis error dolorum non autem quisquam vero rerum neque.
                                </p>
                            </div>
                            </div>
                            <div id="comment-reply-2" class="comment comment-reply">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-4.jpg')}}" alt=""></div>
                                <div>
                                <h5><a href="">Sianna Ramsay</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                    Et dignissimos impedit nulla et quo distinctio ex nemo. Omnis quia dolores cupiditate et. Ut unde qui eligendi sapiente omnis ullam. Placeat porro est commodi est officiis voluptas repellat quisquam possimus. Perferendis id consectetur necessitatibus.
                                </p>
                                </div>
                            </div>
                            </div><!-- End comment reply #2-->
                        </div><!-- End comment reply #1-->
                        </div><!-- End comment #2-->
                        <div id="comment-3" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-5.jpg')}}" alt=""></div>
                                <div>
                                <h5><a href="">Nolan Davidson</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                    Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem aspernatur aut quam ut. Voluptatem est accusamus iste at.
                                    Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et optio veniam. Quam officia sit nostrum dolorem.
                                </p>
                                </div>
                            </div>
                        </div><!-- End comment #3 -->
                        <div id="comment-4" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{asset('frontend/assets/img/blog/comments-6.jpg')}}" alt=""></div>
                                <div>
                                <h5><a href="">Kay Duggan</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                <time datetime="2020-01-01">01 Jan, 2020</time>
                                <p>
                                    Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in fugiat.
                                </p>
                                </div>
                            </div>
                        </div><!-- End comment #4 -->
                        <div class="reply-form">
                            <h4>{{__('admin/common.leave_a_comment')}}</h4>
                            <p>{{__('admin/common.info_not_published')}}</p>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input name="name" type="text" class="form-control" placeholder="{{__('admin/common.your_name_required')}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" type="text" class="form-control" placeholder="{{__('admin/common.your_email')}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="comment" class="form-control" placeholder="{{__('admin/blog/blog.comments')}}"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{__('admin/blog/blog.comments')}}</button>
                            </form>
                        </div>
                    </div><!-- End blog comments -->
                </div><!-- End blog entries list -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                        <form action="">
                            <input type="text">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                        </div><!-- End sidebar search form-->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.categories')}}</h3>
                        <div class="sidebar-item categories">
                            <ul>
                            @foreach ($blog_categories as $blog_category)
                                <li><a href="#">{{$blog_category->category_name}}<span>({{ $blog_category->posts->count()}})</span></a></li>
                            @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->
                        <h3 class="sidebar-title">{{__('admin/blog/blog.recent_posts')}}</h3>
                        <div class="sidebar-item recent-posts">
                        @foreach ($blog_posts_recent as $blog_post_recent)
                            <div class="post-item clearfix">
                                <img src="{{asset($blog_post_recent->thumbnail)}}" alt="">
                                <h4><a href="{{route('blog-details', $blog_post_recent->id)}}">{{$blog_post_recent->post_title}}</a></h4>
                                <time>{{date('d-m-Y', strtotime($blog_post->created_at))}}</time>
                            </div>
                        @endforeach
                        </div><!-- End sidebar recent posts-->
                        </div><!-- End sidebar tags-->
                    </div><!-- End sidebar -->
                </div><!-- End blog sidebar -->
            </div>
        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

@endsection
