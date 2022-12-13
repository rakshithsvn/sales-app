@extends('front.layout')

@section('meta')
<title>Sales App | Thank You</title>
<meta name="author" content="Sales App">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')

@endsection

@section('main')

{{-- <section class="page-title page-title-1" id="page-title">
    <div class="page-title-wrap bg-overlay bg-overlay-dark-3">
      <div class="bg-section"><img src="/assets/images/page-titles/2.jpg" alt="Background"/></div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="title">
              <h1 class="title-heading">Thank You</h1>
              <p class="title-desc">{{ @$dynamic_contents->excerpt }}</p>
              <div class="title-action"> <a class="btn btn--bordered btn--white" href="{{ route('contact-us') }}"> <span>Contact Us</span><i class="energia-arrow-right"></i></a>
                <a class="btn-video btn-video-2 popup-video" href="https://www.youtube.com/watch?v=nrJtHemSPW4"> <i class="fas fa-play"></i></a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="breadcrumb-wrap">
      <div class="container">
        <ol class="breadcrumb d-flex">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thank You</li>
        </ol>
        <!-- End .row-->
      </div>
    </div>
    <!-- End .container-->
  </section>
  <!-- End #page-title --> --}}

  <section class="faqs faqs-2" id="faqs-1">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="heading heading-18">
            <h2 class="heading-title  text-center">Thank You</h2>
            <p>Thank you for contacting us. We at Sales App, your professional partner for asset tracking and fleet management will be glad to serve you.</p>
            <p>Our sales team has just recorded your inquiry in our CRM and one of us will be in in touch with you soon.</p>
            <p>Thank you again for contacting Sales App Sales.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection
