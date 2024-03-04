<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <!--Start Logo-->
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="{{asset('backend/assets/brand/coreui.svg#full')}}"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="{{asset('backend/assets/brand/coreui.svg#signet')}}"></use>
      </svg>
    </div>
    <!--End Logo-->

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <!--General Part-->
        <li class="nav-title">{{__('admin/sidebar.general')}}</li>
        <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">
            <svg class="nav-icon">
                <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
            </svg>{{__('admin/sidebar.dashboard')}}<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
        <!--End General Part-->

        <li class="nav-title">{{__('admin/sidebar.components')}}</li>
        <li class="nav-group {{request()->is('*admin*') ? 'show' : ''}}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use>
                </svg>{{__('admin/sidebar.home')}}</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link {{request()->is('*admin/hero*') ? 'active' : ''}}" href="{{route('admin.hero.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.hero-section')}}</a></li>
                <li class="nav-item"><a class="nav-link {{request()->is('*admin/about*') ? 'active' : ''}}" href="{{route('admin.about.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.about-section')}}</a></li>
                <li class="nav-group {{(request()->is('*admin/value_card*') || request()->is('*admin/value_title*')) ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.value-section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/value_title*') ? 'active' : ''}}" href="{{route('admin.value_title.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.value-title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/value_card*') ? 'active' : ''}}" href="{{route('admin.value_card.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.value-card')}}</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link {{request()->is('*admin/count*') ? 'active' : ''}}" href="{{route('admin.count.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.count')}}</a></li>
                <li class="nav-group {{(request()->is('*admin/feature_list*') || request()->is('*admin/feature_title*')) || request()->is('*admin/feature_icon_title*') ||request()->is('*admin/feature_tab_item*') || request()->is('*admin/feature_icon_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.feature_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_title*') ? 'active' : ''}}" href="{{route('admin.feature_title.index')}}"><span class="nav-icon"></span>{{__('admin/common.main_title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_list*') ? 'active' : ''}}" href="{{route('admin.feature_list.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.feature_list')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_tab_title*') ? 'active' : ''}}" href="{{route('admin.feature_tab_title.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.feature_tab_title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_tab_item*') ? 'active' : ''}}" href="{{route('admin.feature_tab_item.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.feature_tab_items')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_icon_title*') ? 'active' : ''}}" href="{{route('admin.feature_icon_title.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.feature_icon_title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/feature_icon_item*') ? 'active' : ''}}" href="{{route('admin.feature_icon_item.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.feature_icon_item')}}</a></li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/service_title*') || request()->is('*admin/service_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.service_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/service_title*') ? 'active' : ''}}" href="{{route('admin.service_title.index')}}"><span class="nav-icon"></span>{{__('admin/service/service.title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/service_item*') ? 'active' : ''}}" href="{{route('admin.service_item.index')}}"><span class="nav-icon"></span>{{__('admin/service/service.service_items')}}</a></li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/pricing_title*') || request()->is('*admin/pricing_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.pricing_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/pricing_title*') ? 'active' : ''}}" href="{{route('admin.pricing_title.index')}}"><span class="nav-icon"></span>{{__('admin/pricing/pricing.title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/pricing_item*') ? 'active' : ''}}" href="{{route('admin.pricing_item.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.pricing_items')}}</a></li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/faq_title*') || request()->is('*admin/faq_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.faq_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/faq_title*') ? 'active' : ''}}" href="{{route('admin.faq_title.index')}}"><span class="nav-icon"></span>{{__('admin/faq/faq.title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/faq_item*') ? 'active' : ''}}" href="{{route('admin.faq_item.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.faq_items')}}</a></li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/testimonial_title*') || request()->is('*admin/testimonial_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.testimonial_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/testimonial_title*') ? 'active' : ''}}" href="{{route('admin.testimonial_title.index')}}"><span class="nav-icon"></span>{{__('admin/testimonial/testimonial.title')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{request()->is('*admin/testimonial_item*') ? 'active' : ''}}" href="{{route('admin.testimonial_item.index')}}"><span class="nav-icon"></span>{{__('admin/sidebar.testimonial_items')}}</a></li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/team_title*') || request()->is('*admin/team_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.team_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*admin/team_title*') ? 'active' : ''}}" href="{{route('admin.team_title.index')}}">
                                <span class="nav-icon"></span>{{__('admin/team/team.title')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*admin/team_item*') ? 'active' : ''}}" href="{{route('admin.team_item.index')}}">
                                <span class="nav-icon"></span>{{__('admin/sidebar.team_items')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/client_title*') || request()->is('*admin/client_item*') ? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.client_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*admin/client_title*') ? 'active' : ''}}" href="{{route('admin.client_title.index')}}">
                                <span class="nav-icon"></span>{{__('admin/client/client.title')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*admin/client_item*') ? 'active' : ''}}" href="{{route('admin.client_item.index')}}">
                                <span class="nav-icon"></span>{{__('admin/sidebar.client_items')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-group {{request()->is('*admin/blog_title*')? 'show' : ''}}" aria-expanded="true"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    {{-- <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-home')}}"></use> --}}
                    </svg>{{__('admin/sidebar.blog_section')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*admin/blog_title*') ? 'active' : ''}}" href="{{route('admin.blog_title.index')}}">
                                <span class="nav-icon"></span>{{__('admin/blog/blog.blog_title')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-group {{request()->is('*blog*') ? 'show' : ''}}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-rss')}}"></use>
                </svg>{{__('admin/sidebar.blog_section')}}
            </a>
            <ul class="nav-group-items">
                <li class="nav-group {{request()->is('*blog/blog_category*') || request()->is('*blog/blog_post*') ? 'show' : ''}}" aria-expanded="true">
                    <a class="nav-link nav-group-toggle" href="#">{{__('admin/sidebar.post')}}</a>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*blog/blog_category*') ? 'active' : ''}}" href="{{route('blog.blog_category.index')}}">
                                <span class="nav-icon"></span>{{__('admin/sidebar.category')}}</a>
                        </li>
                    </ul>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('*blog/blog_post*') ? 'active' : ''}}" href="{{route('blog.blog_post.index')}}">
                                <span class="nav-icon"></span>{{__('admin/sidebar.blog_post')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-divider"></li>
    </ul>
</div>
