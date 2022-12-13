@extends('front.layout')

@section('meta')
<title>Sales App | Faculty Profile</title>
<meta name="author" content="Sales App">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')

@endsection

@section('main')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="intro-text ">
        <h1>Faculty Profile</h1>
        <p><span><a href="{{ route('home') }}">Home <i class='fa fa-angle-right'></i></a></span>
          <span><a href=""> Faculty <i class='fa fa-angle-right'></i></a></span>
          <span class="b-active"><a href="#"> Faculty Profile</a></span></p>
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</div>
</header>

<div class="t-profile-01">
  <section class="teacher-prolile-01">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 t-profile-left">
          <div class="teacher-contact">
            <img src="{{ $team_detail->image }}" alt="" class="img-responsive img-fluid">
            <h3>Contact Info</h3>
            <p><span>Email:</span> {{ $team_detail->email_id }}</p>
            <p><span>Phone:</span> {{ $team_detail->mobile }}</p>
            <ul class="list-unstyled">
              <li><a href=""><i class="fa fa-facebook"></i></a></li>
              <li><a href=""><i class="fa fa-twitter "></i></a></li>
              <li><a href=""><i class="fa fa-google-plus"></i></a></li>
              <li><a href=""><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9 t-profile-right">
          <div class="row all-corsess-wapper">
            <div class="col-sm-12">
              <div class="all-courses">
                <h3>{{ $team_detail->full_name }}</h3>
                <div class="profile__courses__inner">
                  <ul class="profile__courses__list list-unstyled">
                    <li><i class="fa fa-graduation-cap"></i>Degree:</li>
                    <li><i class="fa fa-star"></i>Experience:</li>
                    <li><i class="fa fa-heart"></i>Hobbies:</li>
                    <li><i class="fa fa-bookmark"></i>My Courses:</li>
                    <li><i class="fa fa-bookmark"></i>Projects:</li>
                  </ul>
                  <ul class="profile__courses__right list-unstyled">
                    <li>PHD in Mathmatics</li>
                    <li>20 Years in university Math</li>
                    <li>Music, Dancing and Family</li>
                    <li>Higher Math, Math Puzzle</li>
                    <li>Map Creation</li>
                  </ul>
                </div>
                <p>{!! removeExtraChar($team_detail->body) !!}</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="teacher_skill clearfix">
              <div class="col-md-6 col-lg-6">
                <h3>My Schedule</h3>
                <div class="row">

                  <div class="col-sm-12">
                    <div class="progress-bar-linear">
                      <p class="progress-bar-text">Playing Science</p>
                      <div class="progress-cont">
                        <span class="main-color progress-bar-text">98%</span>
                      </div>
                      <div class="progress-bar-skills">
                        <div class="progress-bar-line main-color-bg" data-percent="98"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="progress-bar-linear">
                      <p class="progress-bar-text">Arts And Craft</p>
                      <div class="progress-cont">
                        <span class="main-color progress-bar-text">85%</span>
                      </div>
                      <div class="progress-bar-skills">
                        <div class="progress-bar-line main-color-bg" data-percent="85"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="progress-bar-linear">
                      <p class="progress-bar-text">Creative Writing</p>
                      <div class="progress-cont">
                        <span class="main-color progress-bar-text">96%</span>
                      </div>
                      <div class="progress-bar-skills">
                        <div class="progress-bar-line main-color-bg" data-percent="96"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="progress-bar-linear">
                      <p class="progress-bar-text">Laravel</p>
                      <div class="progress-cont">
                        <span class="main-color progress-bar-text">90%</span>
                      </div>
                      <div class="progress-bar-skills">
                        <div class="progress-bar-line main-color-bg" data-percent="90"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="progress-bar-linear">
                      <p class="progress-bar-text">Bootstrap</p>
                      <div class="progress-cont">
                        <span class="main-color progress-bar-text">92%</span>
                      </div>
                      <div class="progress-bar-skills">
                        <div class="progress-bar-line main-color-bg" data-percent="92"></div>
                      </div>
                    </div>
                  </div>

                </div> <!-- End Row -->
              </div>
              <div class="col-md-6 col-lg-6">
                <div class="teacher_shedule_list">
                  <h3>My Schedule</h3>
                  <ul class="list-unstyled teachers-time-shedule">
                    <li>Monday <span>9AM - 3PM</span></li>
                    <li>Tuesday <span>9AM - 3PM</span></li>
                    <li>Wednesday <span>9AM - 3PM</span></li>
                    <li>Thursday <span>9AM - 3PM</span></li>
                    <li>Friday <span>9AM - 3PM</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="row courses-instuctor">
            <div class="col-sm-12">
              <h3 class="courses-title">Courses By Name here </h3>


              <div class="row item-margin">
                <div class="col-sm-6 instractor-single">
                  <div class="instractor-courses-single">
                    <div class="img-box">
                      <img src="/images/index/events-02.jpg" alt="" class="img-responsive img-fluid">
                    </div>
                    <div class="instractor-courses-text">
                      <div class="instractor-parson">

                        <p><a href="">Derek Spafford</a> / <span>Professor</span></p>
                      </div>
                      <div class="text-bottom">
                        <h3><a href="#">Mathematics and Statistics</a></h3>
                        <p>Lorem ipsum dolor sit amet consepctetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus.</p>
                      </div>
                    </div>
                    <div class="price">
                      <ul class="list-unstyled">
                        <li><i class="fa fa-user"></i>50 Students</li>
                        <li>$50.00</li>
                      </ul>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 instractor-single">
                  <div class="instractor-courses-single">
                    <div class="img-box">
                      <img src="/images/index/events-01.jpg" alt="" class="img-responsive img-fluid">
                    </div>
                    <div class="instractor-courses-text">
                      <div class="instractor-parson">

                        <p><a href="#">Name</a> / <span>Professor</span></p>
                      </div>
                      <div class="text-bottom">
                        <h3><a href="#">Mathematics and Statistics</a></h3>
                        <p>Lorem ipsum dolor sit amet consepctetur adipiscing elit Etiam at ipsum at ligula vestibulum sodales Sed luctus.</p>
                      </div>
                    </div>
                    <div class="price">
                      <ul class="list-unstyled">
                        <li><i class="fa fa-user"></i>50 Students</li>
                        <li>$50.00</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@section('script')

@endsection

