@extends('frontend.layout.layout')

@section('content')
<!-- ======= Hero Section ======= -->
@include('frontend.pages.home.sections.main.hero')
<!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    @include('frontend.pages.home.sections.main.about')
    <!-- End About Section -->

    <!-- ======= Values Section ======= -->
    @include('frontend.pages.home.sections.extras.values')
    <!-- End Values Section -->

    <!-- ======= Counts Section ======= -->
    @include('frontend.pages.home.sections.extras.counts')
    <!-- End Counts Section -->

    <!-- ======= Features Section ======= -->
    @include('frontend.pages.home.sections.extras.features')
    <!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    @include('frontend.pages.home.sections.main.services')
    <!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    @include('frontend.pages.home.sections.extras.pricing')
    <!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    @include('frontend.pages.home.sections.extras.faq')
    <!-- End F.A.Q Section -->

    <!-- ======= Portfolio Section ======= -->
    @include('frontend.pages.home.sections.main.portfolio')
    <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    @include('frontend.pages.home.sections.extras.testimonials')
    <!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    @include('frontend.pages.home.sections.main.team')
    <!-- End Team Section -->

    <!-- ======= Clients Section ======= -->
    @include('frontend.pages.home.sections.extras.clients')
    <!-- End Clients Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    @include('frontend.pages.home.sections.extras.recent-blog-post')
    <!-- End Recent Blog Posts Section -->

    <!-- ======= Contact Section ======= -->
    @include('frontend.pages.home.sections.main.contact')
    <!-- End Contact Section -->

  </main><!-- End #main -->
@endsection
