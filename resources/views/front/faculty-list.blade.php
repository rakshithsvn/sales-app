@extends('front.layout')

@section('meta')
<title>Sales App | Faculty</title>
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
        <h1>Faculty</h1>
        <p><span><a href="{{ route('home') }}">Home <i class='fa fa-angle-right'></i></a></span>
          <span class="b-active"><a href="#">Academics <i class='fa fa-angle-right'></i></a></span>
          <span class="b-active"><a href="#">Faculty</a></span></p>
      </div>
    </div>
  </div><!-- /.row -->
</div><!-- /.container -->
</div>
</header>

<div class="teachers-01">
  <section class="teachers-area">
    <div class="container">
      <div class="row teachers-wapper-01">
        @foreach($team_detail as $team)
        <div class="col-sm-6 col-md-3 teacher-single">
          <div class="teacher-body">
            <img src="{{ $team->image }}" alt="" class="img-responsive img-fluid">
            <div class="teachars-info">
              <h3>{{ $team->full_name }}</h3>
              <span>{{ $team->designation }}</span>
              <ul class="list-unstyled">
                <li><a href=""><i class="fa fa-facebook teacher-icon"></i></a></li>
                <li><a href=""><i class="fa fa-twitter teacher-icon"></i></a></li>
                <li><a href=""><i class="fa fa-google-plus teacher-icon"></i></a></li>
                <li><a href=""><i class="fa fa-linkedin teacher-icon"></i></a></li>
                <li><a href=""><i class="fa fa-instagram teacher-icon"></i></a></li>
              </ul>
              <a href="{{ route('faculty',['team_slug'=>$team->slug]) }}" class="btn btn-primary">View Profile</a>

            </div>
          </div>
        </div>
        @endforeach

      <div class="modal fade product_view t-profile-01" id="profile_view">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-times"></span></a>
              <h3 class="modal-title">Faculty Profile</h3>
            </div>
            <div class="modal-body teacher-prolile-01">
              <div class="row">
                <div class="col-sm-3 t-profile-left">
                  <div class="teacher-contact">
                    <img src="/images/fac-1.jpg" alt="" class="img-responsive img-fluid">
                    <h3>Contact Info</h3>
                    <p><span>Email:</span> info@company.com</p>
                    <p><span>Phone:</span> 61 3 8376 6284</p>
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
                        <h3>Ddvid Martin</h3>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque. Vivamus in ipsum quis elit vehicula tempus vitae quis lacus. Vestibulum interdum diam non mi cursus venenatis. Morbi lacinia libero et elementum vulputate. Vivamus et facilisis mauris. Maecenas nec massa auctor, ultricies massa eu, tristique erat. Vivamus in ipsum quis elit vehicula tempus vitae quis lacus. Eu pellentesque, accumsan tellus leo, ultrices mi dui lectus sem nulla eu.Eu pellentesque, accumsan tellus leo, ultrices mi dui </p>
                        <p>lectus sem nulla eu. Maecenas arcu, nec ridiculus quisque orci, vulputate mattis risus erat. lectus sem nulla eu.Eu pellentesque, accumsan tellus leo, ultrices mi dui lectus sem nulla eu. Maecenas arcu, nec ridiculus quisque orci, vulputate mattis risus erat.</p>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="teacher_skill clearfix">
                      <div class="col-md-6 col-lg-6">
                        <h3>My Shedule</h3>
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


                        </div> <!-- End Row -->
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="teacher_shedule_list">
                          <h3>My Shedule</h3>
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@section('script')


@endsection

