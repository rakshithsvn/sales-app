@extends('front.layout')

@section('meta')
<title>Course Details</title>
<meta name="author" content="YIT">
<meta name="description" content="{!! @$dynamic_contents['meta_description'] !!}">
<meta name="keywords" content="{!! @$dynamic_contents['meta_keywords'] !!}">

@endsection

@section('main')

<!-- Home -->

<div class="home">
  <div class="home_background_container prlx_parent">

   <div class="home_background prlx" style="background-image:url(/front_img/inner_background.jpg)"></div>
 </div> 
 <div class="home_content"> 
   
  <h1>VIDEOS</h1> 
 
</div>
</div>

<section id="Academics1">   
     
<div class="container">
 <div class="row mt-30 pb-4">
  @foreach(@$video as $vid)
   <div class="col-md-6">
     <iframe width="100%" height="300px" src="{{@$vid->filename}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
   </div>
  @endforeach
  
</div>
</div>

</section>

@endsection





