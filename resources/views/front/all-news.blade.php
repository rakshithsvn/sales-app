@extends('front.layout')

@section('meta')
<title>Sales App | @if(@$sub_menu_id->slug == 'blogs') Blogs @else Case Studies @endif</title>
<meta name="author" content="Sales App">
<meta name="description" content="Sales App fleet tracking blog gives you personal insights on fleet tracking including fleet safety, fuel monitoring, driver safety, GPS tracking, asset tracking, and dashcam technology.">
<meta name="keywords" content="GPS Vehicle Tracking, Vehicle Tracking System, Temperature Monitoring, Fuel Monitoring, Temperature Management, ADAS System, DMS, Fleet Management Software, Fleet Monitoring Service, UAE, DUBAI">

@endsection

@section('css')

@endsection

@section('main')

<section class="page-title page-title-13" id="page-title">
    <div class="page-title-wrap bg-overlay bg-overlay-dark-3">
      <div class="bg-section"><img src="assets/images/page-titles/13.jpg" alt="Background"/></div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 offset-lg-3">
            <div class="title text-center">
              <h1 class="title-heading">@if(@$sub_menu_id->slug == 'blogs') Our Blogs @else Case Studies @endif</h1>
              <ol class="breadcrumb breadcrumb-light d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(@$sub_menu_id->slug == 'blogs') Blogs @else Case Studies @endif</li>
              </ol>
              <!-- End .breadcrumb-->
            </div>
            <!-- End .title-->
          </div>
          <!-- End .col-12-->
        </div>
        <!-- End .row-->
      </div>
      <!-- End .container-->
    </div>
  </section>
  <!-- End #page-title-->
  <!--
  ============================
  Blog Grid #5 Section
  ============================
  -->
  <section class="blog blog-grid blog-grid-5" id="blog">
    <div class="container">
      <div class="row">
        @foreach($recent_news as $news)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="blog-entry" data-hover="">
            <div class="entry-content">
              <div class="entry-meta">
                @if(@$news->event_date)
                <div class="entry-date">
                    <span class="day"><i class="fa fa-calendar"></i> {{ @$news->event_date->format('d M, Y') }}</span>
                </div>
                @endif
                {{-- <div class="entry-author">
                  <p>{{ @$news->users->name }}</p>
                </div> --}}
                @if(@$news->time)
                <div class="entry-date">
                    <span class="day"><i class="fa fa-clock"></i> {{ @$news->time }} min read</span>
                </div>
                @endif
              </div>
              <div class="entry-title">
                @if(@$sub_menu_id->slug == 'blogs')
                <h4><a href="{{ route('blog',['news_slug'=>$news->slug]) }}">{{ Str::limit($news->title,100) }}</a></h4>
                @else
                <h4><a href="{{ route('case-study',['slug'=>$news->slug]) }}">{{ Str::limit($news->title,100) }}</a></h4>
                @endif
              </div>
              <div class="entry-img-wrap">
                <div class="entry-img">
                    @if(@$sub_menu_id->slug == 'blogs')
                    <a href="{{ route('blog',['news_slug'=>$news->slug]) }}"><img src="{{ @$news->image }}" alt="news thumb"/></a>
                    @else
                    <a href="{{ route('case-study',['slug'=>$news->slug]) }}">
                        @if(@$news->image)<img src="{{ @$news->image }}" alt="news thumb"/>@endif
                    </a>
                    @endif
                </div>
                @if(@$news->category->title)
                <div class="entry-category"><a href="{{ route('blog-filter',[$news->category_id]) }}">{{ @$news->category->title }}</a></div>
                @endif
              </div>
              <!-- End .entry-img-->
              <div class="entry-bio">
                {{-- <p>All of these factors are important consider when permitting your solar system, and can help streamline your process. Take time to consider these...</p> --}}
              </div>
              <div class="entry-more">
                @if(@$sub_menu_id->slug == 'blogs')
                  <a class="btn btn--white btn-bordered" href="{{ route('blog',['news_slug'=>$news->slug]) }}">read more </a>
                  @else
                  <a class="btn btn--white btn-bordered" href="{{ route('case-study',['slug'=>$news->slug]) }}">read more </a>
                @endif
                </div>
            </div>
          </div>
          <!-- End .entry-content-->
        </div>
        @endforeach

      </div>
      <!-- End .row-->
      <div class="row">
        <div class="col-12 text--center">
            {{ $recent_news->links() }}
          {{-- <ul class="pagination">
            <li><a class="current" href="blog-grid.html">1</a></li>
            <li><a href="blog-grid.html">2</a></li>
            <li><a href="#" aria-label="Next"><i class="energia-arrow-right"></i></a></li>
          </ul> --}}
        </div>
        <!-- End .col-lg-12-->
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section>

@endsection

