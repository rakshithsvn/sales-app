@extends('front.layout')

@section('meta')
<title>Sales App | Case Studies</title>
<meta name="author" content="Sales App">
<meta name="description" content="{!! @$dynamic_content['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_content['meta_keywords'] !!}">

@endsection

@section('main')

<section class="page-title page-title-blank-2 bg-white" id="page-title">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="d-none">{{ @$dynamic_content->title }}</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-wrap">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('case-studies') }}">Case Studies</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ @$dynamic_content->title }}</li>
            </ol>
          </div>
          <!-- End .title -->
        </div>
        <!-- End .col-lg-8-->
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
  </section>

<section class="blog blog-single" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8">
          <div class="blog-entry">
            @if(@$dynamic_content->image)
            <div class="entry-img"><img src="{{ @$dynamic_content->image }}" alt="entry image"/>
            @endif
              <div class="entry-meta">
                @if(@$dynamic_content->category->title)
                <div class="entry-category"><a href="{{ route('blog-filter',[$dynamic_content->category_id]) }}">{{ @$dynamic_content->category->title }}</a></div>
                @endif
                {{-- <div class="entry-date"> <span class="date"><i class="fa fa-calendar"></i> {{ @$dynamic_content->event_date->format('d M, Y') }}</span></div> --}}
                {{-- <div class="entry-author"><a href="#">{{ @$dynamic_content->users->name }}</a></div> --}}
                {{-- <div class="entry-date">
                    <span class="day"><i class="fa fa-clock"></i> {{ @$dynamic_content->time }} min read</span>
                </div> --}}
                {{-- <div class="entry-comments"><span>comments:</span><span class="num">2</span></div> --}}
              </div>
              <!-- End .entry-meta-->
            </div>
            <div class="entry-content">
              <div class="entry-title">
                <h4>{{ @$dynamic_content->title }}</h4>
              </div>
              <div class="entry-bio">
                {!! removeExtraChar(@$dynamic_content->body) !!}
            </div>
              {{-- <div class="entry-holder">
                <div class="entry-share"><span>share this article</span>
                    @php $link = "https://falcontrackers.com/resources/blogs/".$dynamic_content->slug; @endphp
                  <div><a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$link}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="share-twitter" href="https://twitter.com/intent/tweet?text={{$link}}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a class="share-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{$link}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></div>
                </div>
                <!-- End .entry-share-->
              </div> --}}
            </div>
            {{-- <div class="nav-posts">
              <div class="prev-post">
                <div class="post-img">
                  <div class="overlay"> <i class="energia-arrow-right"></i></div><img src="assets/images/blog/thumb/prev.png" alt="title"/>
                </div>
                <div class="post-body"><span>previous post</span><a class="post-link" href="blog-single.html">energy research will help eagles coexist wind</a></div>
              </div>
              <div class="next-post">
                <div class="post-body"><span>next post</span><a class="post-link" href="blog-single.html">the middle east's top new alternative energy source</a></div>
                <div class="post-img">
                  <div class="overlay"> <i class="energia-arrow-right"></i></div><img src="assets/images/blog/thumb/next.png" alt="title"/>
                </div>
              </div>
            </div> --}}
            {{-- <div class="entry-widget-bio">
              <div class="entry-widget-content"><img src="assets/images/blog/author/2.jpg" alt="author"/>
                <div class="entry-bio-desc">
                  <h4>Mahmoud Baghagho</h4>
                  <p>Founded by Begha over many cups of tea at her kitchen table in 2009, our brand promise is simple: to provide powerful digital marketing solutions.</p><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <!-- End .entry-bio-->
            <div class="entry-widget entry-comments" id="comments">
              <div class="entry-widget-title">
                <h4><span class="comments-number">2</span> comments</h4>
              </div>
              <div class="entry-widget-content">
                <ul class="comments-list">
                  <li class="comment-body">
                    <div class="avatar"><img src="assets/images/blog/author/1.png" alt="avatar"/></div>
                    <div class="comment">
                      <h6>Richard Muldoone</h6>
                      <div class="date">Feb 28, 2019 - 08:07 pm</div>
                      <p>The example about the mattress sizing page you mentioned in the last WBF can be a perfect example of new keywords and content, and broadening the funnel as well. I can only imagine the sale numbers if that was the site of a mattress selling company.</p><a class="reply" href="#comments">reply</a>
                      <ul class="replies-list">
                        <li class="comment-body">
                          <div class="avatar"><img src="assets/images/blog/author/2.png" alt="avatar"/></div>
                          <div class="comment">
                            <h6>mike dooley</h6>
                            <div class="date">Feb 28, 2019 - 08:22 pm</div>
                            <p>The example about the mattress sizing page you mentioned in the last WBF can be a perfect example of new keywords and content, and broadening the funnel as well. I can only imagine the sale numbers if that was the site of a selling company.</p><a class="reply" href="#comments">reply</a>
                          </div>
                          <!-- End .reply-->
                        </li>
                      </ul>
                      <!-- End .replies-list-->
                    </div>
                  </li>
                  <!-- End .comment-->
                </ul>
                <!-- End .comments-list-->
              </div>
            </div>
            <!-- End .entry-comments-->
            <div class="entry-widget entry-add-comment mb-0 clearfix">
              <div class="entry-widget-title">
                <h4>Leave A Reply</h4>
              </div>
              <div class="entry-widget-content">
                <form class="mb-0" id="post-comment">
                  <div class="row">
                    <div class="col-12 col-lg-4">
                      <input class="form-control" type="text" placeholder="Name"/>
                    </div>
                    <div class="col-12 col-lg-4">
                      <input class="form-control" type="email" placeholder="Email"/>
                    </div>
                    <div class="col-12 col-lg-4">
                      <input class="form-control" type="text" placeholder="Website"/>
                    </div>
                    <div class="col-12">
                      <textarea class="form-control" rows="2" placeholder="Comment"></textarea>
                    </div>
                    <div class="col-12">
                      <div class="custom-radio-group">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input class="custom-control-input" type="radio" id="customRadioInline1" name="customRadioInline1"/>
                          <label for="customRadioInline1">Save my name, email, and website in this browser for the next time I comment.</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn--primary btn-line btn-line-before" type="submit"><span>submit comment</span><i class="energia-arrow-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div> --}}
            <!-- End .entry-comments-->
          </div>
          <!-- End .blog-entry-->
        </div>
        <!-- End .col-lg-8-->
         <div class="col-12 col-lg-4">
          <!--
          ============================
          Sidebar Blog
          ============================
          -->
          @if(@$recent_news)
          <div class="sidebar sidebar-blog">
            <!-- Recent Posts-->
            <div class="widget widget-recent-posts">
              <div class="widget-title">
                <h5>Recent Case Studies</h5>
              </div>
              <div class="widget-content">
                <!-- Start .Post-->
                @foreach($recent_news as $key=>$news)
                @if($key<5)
                <div class="post">
                  <div class="post-img"><img src="{{ @$news->image }}" alt="post img"/></div>
                  <div class="post-content">
                    {{-- <div class="post-date"><span class="date">{{ @$news->event_date->format('d M, Y') }}</span></div> --}}
                    <div class="post-title"><a href="{{ route('case-study',['slug'=>$news->slug]) }}">{{ Str::limit($news->title,100) }} </a></div>
                  </div>
                </div>
                @endif
                @endforeach
                <!-- End .post-->
              </div>
            </div>
            @endif
            <!-- End .widget-recent-posts -->
            <!-- Categories-->
            {{-- <div class="widget widget-categories">
              <div class="widget-title">
                <h5>categories</h5>
              </div>
              <div class="widget-content">
                <ul class="list-unstyled">
                    @foreach (@$categories as $id=>$category)
                        <li><a href="{{ route('blog-filter',[$id]) }}">{{ @$category }}</a>
                            @php $i = 0;
                            foreach (@$recent_news as $news ) {
                                if($news->category_id == $id) { $i++; }
                            }
                            @endphp
                            <span>{{ $i }}</span>
                        </li>
                    @endforeach
                </ul>
              </div>
            </div> --}}
            <!-- End .widget-categories -->
            <!-- Tags-->
            {{-- <div class="widget widget-tags">
              <div class="widget-title">
                <h5>Tags</h5>
              </div>
              <div class="widget-content">
                  @foreach (@$categories as $id=>$category)<a href="{{ route('blog-filter',[$id]) }}">{{ @$category }}</a> &nbsp;@endforeach
              </div>
            </div> --}}
            <!-- End .widget-tags -->
          </div>
          <!-- End .sidebar-->
        </div>
        <!-- End .col-lg-4-->
      </div>
      <!-- End .row-->
    </div>
    <!-- End .container-->
</section>

@endsection

