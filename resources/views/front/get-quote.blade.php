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
  .alert-success {background-color: #3c763d !important}
  .alert-danger {background-color: #e44d4a !important}
  span.filter-option.pull-left{color: #73787f}
  input#datepicker1[readonly] {
    color: #ffffff;
    font-weight: 400;
    float: none;
    background-color: transparent;
    border: 1px solid #dadada;
}
</style>
@endsection

@section('main')

<section class="page_breadcrumbs cs parallax section_padding_top_65 section_padding_bottom_65">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2 class="highlight bold">Enquiry Form</h2>
        <ol class="breadcrumb">
          <li>
            <a href="{{ route('home') }}">
              Home
            </a>
          </li>

          <li class="active">Enquiry Form</li>
        </ol>
      </div>
    </div>
  </div>
</section>

{{-- <section id="map" class="ls" data-address="Allwood Road, Clifton, NJ, United States">
  <!-- marker description and marker icon goes here -->
  <div class="map_marker_description">
          <!-- <h3>Map Title</h3>
            <p>Map description text</p> -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3889.1327854652413!2d74.84425171482121!3d12.89918209090343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1saj+hospital!5e0!3m2!1sen!2sin!4v1565420495470!5m2!1sen!2sin" width="100%" height="650" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </section> --}}

        <section class="ls columns_padding_30 section_padding_top_75 section_padding_bottom_20 columns_margin_bottom_60">
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

                @if($package)
                  <h3 class="module-header bottommargin_30">Book Health Package</h3>
                @else
                  <h3 class="module-header bottommargin_30">Enquiry Form</h3>
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
                    <div class="contact-form-subject bottommargin_10">
                      <label for="subject">Subject
                        <span class="required">*</span>
                      </label>     
                      @if($package)
                        <input type="text" aria-required="true" size="30" value="{{ $package->tab_title }}" name="subject" id="subject" class="form-control" autocomplete="off" required>
                      @else
                        <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject" autocomplete="off" required>
                      @endif
                    </div>
                  </div>
                  @if($package)
                  <div class="col-md-6">    
                    <div class="form-group">
                      <div class="bottommargin_10">
                       
                        <div class="input-group with_button">
                          <input type="text" aria-required="true" class="form-control" value="" name="date" id="datepicker1" placeholder="Preferred Date" autocomplete="off" autocomplete="off" required readonly="true">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                      </div>
                    </div>
                  </div>
 
                  <div class="col-md-6">  
                    <div class="form-group">
                      <div class="bottommargin_10">
                       
                        <div class="select-group no-bs-caret">
                          <select class="selectpicker" id="time" name="time" title="0:00" placeholder="TIME" required>
                            <option disabled selected>TIME</option>
                            @foreach($timings as $time)
                              <option>{{ $time }}</option>
                            @endforeach                          
                          </select>
                          <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                      </div>
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
                  <div class="col-sm-12">

                    <div class="contact-form-message">
                      <label for="message">Message</label>
                      <textarea aria-required="true" rows="6" cols="45" name="message" id="message" class="form-control" placeholder="Message..." autocomplete="off"></textarea>
                    </div>
                  </div>

                  <div class="col-sm-12">

                    <div class="contact-form-submit topmargin_40">
                      @if($package)
                        <button type="submit" id="contact_form_submit" name="submit" value="book package" class="theme_button color2 margin_0">Submit</button>
                      @else
                        <button type="submit" id="contact_form_submit" name="submit" class="theme_button color2 margin_0">Submit</button>
                      @endif
                    </div>
                  </div>
                </form>
              </div> 
            </div>
          </div>
        </section>

        @include('front.address-list')

  @endsection

  @section('script')

  <script>
  // $.validate({  form : '#contact'});    

  $(document).ready(function(){

    $("#datepicker1").datepicker({dateFormat:'dd/mm/yy', minDate: 1, maxDate: "+30d",
        
     beforeShowDay: function(date) {
          var day = date.getDay();
          return [(day != 0), ''];
      }
    });

    $('#contact').on('submit',function(e){
      e.preventDefault();

      var url = $(this).attr('action');
      var post = $(this).attr('method');
      var data = $(this).serialize();
      $.ajax({
        path : url,
        type : post,
        data : data,
        success:function(data){
         var m = "<div class='alert alert-success alert-block'> <button type='button' class='close' data-dismiss='alert'> x </button>" + data.success_message + "</div>";
          // alert(data.success_message);
          $('.resp').html(m);
        }
      })
    })
  })
</script>
@endsection

