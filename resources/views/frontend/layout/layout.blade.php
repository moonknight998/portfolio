<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Laravel Portfolio Web Application</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{asset('frontend/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/> --}}

    <!-- Template Main CSS File -->
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: FlexStart
    * Updated: Sep 18 2023 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    @include('frontend.layout.header')
    <!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    @include('frontend.layout.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>

    <!-- Custom JS File -->
    <script src="{{asset('functions/functions.js')}}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    AOS.init();
    </script>

</body>

</html>
