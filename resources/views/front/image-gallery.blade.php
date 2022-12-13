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
            <h1>{{ $parent_menu_id->name }}</h1>
    </div>
</div>


<section id="gallery">
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills mb-3 ml-md-auto mr-md-auto" id="pills-tab" role="tablist">
              @foreach($album_folder as $key=>$img)
                @if($key==0)
                <li class="nav-item">
                    <a class="nav-link galleryNavLink active" id="{{$key}}" data-toggle="pill" href="#showall" role="tab" aria-controls="showall" aria-selected="true">
                  
                @else
                <li class="nav-item">
                     <a class="nav-link galleryNavLink" id="{{$key}}" data-toggle="pill" href="#Cars" role="tab" aria-controls="Cars" aria-selected="false">
                @endif
                {{@$img->title}}</a>
                </li>  
                @endforeach
            </ul>
        </div>
        <hr noshade style="margin-top:-20px;">

        <div class="container tab_click">
            <div class="tab-content" id="pills-tabContent">
                
              @foreach($album_images as $key=>$album) 

                <div class="tab-pane fade show @if ($key == 0)active @endif {{$key}}"  id="showall" role="tabpanel" aria-labelledby="showall-tab">
                <div class="row">

                @foreach(array_slice(array_filter(explode(',', $album->filename)),0,3) as $image)

                <div class="col-md-4"><div class="Portfolio"><a href="{{route('gallery-images',['slug' => encryptor('encrypt', $album->media_album_id)])}};"><img class="card-img" src="{{$image}}" alt=""></a></div></div>
          
                @endforeach
                </div>
          </div>

          @endforeach
        
        </div>
        </div>

    </div>
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(document).on('click','.galleryNavLink',function(){
            var id = $(this).attr('id')
            $('#pills-tabContent').find('.tab-pane').removeClass('active')
            $('#pills-tabContent').find('.'+id).addClass('active')
        })
    })

</script>
@endsection




