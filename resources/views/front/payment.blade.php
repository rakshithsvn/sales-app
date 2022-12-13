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

  <section class="faqs faqs-2" id="faqs-1">
    <div class="container">
      <div class="row">
        <div class="col-8 col-lg-8">
          @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <center style="color: #1a17dd !important;">{!! Session::get('success') !!}</center>
        </div>
        @endif

        @if(Session::has('danger'))
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <center style="color: red !important;">{!! Session::get('danger') !!}</center>
        </div>
        @endif

            <div class="contact-card">
                  <div class="contact-body">
                    @if($type == 'generate-link')
                        <h5 class="card-heading">Generate Online Payment Link Here!</h5>
                    @else
                        <h5 class="card-heading">Pay Online!</h5>
                    @endif

           <form method="post" action="{{ route('post-falcon-pay-online') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="{{$type}}">
                      <div class="row">
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="lastName" name="lastName" placeholder="Last Name" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="address1" name="address1" placeholder="Address" required=""/>
                        </div>
                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="city" name="city" placeholder="City" required=""/>
                        </div>

                        <div class="col-12 col-md-12">
                          <select id="countryCode" class="form-control" name="countryCode" required="">
                              <option value="AE" selected>United Arab Emirates</option>
                              <option value="EU">Europe</option>
                              <option value="IN">India</option>
                              <option value="OM">Oman</option>
                              <option value="QA">Qatar</option>
                              <option value="SA">Saudi Arabia</option>
                              <option value="GB">United Kingdom</option>
                              <option value="US">United States</option>
                          </select>
                        </div>

                        <div class="col-12 col-md-12">
                          <input class="form-control" type="text" id="amount_val" name="amount" placeholder="Enter Amount in UAE Dirhams" required="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"/>
                        </div>

                        <div class="col-12 col-md-12">
                          <input class="form-control" type="email" id="email" name="email" placeholder="Email" required=""/>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="g-recaptcha" data-sitekey="{{ config('app.site_key') }}"></div>
                            <span style="color: red;" id="recaptcha">You can't proceed!</span>
                        </div>
                      
                        <div class="col-12 col-md-6">
                          @if($type == 'generate-link')
                              <button type="submit" class="btn btn--primary">Generate Link <i class="energia-arrow-right"></i></button>
                          @else
                              <button type="submit" class="btn btn--primary">Pay Online <i class="energia-arrow-right"></i></button>
                          @endif
                        </div>

                        <div class="col-12 col-md-6">
                           <button type="reset" class="btn btn--primary">Reset <i class="energia-arrow-right"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </section>

   @section('script')

  <script>
      $(document).ready(function() {
           $('#recaptcha').hide();
      });

      $('form').on('submit', function(e) {
        if(grecaptcha.getResponse() == "") {
          e.preventDefault();
          $('#recaptcha').show();
        } else {
          $('#recaptcha').hide();
        }
      });
   </script>

  @endsection

  @endsection

