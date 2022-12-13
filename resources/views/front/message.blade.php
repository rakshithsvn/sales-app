@extends('front.layout')

@section('meta')
<title>{!! @$dynamic_contents['seo_title'] !!}</title>
<meta name="author" content="YIT">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')
<style type="text/css">
  .set-max-iframe-height iframe{height:150px !important; padding-left: 2px;}
  .alert-success {background-color:#1ba8e0 !important}
  .alert-danger {background-color: #e44d4a !important}
  .thank-you{background-image: url(./images/reception.png);
    background-size: cover;
    background-position: right;background-attachment:fixed;}
    
  </style>
  @endsection

  @section('main')

  <section class="ls columns_padding_30 section_padding_top_75 section_padding_bottom_20 columns_margin_bottom_60 thank-you">
    <div class="container">
      <div class="row">

        <div class="col-md-12 col-md-offset-2" style="width: 60%;background:rgba(255, 255, 255, 0.59); ">
          @if(Session::has('success'))
          <div class=" text-center">
            <h1><i class="fas fa-check" style="color:#3c763d !important;font-size: 80px;"></i></h1>

            <h3>THANK YOU</h3>

          </div>
          <br>
         
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <center style="color:white !important; font-size: 20px !important">{!! Session::get('success') !!}</center>
          </div>
          @endif

          @if(Session::has('danger'))
          <div class=" text-center">
            <h1><i class="fas fa-times" style="color:#e34d4a !important;font-size: 80px;"></i></h1>

            <h3>SORRY</h3>

          </div>
          <br>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <center style="color:white !important; font-size: 20px !important">{!! Session::get('danger') !!}</center>
          </div>
          @endif

        </div>
      </div>
    </div>
  </section>

  {{-- @include('front.address-list') --}}

  @endsection

  @section('script')

  @endsection

