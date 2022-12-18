@extends('front.layout')

@section('meta')

@section('title', 'Sales App')
{{-- <meta name="description" content="{!! @$home_content['meta_description'] !!}">
<meta name="keywords" content="{!! @$home_content['keywords'] !!}"> --}}
<meta name="description" content="Sales App">

@endsection

@section('css')

@endsection

@section('main')

<!--Main Slider-->
<div id="hme"></div>


<!-- Fun Fact Section -->
<section class="fun-fact-section">
    <div class="auto-container">
        <div class="fact-counter">
            <div class="row clearfix">
                <!--Column-->


            </div>
        </div>
    </div>
</section>
<!--End Fun Fact Section -->



@endsection

@section('script')

<script type="text/javascript">
    $(window).on('load', function(e) {
        e.stopPropagation();
        $('#staticBackdrop').modal('toggle');
    });
</script>

@endsection