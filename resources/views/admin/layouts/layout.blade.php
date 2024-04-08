<!DOCTYPE html>
<html lang="vi">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin Portfolio</title>

    <!-- Image sources -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('backend/assets/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('backend/assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('backend/assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('backend/assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend/assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('backend/assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('backend/assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('backend/assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('backend/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('backend/assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('backend/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('backend/assets/favicon/manifest.json') }}">

    <!--CKEditor css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/ckeditor5/css/content-styles.css') }}" type="text/css">

    <!-- Main styles for this application-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('backend/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors/simplebar.css') }}">

    <!-- Google Material Icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- This is style for datatable but it'll override main styles below if you move this line below main styles-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Frontend style for preview-->
    @include('frontend.layout.style')

    <!-- Main styles for this application-->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
    <script src="{{ asset('backend/assets/js/color-modes.js') }}"></script>
    <link href="{{ asset('backend/assets/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">


</head>

<body>
    <!--Start Sidebar-->
    @include('admin.layouts.sidebar')
    <!--End Sidebar-->

    <!--Start Main Part-->
    <div class="wrapper d-flex flex-column min-vh-100">

        <!--Start Body-->
        @yield('content')
        <!--End Body-->

        <!--Start Footer-->
        <footer class="footer footer-sticky mt-4 d-flex flex-col flex-lg-row justify-center">
            <div><a href="https://coreui.io">CoreUI </a>
                <a href="https://coreui.io">Bootstrap Admin Template</a> ©2023 creativeLabs.</div>
            <div class="ms-lg-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
        </footer>
        <!--End Footer-->
    </div>
    <!--End Main Part-->

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('backend/assets/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/simplebar/js/simplebar.min.js') }}"></script>

    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('backend/assets/vendors/chart.js/js/chart.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/@coreui/utils/js/index.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <!--Externail JS libraries-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

    <!--CKEDITOR-->
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>

    <!--Fronted script for preview-->
    @include('frontend.layout.script')

    <script>
        new PureCounter({
            once: false
        });
    </script>

    <!-- My functions -->
    <script src="{{ asset('functions/functions.js') }}"></script>


    <!-- Sweet Alert 2-->
    <script>
        $(document).ready(function() {
            $('body').on('click', '.delete-btn', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                Swal.fire({
                    title: '@lang('admin/common.are_you_sure')',
                    text: '@lang('admin/common.cant_reverted')',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: '@lang('admin/common.yes_delete_it')',
                    cancelButtonText: '@lang('admin/common.cancel')'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: deleteUrl,
                            success: function(data, status, xhr) {
                                if (status == 'success') {
                                    Swal.fire(
                                        '@lang('admin/common.swal_deleted')',
                                        '',
                                        'success'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    })
                                } else if (status == 'error') {
                                    Swal.fire(
                                        '@lang('admin/common.swal_delete_failed')',
                                        '',
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr);
                                console.log(error);
                            },
                        })
                    }
                })
            });
        })
    </script>

    <script>
        new Swiper('.testimonials-slider', {
            speed: 600,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            slidesPerView: 'auto',
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 40
                },

                1200: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

    <script>
        new Swiper('.clients-slider', {
            speed: 400,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            slidesPerView: 'auto',
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 40
                },
                480: {
                    slidesPerView: 3,
                    spaceBetween: 60
                },
                640: {
                    slidesPerView: 4,
                    spaceBetween: 80
                },
                992: {
                    slidesPerView: 6,
                    spaceBetween: 120,
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
