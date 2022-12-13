@extends('front.layout')

@section('meta')
<title>Testimonials</title>
<meta name="author" content="Nidhiland">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('main')

<!-- #Inner Banner -->

<section class="page_breadcrumbs cs parallax section_padding_top_65 section_padding_bottom_65">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2 class="highlight bold">Testimonials</h2>
        <ol class="breadcrumb">
          <li>
            <a href="{{ route('home') }}">
              Home
            </a>
          </li>
          
          @if(@$sub_menu_id)
          <li>
            <a href="">{{ @$parent_menu_id->name }}</a>
          </li>

          <li>
            <a href="">{{ @$sub_menu_id->name }}</a>
          </li>

          @else
          <li>
            <a href="">{{ @$parent_menu_id->name }}</a>
          </li>                    
          @endif
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="ls section_padding_75">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">

        @foreach($testimonial as $key=>$test)

        <blockquote class="blockquote-big with_media quote-color2 text-center @if($key==0) topmargin_0 @else topmargin_80 @endif">
          <img src="{{ $test->image }}" alt="" /> {!! $test->body !!}
          <div class="item-meta highlight3">
            <h4>{{ $test->title }}</h4>
            <p>{{ $test->designation }}</p>
          </div>
        </blockquote>

        @endforeach      

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
       {{ $testimonial->links() }}
      </div>
    </div>
  </div>
</section>

@endsection

@section('script')

@endsection
