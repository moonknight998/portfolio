<header id="header" class="header fixed-top" style="{{Route::currentRouteName() === 'home' ? '' : 'background-color: white;'}}">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{route('home')}}" class="logo d-flex align-items-center">
            <img src="{{asset('frontend/assets/img/logo.png')}}" alt="">
            <span>CompanyName</span>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{Route::currentRouteName() === 'home' ? '#hero' : route('home')}}">{{__('frontend/header.home')}}</a></li>
                <li><a class="nav-link scrollto" href="{{Route::currentRouteName() === 'home' ? '#about' : route('home').'#about'}}">{{__('frontend/header.about')}}</a></li>
                <li><a class="nav-link scrollto" href="{{Route::currentRouteName() === 'home' ? '#services' : route('home').'#services'}}">{{__('frontend/header.services')}}</a></li>
                <li><a class="nav-link scrollto" href="{{Route::currentRouteName() === 'home' ? '#portfolio' : route('home').'#portfolio'}}">{{__('frontend/header.portfolio')}}</a></li>
                <li><a class="nav-link scrollto" href="{{Route::currentRouteName() === 'home' ? '#team' : route('home').'#team'}}">{{__('frontend/header.team')}}</a></li>
                <li class="dropdown"><a href="#recent-blog-posts"><span>Blog</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                    <li><a href="{{Route::currentRouteName() === 'home' ? '#recent-blog-posts' : route('home').'#recent-blog-posts'}}">@lang('admin/blog/blog.recent_posts')</a></li>
                    <li><a href="{{Route::currentRouteName() === 'blogs' ? '#' : route('blogs')}}">@lang('admin/common.all_post')</a></li>
                    </ul>
                </li>

                {{-- <li class="dropdown megamenu"><a href="#"><span>Mega Menu</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                    <li>
                        <a href="#">Column 1 link 1</a>
                        <a href="#">Column 1 link 2</a>
                        <a href="#">Column 1 link 3</a>
                    </li>
                    <li>
                        <a href="#">Column 2 link 1</a>
                        <a href="#">Column 2 link 2</a>
                        <a href="#">Column 3 link 3</a>
                    </li>
                    <li>
                        <a href="#">Column 3 link 1</a>
                        <a href="#">Column 3 link 2</a>
                        <a href="#">Column 3 link 3</a>
                    </li>
                    <li>
                        <a href="#">Column 4 link 1</a>
                        <a href="#">Column 4 link 2</a>
                        <a href="#">Column 4 link 3</a>
                    </li>
                    </ul>
                </li> --}}

            <li><a class="nav-link scrollto" href="{{Route::currentRouteName() === 'home' ? '#contact' : route('home').'#contact'}}">{{__('frontend/header.contact')}}</a></li>
            <li><a class="getstarted scrollto" href="{{Route::currentRouteName() === 'home' ? '#about' : route('home').'#about'}}">{{__('admin/common.get_started')}}</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
  </header>
