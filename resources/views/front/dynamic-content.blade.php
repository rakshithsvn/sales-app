@extends('front.layout')

@section('meta')

@section('title', ucwords(strtolower((@$dynamic_contents['seo_title']))))
<meta name="author" content="Sales App">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')

@endsection

@section('main')

@if($parent_menu_id->slug !== 'member-login')
<section class="page-title page-title-1" id="page-title">
    <div class="page-title-wrap bg-overlay bg-overlay-dark-3">
      <div class="bg-section"></div>
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
          <li class="breadcrumb-item active" aria-current="page"><a href="/{{@$parent_menu_id->slug}}">{{ @$parent_menu_id->name }}</a></li>
          @if(@$sub_menu_id->name)
          <li class="breadcrumb-item active" aria-current="page"><a href="/{{@$parent_menu_id->slug}}/{{@$sub_menu_id->slug}}">{{ @$sub_menu_id->name }}</a></li>
          @endif
          @if(@$child_menu_id->name)
          <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ @$child_menu_id->name }}</a></li>
          @endif
        </ol>
        <!-- End .row-->
      </div>
    </div>
    <!-- End .container-->
  </section>
  <!-- End #page-title -->
  @endif

@if($parent_menu_id->layout_name == 'ABOUT')

  <!--
  ============================
  About #1 Section
  ============================
  -->
  <section class="about about-1" id="about-1">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-7">
          <div class="heading heading-1">
            {{-- <h2 class="heading-title">Welcome to Sales App!</h2>
            <p class="heading-subtitle heading-subtitle-bg">Building a better fleet begins here!</p> --}}
          </div>
          <div class="about-block">
            <div class="row">
              <div class="col-12 col-lg-11">
                <div class="block-left">
                {!! removeExtraChar(@$dynamic_contents->body) !!}
                <p>We help you connect to everything from trucks, drivers, freight, permanent assets, and everything above.</p>
                </div>
              </div>
              <div class="col-12 col-lg-5">
                <div class="block-right">
                  <div class="prief-set">

                    {{-- <ul class="list-unstyled advantages-list">
                        <li>50% reduction in accident rates</li>
                        <li>30% increase in fuel efficiency</li>
                        <li>10% increase in driver efficiency</li>
                    </ul> --}}
                  </div>
                </div>
              </div>

        </div>
        <!-- End .col-lg-6-->
      </div>
    </div>
    <div class="col-12 col-lg-5">
        <div class="about-img">
            <div class="about-img-holder bg-overlay" style="background-position: 100% 27%">
            <div class="bg-section"><img src="{{ @$dynamic_contents->image }}" alt="about Image"/></div>
            </div>
            <div>
            <!-- Start .counter-->
            <div class="counter" style="width: 50%">
                {{-- <div class="counter-icon"> <i class="far fa-smile"></i></div>
                <div class="counter-num"> <span class="counting" data-counterup-nums="954">954</span>
                <p></p>
                </div> --}}
                <div class="counter-name" style="text-align: center;">
                <h6 style="font-weight: 900 !important; color: #4dc247 !important;">Our fleet solutions are tailored to meet your business needs</h6>
                </div>
            </div>
            <!-- End .counter-->
            </div>
        </div>
        </div>
        <div class="col-12">
            <div class="block-left">
            {!! removeExtraChar(@$dynamic_contents->body1) !!}
            {{-- <a class="btn btn--secondary" href="#">read more <i class="energia-arrow-right"></i></a> --}}
        </div>
      </div>
      </div>

      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section>
  <!--
  ============================
  Features #1 Section
  ============================
  -->
  <section class="features features-1 bg-overlay bg-overlay-theme2" id="features-1">
        <div class="bg-section"> <img src="assets/images/background/2.jpg" alt="Background"/></div>
        <div class="container">
          <div class="heading heading-2 heading-light heading-light2">
            <div class="row">
              <div class="col-12 col-lg-5">
                <p class="heading-subtitle">GPS trackers that are affordable, sustainable, and reliable</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-5">
                <h2 class="heading-title">It is now possible for you to choose a tracking platform that allows you to track exactly what you
                    want when you want, and how you want.</h2>
              </div>
              <div class="col-12 col-lg-6 offset-lg-1">
                <p class="heading-desc">Experts in combining analytics, corporate strategy, digitalization, and years of experience to
                    predict the future of the fleet, We provide comprehensive logistics and fleet management
                    solutions to improve efficiency, security, and cost reduction.</p>
                    <p class="heading-desc"> Allow us to be your resource in the expansion of your business to new highs while we show you
                        how far a unique fleet program can lead your organization while saving you money!</p>
                   </p>
                <div class="actions-holder">
                    <a class="btn btn--bordered btn--white mb-3" href="{{ route('dynamicpage',['about-us']) }}">get started<i class="energia-arrow-right"></i></a>
                    <a class="btn btn--bordered btn--white mb-3" href="/services">explore more</a>
                </div>
              </div>
            </div>
            <!-- End .row-->
          </div>
          <!-- End .heading-->
          <div class="carousel owl-carousel carousel-dots" data-slide="4" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="true" data-space="25" data-loop="true" data-speed="800">
            @foreach (@$services as $service)
            <div>
                <div class="feature-panel-holder" data-hover="">
                  <div class="feature-panel">
                    <div class="feature-icon"><img src="{{ @$service->icon }}" alt="icon"/></div>
                    <div class="feature-content">
                      <h4>{{ @$service->title }}</h4>
                      <p>{{ \Illuminate\Support\Str::limit(@$service->excerpt, 100) }}</p>
                    </div><a href="{{ route('dynamicpage',['services',@$service->slug]) }}"><i class="energia-arrow-right"></i> <span>explore more</span> </a>
                  </div>
                  <!-- End .feature-panel-->
                </div>
              </div>
            @endforeach

          </div>
          <!-- End .carousel-->
          <div class="row">
            <div class="col-12 col-lg-4">
              <div class="more-features">
                <p>We have the best solution for tracking fuel consumption, fleet tracking in real-time, analyzing
                    driving behavior, and recovering from theft in real-time.</p>
                    <p>Don't settle for anything less than the best for your fleets. </p>
                    <a class="btn btn--bordered btn--white" href="{{ route('contact-us') }}">contact us<i class="energia-arrow-right"></i></a><br/>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <!--
              ============================
              Video #1 Section
              ============================
              -->
              <div class="video video-1 bg-overlay bg-overlay-video" id="video-1">
                <div class="bg-section"><img src="assets/images/video/1.jpg" alt="background"/></div><a class="popup-video btn-video" href="https://www.youtube.com/watch?v=nrJtHemSPW4"> <i class="fas fa-play"></i><span>watch our video!</span></a>
                <!-- End .popup-video-->
              </div>
            </div>
          </div>
          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
      <!--
      ============================
      services #1 Section
      ============================
      -->
      <section class="services services-1 bg-grey" id="services-1">
        <div class="container">
          <div class="heading heading-3 text-center">
            <div class="row">
              <div class="col-12 col-lg-10 offset-lg-1">
                <p class="heading-subtitle">Our GPS Tracking System lets you see your fleet's daily operations in real-time, so you can
                    reduce costs, improve productivity, Keep your vehicle well-maintained, and maximize every
                    business day.</p>
                <h2 class="heading-title">We can help you discover hidden costs so that you can increase productivity and efficiency. Our
                    GPS fleet tracking software helps you see what you have and how it is being used</h2>
              </div>
              <!-- End .col-lg-6-->
            </div>
            <!-- End .row-->
          </div>
          <!-- End .heading-->
          <div class="carousel owl-carousel carousel-dots dots-side" data-slide="3" data-slide-rs="1" data-autoplay="true" data-nav="false" data-dots="true" data-space="30" data-loop="true" data-speed="400">
            @foreach (@$products as $product)
            <div>
              <div class="service-panel">
                <div class="service-icon"><img src="{{ @$product->icon }}" alt="icon"/></div>
                <div class="service-content">
                  <h4><a href="{{ route('dynamicpage',['products',@$product->slug]) }}">{{ @$product->title }}</a></h4>
                  <p>{{ \Illuminate\Support\Str::limit(@$product->excerpt, 100) }}</p>
                  {{-- <ul class="list-unstyled advantages-list">
                    <li>cleaning of inverter</li>
                    <li>perform shading tests</li>
                    <li>90 days repairs warranty</li>
                  </ul> --}}
                  <a class="btn btn--primary" href="{{ route('dynamicpage',['products',@$product->slug]) }}">read more <i class="energia-arrow-right"></i></a>
                </div>
              </div>
              <!-- End .service-panel-->
            </div>
            @endforeach

          </div>
          <!-- End .carousel-->
          <div class="more-services">
            <p>GPS Trackers That Are Affordable, Sustainable, And Reliable, <a href="/products">Find Your Solution Now! </a></p>
          </div>
          <!-- End more-services-->
        </div>
        <!-- End .container-->
      </section>
  <!--
  ============================
  Clients #1 Section
  ============================
  -->
  {{-- <section class="clients clients-carousel clients-1" id="clients-1">
    <div class="container">
      <div class="row">
        <div class="col">
          <h3 class="d-none">Our Clients</h3>
        </div>
        <div class="col-12">
          <div class="carousel owl-carousel" data-slide="6" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="false" data-space="0" data-loop="true" data-speed="3000">
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/1.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/2.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/3.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/4.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/5.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/6.png" alt="client"/></div>
          </div>
        </div>
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section> --}}
  <!--
  ============================
  Contact #1 Section
  ============================
  -->
  <!--
  ============================
  Blog #1 Section
  ============================
  -->
  <section class="blog blog-1 blog-grid" id="blog-1">
    <div class="container">
      <div class="row">
        @foreach($recent_news as $news)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="blog-entry" data-hover="">
            <div class="entry-content">
                <div class="entry-meta">
                    <div class="entry-date">
                        <span class="day"><i class="fa fa-calendar"></i> {{ @$news->event_date->format('d M, Y') }}</span>
                    </div>
                    {{-- <div class="entry-author">
                      <p>{{ @$news->users->name }}</p>
                    </div> --}}
                    <div class="entry-date">
                        <span class="day"><i class="fa fa-clock"></i> {{ @$news->time }} min read</span>
                    </div>
                  </div>
              <div class="entry-title">
                <h4><a href="{{ route('blog',['news_slug'=>$news->slug]) }}">{{ Str::limit($news->title,100) }}</a></h4>
              </div>
              <div class="entry-img-wrap">
                <div class="entry-img"><a href="{{ route('blog',['news_slug'=>$news->slug]) }}"><img src="{{ @$news->image }}" alt="news thumb"/></a></div>
                @if(@$news->category->title)
                <div class="entry-category"><a href="{{ route('blog-filter',[$news->category_id]) }}">{{ @$news->category->title }}</a></div>
                @endif
              </div>
              <!-- End .entry-img-->
              <div class="entry-bio">
                {{-- <p>All of these factors are important consider when permitting your solar system, and can help streamline your process. Take time to consider these...</p> --}}
              </div>
              <div class="entry-more"> <a class="btn btn--white btn-bordered" href="{{ route('blog',['news_slug'=>$news->slug]) }}">read more </a></div>
            </div>
          </div>
          <!-- End .entry-content-->
        </div>
        @endforeach
      </div>
      <div class="row">
        <div class="col-12">
          <div class="more-blog"><a href="{{ route('blogs') }}">find out more about our news!</a></div>
        </div>
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section>

@elseif($parent_menu_id->layout_name == 'SERVICES')

<section class="faqs faqs-2" id="faqs-1">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="heading heading-18">
            <h2 class="heading-title  text-center">{{ @$dynamic_contents->excerpt }}</h2>
            {!! removeExtraChar(@$dynamic_contents->body) !!}
          </div>
        </div>
      </div>
@if(@$post_tabs)
      <div class="accordion accordion-2" id="accordion03">
        <div class="row">
@foreach (@$post_tabs as $key=>$tab)

          <div class="col-12 col-lg-6">

            <div>
              <div class="card active-acc">
                <div class="card-heading"><a class="card-link  " data-hover="" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{ @$key }}" href="#collapse{{ @$key }}">{{ @$tab->$tab_title }}</a></div>
                <div class="collapse show" id="collapse{{ @$key }}" data-bs-parent="#accordion03">
                  <div class="card-body">
                    {!! removeExtraChar(@$tab->tab_body) !!}
                  </div>
                </div>
              </div>
            </div>

          </div>

@endforeach
        </div>
      </div>
      @endif
      <!-- End .row-->
    </div>
    <div class="container">
      <div class="more-faqs">
        <p>Sustainable, reliable & affordable energy systems, <a href="{{ route('service-detail') }}">find your solutions now! </a></p>
      </div>
    </div>
    <!-- End .container-->
  </section>

@elseif($parent_menu_id->layout_name == 'PRODUCTS')

<section class="service-single" id="service-single">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-4 order-1">
          <!--
          ============================
          Services Sidebar
          ============================
          -->
          <div class="sidebar sidebar-service">
            <!-- Services-->
            @if(@$product_list)
            <div class="widget widget-services">
              <div class="widget-title">
                <h5>Our Products</h5>
              </div>
              <div class="widget-content">
                <ul class="list-unstyled">
                    {{-- @foreach(@$sub_menu_id->childmenus as $child_menu)
                    <li><a href="{{ route('home') }}"> <span>{{ @$child_menu->name }}</span><i class="energia-arrow-right"></i></a></li>
                    @endforeach --}}

                    @foreach(@$product_list as $product)
                    <li><a href="{{ route('dynamicpage',[@$parent_menu_id->slug,@$sub_menu_id->slug,@$product->slug ]) }}"> <span>{{ @$product->title }}</span><i class="energia-arrow-right"></i></a></li>
                    @endforeach

                </ul>
              </div>
            </div>
            @endif
            <!-- End .widget-services -->
            <!-- Reservation-->
            <div class="widget widget-reservation"><img src="/assets/images/blog/sidebar/reservation.jpg" alt="img"/>
              <div class="widget-content"><i class="flaticon-040-green-energy"></i>
                <p>Please feel welcome to contact our friendly reception staff with any general or medical enquiry call us</p><a class="btn btn--bordered btn--white" href="{{ route('contact-us') }}">schedule an appointment</a><a href="tel:+971 55 6751770"><span class="energia-phone-Icon"></span> +971 55 6751770</a>
              </div>
            </div>
            <!-- End .widget-reservation-->
            <!-- Download-->
            {{-- <div class="widget widget-download">
              <div class="widget-title">
                <h5>download brochure</h5>
              </div>
              <div class="widget-content">
                <ul class="list-unstyled">
                  <li><a href="javascript:void(0)"> <span>company report 2022</span>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18">
                        <g>
                          <g>
                            <g>
                              <path class="shp0" d="M2.12 2L2.93 1L14.93 1L15.87 2L2.12 2ZM9 14.5L3.5 9L7 9L7 7L11 7L11 9L14.5 9L9 14.5ZM17.54 2.23L16.15 0.55C15.88 0.21 15.47 0 15 0L3 0C2.53 0 2.12 0.21 1.84 0.55L0.46 2.23C0.17 2.57 0 3.02 0 3.5L0 16C0 17.1 0.9 18 2 18L16 18C17.1 18 18 17.1 18 16L18 3.5C18 3.02 17.83 2.57 17.54 2.23Z"></path>
                            </g>
                          </g>
                        </g>
                      </svg></a></li>
                  <li class="inversed"><a href="javascript:void(0)"> <span>company brochure</span>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18">
                        <g>
                          <g>
                            <g>
                              <path class="shp0" d="M2.12 2L2.93 1L14.93 1L15.87 2L2.12 2ZM9 14.5L3.5 9L7 9L7 7L11 7L11 9L14.5 9L9 14.5ZM17.54 2.23L16.15 0.55C15.88 0.21 15.47 0 15 0L3 0C2.53 0 2.12 0.21 1.84 0.55L0.46 2.23C0.17 2.57 0 3.02 0 3.5L0 16C0 17.1 0.9 18 2 18L16 18C17.1 18 18 17.1 18 16L18 3.5C18 3.02 17.83 2.57 17.54 2.23Z"></path>
                            </g>
                          </g>
                        </g>
                      </svg></a></li>
                </ul>
              </div>
            </div> --}}
            <!-- End .widget-download-->
          </div>
          <!-- End .sidebar-->
        </div>
        <div class="col-12 col-lg-8 order-0 order-lg-2">
          <!-- Start .service-entry-->
          <div class="service-entry">
            <div class="entry-content">
              <div class="entry-introduction entry-infos">
                <h5 class="entry-heading">@if(@$child_menu_id->name) {{ @$child_menu_id->name }} @else overview @endif</h5>
                {!! removeExtraChar(@$dynamic_contents->body) !!}
                {{-- <div class="row">
                  <div class="col-12 col-md-6"><img src="/assets/images/services/single/1.jpg" alt="image"/></div>
                  <div class="col-12 col-md-6"><img src="/assets/images/services/single/2.jpg" alt="image"/></div>
                </div> --}}
              </div>
              {{-- <div class="entry-stats entry-infos">
                <h5 class="entry-heading">stats &amp; charts </h5>
                <div class="row">
                  <div class="col-12 col-lg-6">
                    <p class="entry-desc">Our mix of company-owned and contractor assets allows us to retain optimal levels of control whilst expanding our reach to over 96% of towns in Australia. With 40 years of LTL experience, we are now a trusted LTL freight provider for shippers of all sizes and commodity types.</p>
                    <p class="entry-desc">
                       Our LTL service extends to all states and territories, and includes multiple per-week services to places many others only serve occasionally, including Darwin, Alice Springs, Newman, Mt. Isa, Launceston and Burnie.</p>
                    <p class="entry-desc">
                       We pride ourselves on providing the best transport and shipping services currently available in Australia. Our skilled personnel, utilising the latest communications, tracking and processing software, combined with decades of experience, ensure all freight is are shipped, trans-shipped and delivered as safely as possible.</p>
                  </div>
                  <div class="col-12 col-lg-6"> <img class="entry-chart" src="/assets/images/charts/chart-1.png" alt="Chart image"/></div>
                </div>
              </div> --}}

              <div class="entry-video entry-infos">
                {{-- <h5 class="entry-heading">how it works?!</h5>
                <p class="entry-desc">It has been argued that expanding use of wind power will lead to increasing geopolitical competition over critical materials for wind turbines such as rare earth elements neodymium, praseodymium, and dysprosium. But this perspective has been criticised for failing to recognise that most wind turbines.</p> --}}
                <!--
                ============================
                Video #3 Section
                ============================
                -->
                {{-- <div class="video video-3" id="video-3">
                  <div class="bg-section"><img src="/assets/images/video/3.jpg" alt="background"/></div><a class="popup-video btn-video btn-video-2" href="https://www.youtube.com/watch?v=nrJtHemSPW4"> <i class="fas fa-play"></i></a>
                  <!-- End .popup-video-->
                </div> --}}
                <!-- End .video-->
              </div>

              @if(@$post_tabs)
              <div class="entry-benefits entry-infos">
                <h5 class="entry-heading">key benefits</h5>
                <div class="accordion accordion-2" id="accordion03">
                  <div class="row">
                    @foreach(@$post_tabs as $key=>$tab)
                    <div class="col-12">
                      <div class="card">
                        <div class="card-heading"><a class="card-link collapsed" data-hover="" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse01-{{$key}}" href="#collapse01-{{$key}}">{{ @$tab->tab_title }}</a></div>
                        <div class="collapse" id="collapse01-{{$key}}" data-bs-parent="#accordion03">
                          <div class="card-body">{!! removeExtraChar(@$tab->tab_body) !!}</div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
          <!-- End .service-entry-->
        </div>
        <!-- End .col-lg-8-->
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section>
  <!--
  ============================
  Clients #1 Section
  ============================
  -->
  {{-- <section class="clients clients-carousel clients-1" id="clients-1">
    <div class="container">
      <div class="row">
        <div class="col">
          <h3 class="d-none">Our Clients</h3>
        </div>
        <div class="col-12">
          <div class="carousel owl-carousel" data-slide="6" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="false" data-space="0" data-loop="true" data-speed="3000">
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/1.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/2.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/3.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/4.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/5.png" alt="client"/></div>
            <div class="client"><a href="javascript:void(0)"> </a><img src="/assets/images/clients/6.png" alt="client"/></div>
          </div>
        </div>
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section> --}}

@else

<section class="faqs faqs-2" id="faqs-1">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="heading heading-18">
            <h2 class="heading-title  text-center">{{ @$dynamic_contents->excerpt }}</h2>
            {!! removeExtraChar(@$dynamic_contents->body) !!}
          </div>
        </div>
      </div>
        @if(@$post_tabs)
      <div class="accordion accordion-2" id="accordion03">
        <div class="row">
        @foreach (@$post_tabs as $key=>$tab)

          <div class="col-12 col-lg-6">

            <div>
              <div class="card active-acc">
                <div class="card-heading"><a class="card-link  " data-hover="" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{ @$key }}" href="#collapse{{ @$key }}">{{ @$tab->$tab_title }}</a></div>
                <div class="collapse show" id="collapse{{ @$key }}" data-bs-parent="#accordion03">
                  <div class="card-body">
                    {!! removeExtraChar(@$tab->tab_body) !!}
                  </div>
                </div>
              </div>
            </div>

          </div>

        @endforeach
        </div>
      </div>
      @endif
      <!-- End .row-->
    </div>
    <div class="container">
      <div class="more-faqs">
        <p>Sustainable, reliable & affordable energy systems, <a href="{{ route('service-detail') }}">find your solutions now! </a></p>
      </div>
    </div>
    <!-- End .container-->
  </section>

@endif

@endsection

@section('script')

@endsection
