<div class="container-fluid border-bottom px-4">
    <button class="header-toggler" type="button"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
            <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-menu') }}">
            </use>
        </svg>
    </button>
    <ul class="header-nav d-none d-md-flex">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('admin-header.dashboard') }}</a>
        </li>
    </ul>
    <ul class="header-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{route('admin.contact_message.index')}}">
            <svg class="icon icon-lg">
                <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-open')}}"></use>
            </svg></a>
        </li>
    </ul>
    <ul class="header-nav">
        <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
        </li>
        <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
              <svg class="icon icon-lg theme-icon-active">
                <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-sun')}}"></use>
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
              <li>
                <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-theme-value="light">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-sun')}}"></use>
                  </svg>Light
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-moon')}}"></use>
                  </svg>Dark
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="auto">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-contrast')}}"></use>
                  </svg>Auto
                </button>
              </li>
            </ul>
          </li>
        <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
        </li>
        <!--Language dropdown-->
        <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
                aria-expanded="false" data-coreui-toggle="dropdown">
                <svg class="icon icon-lg theme-icon-active">
                    <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-language') }}">
                    </use>
                </svg>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" style="pointer-events: {{ app()->getLocale() == 'vi' ? 'none' : 'auto' }}"
                        href="{{ route('change-language', 'vi') }}">{{ __('admin/common.vietnamese') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" style="pointer-events: {{ app()->getLocale() == 'en' ? 'none' : 'auto' }}"
                        href="{{ route('change-language', 'en') }}">{{ __('admin/common.english') }}
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
        </li>
        <!--Profile dropdown-->
        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img"
                        src="{{ asset('backend/assets/img/avatars/8.jpg') }}" alt="user@email.com"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">
                    <div class="fw-semibold">Account</div>
                </div>
                <a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-bell') }}">
                        </use>
                    </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a>
                <a href="{{ route('admin.contact_message.index') }}" class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use
                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}">
                    </use>
                </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a>
                <a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-tas') }}k">
                    </use>
                </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a>
                <a class="dropdown-item" href="#">
                <svg class="icon me-2">
                    <use
                        xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}">
                    </use>
                </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                    <div class="fw-semibold">Settings</div>
                </div><a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                        </use>
                    </svg> Profile</a><a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                        <use
                            xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-settings') }}">
                        </use>
                    </svg> Settings</a><a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                        <use
                            xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-credit-card') }}">
                        </use>
                    </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item"
                    href="#">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-file') }}">
                        </use>
                    </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault();this.closest('form').submit();">
                        <svg class="icon me-2">
                            <use
                                xlink:href="{{ asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                            </use>
                        </svg>
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</div>
