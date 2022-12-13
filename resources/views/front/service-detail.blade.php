@extends('front.layout')

@section('meta')
<title>Sales App | Product Details</title>
<meta name="author" content="Sales App">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')

@endsection

@section('main')

<section class="page-title page-title-1" id="page-title">
    <div class="page-title-wrap bg-overlay bg-overlay-dark-3">
      <div class="bg-section"><img src="/assets/images/page-titles/2.jpg" alt="Background"/></div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="title">
              <h1 class="title-heading">@if(@$child_menu_id->name) {{ @$child_menu_id->name }} @elseif(@$sub_menu_id->name) {{ @$sub_menu_id->name }} @else {{ @$parent_menu_id->name }} @endif</h1>
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
          <li class="breadcrumb-item active" aria-current="page">{{ @$parent_menu_id->name }}</li>
        </ol>
        <!-- End .row-->
      </div>
    </div>
    <!-- End .container-->
  </section>
  <!-- End #page-title -->

    <section class="features features-1 bg-overlay bg-overlay-theme2" id="features-1">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="heading heading-18">
            <h2 class="heading-title  text-center">{{ @$dynamic_contents->excerpt }}</h2>

            <div class="carousel owl-carousel carousel-dots" data-slide="4" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="true" data-space="25" data-loop="true" data-speed="800">
                @foreach (@$services as $service)
                <div>
                    <div class="feature-panel-holder" data-hover="">
                      <div class="feature-panel">
                        <div class="feature-icon"><img src="{{ @$service->icon }}" alt="icon"/></div>
                        <div class="feature-content">
                          <h4>{{ @$service->title }}</h4>
                          <p>{{ @$service->excerpt }}</p>
                        </div><a href="{{ route('dynamicpage',[@$parent_menu_id->slug,@$service->slug]) }}"><i class="energia-arrow-right"></i> <span>explore more</span> </a>
                      </div>
                      <!-- End .feature-panel-->
                    </div>
                  </div>
                @endforeach

              </div>

          </div>
        </div>
      </div>
      <!-- End .row-->
    </div>
    <div class="container">
      <div class="more-faqs">
        {{-- <p>Sustainable, reliable & affordable energy systems, <a href="/{{@$parent_menu_id->slug}}">find your solutions now! </a></p> --}}
      </div>
    </div>
    <!-- End .container-->
  </section>

  @endsection

  @section('script')

  @endsection

