@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.blog_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/blog/blog.create_post')}}</a></li>
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
                            <h2>{{__('admin/blog/blog.create_post')}}</h2>
                        </div>
                        <form class="was-validated" novalidate method="POST" action="{{route('blog.blog_post.store')}}" enctype="multipart/form-data">
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
                                            {{__('admin/blog/blog.post_created')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_title_required')}}</label>
                                            <input class="form-control" name="post_title" type="text" placeholder="{{__('admin/blog/blog.post_title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_post_title')" required minlength="3" maxlength="500"></input>
                                            @if ($errors->has('post_title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.thumbnail_required')}}</label>
                                            <input class="form-control" id="file-upload" name="thumbnail" type="file" preview-id="preview_thumbnail"
                                            required accept="image/png, image/jpeg" max-size-error="{{__('admin/common.file-big-error')}}" max-size="{{GetMaxFileSizeUpload()}}"></input>
                                            @if ($errors->has('thumbnail'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('thumbnail')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_content')}}</label>
                                            <textarea class="form-control" rows="5" id="ckeditor5" name="post_content" type="text" required></textarea>
                                            @if ($errors->has('post_content'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_content')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.categories_required')}}</label>
                                            <select class="form-select" name="category_id" onchange="loadDocumentOption(event, 'preview_category')" required>
                                                @foreach ($blog_categories as $blog_category)
                                                    <option @selected($loop->index == 0) value="{{$blog_category->id}}">{{$blog_category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/blog/blog.post_author')}}</label>
                                            <input class="form-control" name="post_author" type="text" placeholder="{{__('admin/blog/blog.post_author_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_post_author');loadDocument(event, 'preview_post_author_2')" required minlength="3" maxlength="100"></input>
                                            @if ($errors->has('post_author'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('post_author')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status" required>
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
                                            @if (MobileDetect()->isMobile())
                                            <div class="alert alert-warning fade show mt-4" role="alert">
                                                {{__('admin/common.about_mobile_warning')}}
                                            </div>
                                            @endif
                                        </div>
                                        <section id="blog" class="blog">
                                            <div class="container" data-aos="fade-up">
                                                <div class="row" style="margin-top: 50pt">
                                                    <div class="col-lg-8 entries">
                                                        <article class="entry entry-single">
                                                            <div class="entry-img">
                                                                <img class="post-thumbnail" id="preview_thumbnail" src="{{asset('frontend/assets/img/blog/blog-1.jpg')}}" alt="">
                                                            </div>
                                                                <h2 class="entry-title">
                                                                <a id="preview_post_title">{{__('admin/blog/blog.post_title_preview')}}</a>
                                                            </h2>
                                                            <div class="entry-meta">
                                                                <ul>
                                                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a id="preview_post_author">{{__('admin/blog/blog.post_author_preview')}}</a></li>
                                                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a ><time>{{date('d-m-Y')}}</time></a></li>
                                                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="create#blog-comments">12 {{__('admin/blog/blog.comments')}}</a></li>
                                                                </ul>
                                                            </div>
                                                            <div id="preview_post_content" class="ck-content">
                                                                <p>{{__('admin/blog/blog.post_content_preview')}}</p>
                                                                <!--Post content-->
                                                            </div>
                                                            <div class="entry-footer">
                                                                <i class="bi bi-folder"></i>
                                                                <ul class="cats">
                                                                    <li><a id="preview_category">{{$blog_categories[0]->category_name}}</a></li>
                                                                </ul>
                                                            </div>
                                                        </article><!-- End blog entry -->
                                                        <div id="blog-author" class="blog-author d-flex align-items-center">
                                                            <img src="{{asset('frontend/assets/img/blog/blog-author.jpg')}}" class="rounded-circle float-left" alt="">
                                                            <div>
                                                                <h4 id="preview_post_author_2">{{__('admin/blog/blog.post_author_preview')}}</h4>
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
                                                        <div id="blog-comments" class="blog-comments">
                                                            <h4 class="comments-count">3 Comments</h4>
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
                                                                    </div>
                                                                    <!-- End comment reply #2-->
                                                                </div>
                                                                <!-- End comment reply #1-->
                                                            </div>
                                                            <!-- End comment #2-->
                                                            <div class="reply-form">
                                                                <h4>{{__('admin/common.leave_a_comment')}}</h4>
                                                                <p>{{__('admin/common.info_not_published')}}</p>
                                                                <form action="" novalidate>
                                                                    <div class="row">
                                                                        <div class="col-md-4 form-group">
                                                                            <input name="name" type="text" class="form-control" placeholder="{{__('admin/common.your_name_required')}}" value="@lang('admin/common.name_preview')">
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <input name="email" type="text" class="form-control" placeholder="{{__('admin/common.your_email')}}" value="@lang('admin/common.email_preview')">
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <input name="phone_number" type="tel" class="form-control" placeholder="{{__('admin/common.phone_number')}}" value="@lang('admin/common.email_preview')">
                                                                        </div>
                                                                    </div>
                                                                        <div class="row">
                                                                            <div class="col form-group">
                                                                                <textarea name="comment" class="form-control" placeholder="{{__('admin/common.your_comment_required')}}">@lang('admin/common.comment_preview')</textarea>
                                                                            </div>
                                                                        </div>
                                                                    <button type="submit" class="btn btn-primary" disabled>{{__('admin/blog/blog.comments')}}</button>
                                                                </form>
                                                            </div>
                                                        </div><!-- End blog comments -->
                                                    </div><!-- End blog entries list -->

                                                    <div class="col-lg-4">
                                                        <div class="sidebar">
                                                            <h3 class="sidebar-title">{{__('admin/common.search')}}</h3>
                                                            <div class="sidebar-item search-form">
                                                                <form action="">
                                                                    <input type="text">
                                                                    <button type="submit" disabled><i class="bi bi-search"></i></button>
                                                                </form>
                                                            </div><!-- End sidebar search formn-->
                                                            <h3 class="sidebar-title">{{__("admin/blog/blog.categories")}}</h3>
                                                            <div class="sidebar-item categories">
                                                                <ul>
                                                                    @foreach ($blog_categories as $blog_category)
                                                                        <li><a>{{$blog_category->category_name}}<span>({{ $blog_category->posts->count()}})</span></a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div><!-- End sidebar categories-->
                                                            <h3 class="sidebar-title">{{__("admin/blog/blog.recent_posts")}}</h3>
                                                            <div class="sidebar-item recent-posts">
                                                                <div class="post-item clearfix">
                                                                    <img src="{{asset('frontend/assets/img/blog/blog-recent-1.jpg')}}" alt="">
                                                                    <h4><a>{{__('admin/common.title_preview')}}</a></h4>
                                                                    <time>{{date('d-m-Y')}}</time>
                                                                </div>
                                                            </div><!-- End sidebar recent posts-->
                                                        </div><!-- End sidebar -->
                                                    </div><!-- End blog sidebar -->
                                                </div>
                                            </div>
                                        </section>
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
@include('admin.pages.sections.blog.blog_post_ckeditor5')
@endsection
