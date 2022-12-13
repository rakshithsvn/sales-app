@extends('front.layout')

@section('meta')
<title>Sales App | Contact Us</title>
<meta name="author" content="Sales App">
<meta name="description" content="Sales App is one of the best GPS fleet tracking companies on the market. Need more information? Contact our experts!">
<meta name="keywords" content="GPS Vehicle Tracking, Vehicle Tracking System, Temperature Monitoring, Fuel Monitoring, Temperature Management, ADAS System, DMS, Fleet Management Software, Fleet Monitoring Service, UAE, DUBAI">

@endsection

@section('css')

@endsection

@section('main')

  <!--
      ============================
      Google Map Section
      ============================
      -->
      <section class="map map-2">
        <div class="container">
          <div class="row">
            <div class="col">
              <h3 class="d-none">our office map</h3>
            </div>
          </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.3940514714377!2d55.400001950032774!3d25.2909615837734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5c206e578315%3A0x76de9f8bdd7acae4!2sFalcon%20GPS%20Trackers%20-%20GPS%20Vehicle%20%26%20Asset%20Tracking%20Company%2C%20Fuel%20Monitoring%2C%20Tyre%20Pressure%20Monitoring%2C%20Temperature%20Monitoring%2C%20Fleet%20Maintenance%2C%2024x7%20Surveillance!5e0!3m2!1sen!2sin!4v1644308811947!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

      </section>
      <!--
      ============================
      Testimonials #5 Section
      ============================
      -->
      <section class="testimonial testimonial-5 bg-overlay bg-overlay-white2">
        <div class="bg-section"><img src="assets/images/background/wavy-pattern.png" alt="background"/></div>
        <div class="container">
          <div class="contact-panel contact-panel-2">
            <div class="row">
              <div class="col-12 col-lg-5 img-card-holder">
                <div class="img-card img-card-2 bg-overlay bg-overlay-theme">
                  <div class="bg-section"><img src="assets/images/contact/2.jpg" alt="image"/></div>
                  <div class="card-content">
                    <div class="content-top">
                      <p>You can choose the ONLINE CHAT option at the bottom right corner, and someone will be there soon!</p>
                      <p>You may also contact us by choosing your nearest location and using any of the most convenient options. We will get back to you as soon as possible.</p>
                    </div>
                    <div class="content-bottom">
                        @foreach(@$address_list as $add)
                      <ul class="list-unstyled contact-infos">
                        <li><h6>{{ @$add->name }}</h6></li>
                        <li class="contact-info"><i class="energia-phone-Icon"></i>
                            <p>{!! removeExtraChar($add->phone) !!}</p>
                        </li>
                        @if(@$add->address)
                        <li class="contact-info"><i class="energia-location-Icon"></i>
                            <p>{!! removeExtraChar($add->address) !!}</p>
                        </li>
                        @endif
                        @If(@$add->email)
                        <li class="contact-info"><i class="energia-email--icon"></i>
                            <p>{!! removeExtraChar($add->email) !!}</p>
                          </li>
                          @endif
                      </ul>
                      <br>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-7">
                @if (session()->has('success'))
                <div class="alert alert-success text-center animated fadeIn">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {!! session()->get('success') !!}
                </div>
                @endif
                <div class="contact-card">
                  <div class="contact-body">
                    <p class="card-desc">At Sales App, we strive to provide a personalized solution tailored to each individual client's needs.</p>
                    <h5 class="card-heading">We're A Click Away!</h5>
                    <p class="card-desc">Complete the form below and click on Submit Request. Our representatives will contact you as soon as possible.</p>
                    <form method="post" action="{{ route('contact') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="contact-name" name="name" placeholder="Full Name" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="email" id="contact-email" name="email" placeholder="Email" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="contact-phone" name="phone" placeholder="Phone" required="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="contact-phone" name="city" placeholder="City" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="contact-phone" name="country" placeholder="Country" required=""/>
                        </div>
                        <div class="col-12">
                          <textarea class="form-control" id="contact-infos" placeholder="message" name="message" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="g-recaptcha" data-sitekey="{{ config('app.site_key') }}"></div>
                          </div>
                        <div class="col-12 col-md-6 mb-3">
                          <button type="submit" class="btn btn--primary">Submit Request <i class="energia-arrow-right"></i></button></div>
                          <div class="col-12 col-md-6 mb-3">
                           <button type="reset" class="btn btn--primary">Reset <i class="energia-arrow-right"></i></button>
                        </div>
                        <div class="col-12">
                          <div class="contact-result"></div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- End .contact-body -->
                </div>
              </div>
            </div>
            <!-- End .row-->
          </div>
          <!-- End .contact-panel-->

          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
<section class="counters counters-1 bg-overlay bg-overlay-theme2" id="counters-1">
  <div class="bg-section"> <img src="assets/images/background/2.jpg" alt="Background"/></div>
  <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8">
            <div class="img-hotspot">
              <div class="img-hotspot-wrap">
                <div class="img-hotspot-bg"> <img src="assets/images/background/asia-map-dark.png" alt="image"/></div>
                <div class="img-hotspot-pointers">
                  <div class="img-hotspot-pointer" data-spot-x="48%" data-spot-y="40%">
                  <span class="ripple"></span>
                    <div class="pointer-icon"></div>
                    <div class="info" data-info-x="" data-info-y="">
                      <div class="border-outer">
                        <div class="border-inner"><span><h6 class="countryname">UAE</h6> +971 55 6751770<br> <a href="">Call</a> or <a href="">WhatsApp</a></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="img-hotspot-pointer" data-spot-x="43%" data-spot-y="32%">
                  <span class="ripple"></span>
                    <div class="pointer-icon"></div>
                    <div class="info" data-info-x="" data-info-y="">
                      <div class="border-outer">
                        <div class="border-inner"><span><h6 class="countryname">Qatar</h6> +974 33197619<br> <a href="">Call</a> or  <a href="">WhatsApp</a></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="img-hotspot-pointer" data-spot-x="51%" data-spot-y="48%">
                  <span class="ripple"></span>
                    <div class="pointer-icon"></div>
                    <div class="info" data-info-x="" data-info-y="">
                      <div class="border-outer">
                        <div class="border-inner"><span><h6 class="countryname">Oman</h6> +968 99345940<br> <a href="">Call</a> or <a href="">WhatsApp</a></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="img-hotspot-pointer" data-spot-x="75%" data-spot-y="63%">
                  <span class="ripple"></span>
                    <div class="pointer-icon"></div>
                    <div class="info" data-info-x="" data-info-y="">
                      <div class="border-outer">
                        <div class="border-inner"><span><h6 class="countryname">India</h6> +91 96064 56182<br> <a href="">Call</a> or <a href="">WhatsApp</a></span></div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
            <div class="col-12 col-lg-3 offset-lg-1">
              <!-- Start .counter-->
              <div class="counter counter-2">
                <div class="counter-num"> <span class="counting" data-counterup-nums="6,154">6,154</span>
                  <h6>projects</h6>
                </div>
                <div class="counter-desc">
                  <p>Yet those that embrace change are thriving, building bigger, better, faster, and stronger products than ever.</p>
                </div>
              </div>
              <!-- End .counter-->
              <!-- Start .counter-->
              <div class="counter counter-2">
                <div class="counter-num"> <span class="counting" data-counterup-nums="2,112">2,112</span>
                  <h6>employees</h6>
                </div>
                <div class="counter-desc">
                  <p>Yet those that embrace change are thriving, building bigger, better, faster, and stronger products than ever.</p>
                </div>
              </div>
              <!-- End .counter-->
            </div>
          </div>
        </div>
        </section><br/>

@endsection

@section('script')

@endsection

