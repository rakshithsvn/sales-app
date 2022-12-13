@extends('front.layout')

@section('meta')
<title>Photo Gallery</title>
<meta name="author" content="YIT">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('css')

@endsection


@section('main')

<!-- Home -->

<div class="home">
  <div class="home_background_container prlx_parent">
   @if(@$dynamic_contents['banner_image'] == null)
   <div class="home_background prlx" style="background-image:url(../front_img/inner_background.jpg)"></div>
   @else
   <div class="home_background prlx" style="background-image:url(@$dynamic_contents['banner_image'])"></div>
   @endif
 </div>
 <div class="home_content">
  <h1>{!! $album_id->title !!}</h1>
</div>
</div>

<section id="gallery">
<div class="container">
  <div class="row">

       @foreach($campus_images as $campus_image)
          @if(!empty($campus_image))
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="{{$campus_image}}" data-image-id="" data-toggle="modal" data-title=""
                   data-image="{{$campus_image}}"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="{{$campus_image}}"
                         alt="Another alt text">
                </a>
            </div>
          @endif
        @endforeach

        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive img-fluid col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <a href="{{route('dynamicpage',['parent_slug'=>'gallery'])}}"><div class="button button_line_2 text-center faculty-btn trans_200 round btn-rounded"> Back to Gallery</div></a>
</div>
</section>

<br>
<div class="clear"></div>

@endsection




