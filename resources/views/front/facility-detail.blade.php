@extends('front.layout')

@section('meta')
<title>Facility Details</title>
<meta name="author" content="YIT">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')
<style>
.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.content-absolute:hover .image {
  opacity: 0.3;
}

.content-absolute:hover .middle {
  opacity: 1;
}

.text {
     color: #000;
    font-size: 18px;
    padding: 16px 32px;
    width: 300px;
    font-weight: 500
}
</style>
@endsection

@section('main')

<section class="page_breadcrumbs cs parallax section_padding_top_65 section_padding_bottom_65">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2 class="highlight bold">{{ @$dynamic_contents->title }}</h2>
        <ol class="breadcrumb">
          <li>
            <a href="{{ route('home') }}">
              Home
            </a>
          </li>
          <li>
            <a href="{{ route('dynamicpage',[$dynamic_contents->mainMenu->slug]) }}">{{ @$dynamic_contents->mainMenu->name }}</a>
          </li>
          <li class="active">{{ @$dynamic_contents->title }}</li>
        </ol>
      </div>
    </div>
  </div>
</section>


<section class="ls ms section_padding_top_50 section_padding_bottom_50 insurance-bg">
  <div class="container" id="facility">
    <div class="row">
      <div class="col-md-12">
        <div class="text-white">
          <div class="pull-middle">
            @if(@$dynamic_contents->body)
            <h2 class="h1 page-header text-white">OVERVIEW</h2>
            <p>{!! removeExtraChar(@$dynamic_contents->body) !!}</p>
            @endif

            @if($dept_address)
            <p><strong>CONTACT DETAILS</strong></p>
            <p>{!! removeExtraChar($dept_address->address) !!}</p>
            {{-- <p>{!! $dept_address->phone !!}</p>
            <p>{!! $dept_address->email !!}</p> --}}
            @endif
          </div>
          
          <div>
            @if(@$dynamic_contents->slug == 'health-lounge-preventive-health-check-up-programs')           
            <a href="{{ route('package')}}" class="theme_button color1 small_button topmargin_20">Book Health Checkup</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
            @elseif(@$dynamic_contents->slug == 'opd')           
            <a href="{{ route('find-doctor')}}" class="theme_button color1 small_button topmargin_20">Book Appointment</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
            @elseif(@$dynamic_contents->slug == 'organ-donation')    
            <a href="#enquiry" class="theme_button color1 small_button topmargin_20">Enquire Now</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
            @endif
            @if(@$prospect)           
            <a class="theme_button color1 small_button topmargin_20" href="{{ $prospect->prospect_path }}" target="_blank">Download Brochure</a> 
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<span id="enquiry"></span>
  
@if(count(@$gallery))
<section class="ls section_padding_100 bottommargin_60">
  <div class="topmargin_60 bottommargin_30">
    <h2 class="section_header text-center">
      <span class="big">Gallery</span>

    </h2>
  </div>
  <div class="owl-carousel related-photos-carousel" data-margin="0" data-nav="true" data-loop="true">
    @foreach(@$gallery as $image)
    <div>
      <div class="vertical-item gallery-title-item content-absolute">
        <div class="item-media gallery-img">
          <img src="{{ $image->tab_image }}" class="image">
          
          <div class="media-links">
            <div class="links-wrap">
              <a class="p-view prettyPhoto" title="" data-gal="prettyPhoto[gal]" href="{{ $image->tab_image }}">
                @if($image->tab_title)
                <div class="middle">
                  <div class="text">{{ $image->tab_title }}</div>
                </div>
                @else
                <div class="middle">
                  <div class="text"><i class="fas fa-search"></i></div>
                </div>
                @endif
              </a>
            </div> 
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</section>
@endif

@if(@$dynamic_contents->slug == 'blood-bank' || @$dynamic_contents->slug == 'organ-donation')

<section class="ls section_padding_50 topmargin_50">
 
    @if($dynamic_contents->slug == 'blood-bank')
     <h2 class="section_header text-center">
      <span class="big">Register as a Voluntary Blood Donor</span></h2><br/>
      <p class="text-center">Please fill the following information to register as voluntary blood donor. If any emergency requirement we will be contacting you. We thank you for being lifesaver.</p>
    @else
     <h2 class="section_header text-center">
      <span class="big">Enquiry Form</span>
    </h2>
    @endif
  </h2>
  <div class="container">
    <div class="row">

      <div class="col-md-12">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <center style="color:white !important;">{!! Session::get('success') !!}</center>
        </div>
        @endif

        @if(Session::has('danger'))
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <center style="color:white !important;">{!! Session::get('danger') !!}</center>
        </div>
        @endif

        <form class="contact-form columns_padding_5 row columns_margin_0" method="post" action="{{ route('contact-us') }}">

          {{ csrf_field() }}
          
          <div class="col-sm-6">
            <div class="contact-form-name bottommargin_10">
              <label for="name">Full Name
                <span class="required">*</span>
              </label>
              <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name" autocomplete="off" required>
            </div>
          </div>
         
          <div class="col-sm-6">
            <div class="contact-form-name bottommargin_10">
              <label for="name">Age
                <span class="required">*</span>
              </label>
              <input type="number" aria-required="true" size="30" value="" name="age" id="age" class="form-control" placeholder="Age" autocomplete="off" required>
            </div>
          </div>
          @if($dynamic_contents->slug == 'blood-bank')
          <div class="col-sm-6">
            <div class="contact-form-subject bottommargin_10">
              <label for="subject">Blood Group
                <span class="required">*</span>
              </label>
              <select name="blood_group" class="form-control" required="">
                <option value="">BLOOD GROUP</option>
                <option value="A+">A+</option><option value="A-">A-</option>
                <option value="B+">B+</option><option value="B-">B-</option>
                <option value="O+">O+</option><option value="O-">O-</option>
                <option value="AB+">AB+</option><option value="AB-">AB-</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="contact-form-subject bottommargin_10">
              <label for="subject">Place
                <span class="required">*</span>
              </label>
              <input type="text" aria-required="true" size="30" value="" name="place" id="place" class="form-control" placeholder="Place" autocomplete="off" required>
            </div>
          </div>         
          @endif

          <div class="col-sm-6">
            <div class="contact-form-phone bottommargin_10">
              <label for="phone">Phone
                <span class="required">*</span>
              </label>
              <input type="text" aria-required="true" size="30" value="" name="mobile" id="mobile" class="form-control" placeholder="Phone number" autocomplete="off" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="contact-form-email bottommargin_10">
              <label for="email">Email address
                <span class="required">*</span>
              </label>
              <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address" autocomplete="off" required>
            </div>
          </div>
          @if($dynamic_contents->slug == 'organ-donation')
          <div class="col-sm-6">
            <div class="contact-form-subject bottommargin_10">
              <label for="subject">Place
                <span class="required">*</span>
              </label>
              <input type="text" aria-required="true" size="30" value="" name="place" id="place" class="form-control" placeholder="Place" autocomplete="off" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="contact-form-subject bottommargin_10">
              <label for="subject">Message
                <span class="required">*</span>
              </label>
              <input type="text" aria-required="true" size="30" value="" name="message" id="message" class="form-control" placeholder="Message" autocomplete="off" >
            </div>
          </div>
          @endif

          <div class="col-sm-12">
            <div class="contact-form-submit topmargin_40">
              @if($dynamic_contents->slug == 'blood-bank')
                <button type="submit" id="contact_form_submit" name="submit" value="blood bank" class="theme_button color2 margin_0">Submit</button>
              @else
                <button type="submit" id="contact_form_submit" name="submit" value="organ donation" class="theme_button color2 margin_0">Submit</button>
              @endif
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</section>

@endif

@endsection

@section('script')
<script>
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    items:4,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:false
  });
</script>
@endsection

