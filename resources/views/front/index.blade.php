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
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb=""  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        
                        <!-- MAIN IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="20" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="/assets/images/main-slider/1.jpg">


                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme big-ipad-hidden rs-parallaxlevel-4" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-150','-150','-150','-150']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-1.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-100','-100','-100','-100']"
                        data-voffset="['60','60','60','60']"
                        data-x="['left','left','left','left']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-2.png" alt=""></figure>
                        </div>
                        

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-60','-60','-60','-60']"
                        data-voffset="['100','100','100','100']"
                        data-x="['right','right','right','right']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-4.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-90','-90','-90','-90']"
                        data-voffset="['170','170','170','100']"
                        data-x="['right','right','right','right']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-3.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-150','-150','-150','-150']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-5.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-30','-30','-30','-30']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-6.png" alt=""></figure>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['750','750','750','650']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-190','-190','-190','-190']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <span class="title"><span>5 Days</span>  -  <span>15 Talk</span>  -  <span>2 Parties</span></span>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['750','750','750','650']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-50','-80','-80','-80']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h2>World Digital <br>Conference</h2>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['700','750','700','450']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['90','30','30','40']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <ul class="event-info">
                                <li><i class="fa fa-map-marker"></i> California, USA</li>
                                <li><i class="fa fa-calendar"></i> January 20 To 25, 2022</li>
                            </ul>
                        </div>
                        
                        <div class="tp-caption tp-resizeme" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-whitespace="normal"
                        data-width="['650','650','700','300']"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['180','120','120','140']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="btn-box">
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Book Ticket</span></a>
                                <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="theme-btn btn-style-two lightbox-image"><span class="btn-title">Video Demo</span></a>
                            </div>
                        </div>

                        <div class="tp-caption tp-resizeme" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,0]"
                        data-paddingright="[15,15,15,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-whitespace="normal"
                        data-width="['auto','auto','auto','100%']"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['0','0','0','0']"
                        data-x="['right','right','right','left']"
                        data-y="['middle','middle','middle','bottom']"
                        data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="time-counter-one">
                                <h6>Starting in:</h6>
                                <div class="time-countdown" data-countdown="2/2/2022"></div>
                            </div>
                        </div>
                    </li>

                    <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb=""  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        
                        <!-- MAIN IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="20" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="/assets/images/main-slider/1.jpg">


                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme big-ipad-hidden rs-parallaxlevel-4" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-150','-150','-150','-150']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-1.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-100','-100','-100','-100']"
                        data-voffset="['60','60','60','60']"
                        data-x="['left','left','left','left']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-2.png" alt=""></figure>
                        </div>
                        

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-60','-60','-60','-60']"
                        data-voffset="['100','100','100','100']"
                        data-x="['right','right','right','right']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-4.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-90','-90','-90','-90']"
                        data-voffset="['170','170','170','100']"
                        data-x="['right','right','right','right']"
                        data-y="['top','top','top','top']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-3.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-150','-150','-150','-150']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-5.png" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 ipad-hidden" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-30','-30','-30','-30']"
                        data-voffset="['50','50','50','50']"
                        data-x="['left','left','left','left']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="/assets/images/main-slider/icon/object-6.png" alt=""></figure>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['750','750','750','650']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-190','-190','-190','-190']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <span class="title"><span>5 Days</span>  -  <span>15 Talk</span>  -  <span>2 Parties</span></span>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['750','750','750','650']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-50','-80','-80','-80']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h2>World Digital <br>Conference</h2>
                        </div>

                        <div class="tp-caption" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-width="['700','750','700','450']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['90','30','30','40']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <ul class="event-info">
                                <li><i class="fa fa-map-marker"></i> California, USA</li>
                                <li><i class="fa fa-calendar"></i> January 20 To 25, 2022</li>
                            </ul>
                        </div>
                        
                        <div class="tp-caption tp-resizeme" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-whitespace="normal"
                        data-width="['650','650','700','300']"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['180','120','120','140']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="btn-box">
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Book Ticket</span></a>
                                <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="theme-btn btn-style-two lightbox-image"><span class="btn-title">Video Demo</span></a>
                            </div>
                        </div>

                        <div class="tp-caption tp-resizeme" 
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,0]"
                        data-paddingright="[15,15,15,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text"
                        data-height="none"
                        data-whitespace="normal"
                        data-width="['auto','auto','auto','100%']"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['0','0','0','0']"
                        data-x="['right','right','right','left']"
                        data-y="['middle','middle','middle','bottom']"
                        data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="time-counter-one">
                                <h6>Starting in:</h6>
                                <div class="time-countdown" data-countdown="2/2/2022"></div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    <!-- End Main Slider-->
    
    <!-- About Section -->
     <div id="abt"></div>
    <section class="about-section">
        <div class="auto-container">
            <div class="row">
                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="about-image-wrapper">
                        <figure class="image-3 wow zoomIn" data-wow-delay="900ms"><img src="/assets/images/resource/girl.png" alt=""/></figure>
                        <figure class="image-2 wow zoomIn" data-wow-delay="600ms"><img src="/assets/images/resource/writer.png" alt=""/></figure>
                        <figure class="image-1 wow zoomIn" data-wow-delay="300ms"><img src="/assets/images/resource/vector.png" alt=""/></figure>
                        <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-btn wow zoomIn" data-wow-delay="1200ms"><span class="icon fa fa-play"></span></a>
                    </div>
                </div>

                <!-- Content Column -->

                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">WELCOME TO FANTASIA ENTERTAINMENT</span>
                            <h2>Unique Experiences is what we do.... be it through dance, video, special effects or any other artform....</h2>
                            <span class="divider"></span>
                        </div>
                        <p> the sky is the limit and innovation is the source!</p>
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Book Ticket</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- Feature Section -->
    <div id="fea"></div>
    <section class="feature-section pt-0">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-1 wow fadeIn"></span>
        </div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Our Features</span>
                <h2>Features For Our Client <br />For Your Event</h2>
                <span class="divider"></span>
            </div>

            <div class="row">
                <!--Feature Block-->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="icon-box"><i class="icon flaticon-certificate-1"></i></div>
                        <h4>Confirm Speakers</h4>
                        <p>Dolor sit amet consectetur elit sed do eiusmod tempor incd.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <!--Feature Block-->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="icon flaticon-idea"></i></div>
                        <h4>Best Digital Ideas</h4>
                        <p>Dolor sit amet consectetur elit sed do eiusmod tempor incd.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <!--Feature Block-->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="icon flaticon-meeting"></i></div>
                        <h4>Networking People</h4>
                        <p>Dolor sit amet consectetur elit sed do eiusmod tempor incd.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <!--Feature Block-->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="icon flaticon-inspiration"></i></div>
                        <h4>Inspiring Keynotes</h4>
                        <p>Dolor sit amet consectetur elit sed do eiusmod tempor incd.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Section -->

    <!-- Fun Fact Section -->
    <section class="fun-fact-section">
        <div class="auto-container">
            <div class="fact-counter">
                <div class="row clearfix">
                    <!--Column-->
                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn">
                        <div class="inner-box">
                            <div class="count-box">
                                <span class="icon bg-1"></span>
                                <span class="count-text" data-speed="3000" data-stop="94">0</span>
                            </div>
                            <span class="counter-title">Meeting Tickets Affirmed </span>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="300ms">
                        <div class="inner-box">
                            <div class="count-box">
                                <span class="icon bg-2"></span>
                                <span class="count-text" data-speed="3000" data-stop="28">0</span>
                            </div>
                            <span class="counter-title">Universally Capable Speakers </span>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="600ms">
                        <div class="inner-box">
                            <div class="count-box">
                                <span class="icon bg-3"></span>
                                <span class="count-text" data-speed="3000" data-stop="35">0</span>
                            </div>
                            <span class="counter-title">Food Espresso and Studio Breaks </span>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="900ms">
                        <div class="inner-box">
                            <div class="count-box">
                                <span class="icon bg-4"></span>
                                <span class="count-text" data-speed="3000" data-stop="65">0</span>
                            </div>
                            <span class="counter-title">Supporters Prepared To Take an interest</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End Fun Fact Section -->

    <!-- Speakers Section -->
    <div id="speak"></div>
    <section class="speakers-section">
        <div class="anim-icons full-width">
            <span class="icon icon-dotted-circle"></span>
        </div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Our SPEAKERS</span>
                <h2>Speakers Who Are Exparts <br>in Their Fields</h2>
                <span class="divider"></span>
            </div>

            <div class="row">
                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-1.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Patrick Spencer</a></h4>
                            <span class="designation">S&P Analyzer</span>
                        </div>
                    </div>
                </div>

                 <!-- Speaker block -->
                 <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-2.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Matthew White</a></h4>
                            <span class="designation">Facebook's Co-Founder</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-3.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Michael Dover</a></h4>
                            <span class="designation">Starbuck's CEO</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-4.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Angelina Holy</a></h4>
                            <span class="designation">Maxii's Manager</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-5.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Janet Jones</a></h4>
                            <span class="designation">Newyork Post's GM</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-6.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Michael Dover</a></h4>
                            <span class="designation"> Starbuck's CEO</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="/assets/images/resource/speaker-7.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Jonathan Elves</a></h4>
                            <span class="designation"> Maxii's Manager</span>
                        </div>
                    </div>
                </div>

                <!-- Speaker block -->
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">
                    <div class="inner-box">
                        <div class=" image-box">
                            <figure class="image image-2"><a href="#"><img src="/assets/images/resource/speaker-2.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Mike Michael</a></h4>
                            <span class="designation">Softer Manager</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Speakers Section -->

    <!-- Schedule Section -->
     <div id="schedule"></div>
    <section class="schedule-section">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-2"></span>
        </div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Thought leadership</span>
                <h2>Join the world's leading companies <br>at Technology Conference</h2>
                <span class="divider"></span>
            </div>

            <div class="schedule-tabs tabs-box">
                <div class="btns-box">
                    <!--Tabs Box-->
                    <ul class="tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">
                            <span class="day">1st Day</span>
                            <div class="date-box">
                                <span class="date">25</span>
                                <span class="month"><span class="colored">Jan</span> 2022</span>
                            </div>
                        </li>

                        <li class="tab-btn" data-tab="#tab-2">
                            <span class="day">2nd Day</span>
                            <div class="date-box">
                                <span class="date">26</span>
                                <span class="month"><span class="colored">Jan</span> 2022</span>
                            </div>
                        </li>

                        <li class="tab-btn" data-tab="#tab-3">
                            <span class="day">3rd Day</span>
                            <div class="date-box">
                                <span class="date">27</span>
                                <span class="month"><span class="colored">Jan</span> 2022</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <!--Tab-->
                    <div class="tab active-tab" id="tab-1">
                        <div class="schedule-timeline">
                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>8.00 AM <br> 10.00 AM</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-1.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Tripp Mckay</h5>
                                            <span class="designation">Historian</span>
                                        </div>
                                        <h4><a href="#">Social Profit from Venture (SROI) Gathering</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-2.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Milana Myles</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Marine and Oceanic Government Workers</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-3.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Gabrielle Winn</h5>
                                            <span class="designation">Insurance consultant</span>
                                        </div>
                                        <h4><a href="#">Home Life Open Entryway Open Occasion of 21</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>12:00 pm <br>01:00 pm</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-4.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Rene Wells</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Developing Force Legislative issues of Arctics Motivation</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Tab-->
                    <div class="tab" id="tab-2">
                        <div class="schedule-timeline">
                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>8.00 AM <br> 10.00 AM</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-1.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Tripp Mckay</h5>
                                            <span class="designation">Historian</span>
                                        </div>
                                        <h4><a href="#">Social Profit from Venture (SROI) Gathering</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-2.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Milana Myles</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Marine and Oceanic Government Workers</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-3.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Gabrielle Winn</h5>
                                            <span class="designation">Insurance consultant</span>
                                        </div>
                                        <h4><a href="#">Home Life Open Entryway Open Occasion of 21</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>12:00 pm <br>01:00 pm</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-4.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Rene Wells</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Developing Force Legislative issues of Arctics Motivation</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Tab-->
                    <div class="tab" id="tab-3">
                        <div class="schedule-timeline">
                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>8.00 AM <br> 10.00 AM</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-1.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Tripp Mckay</h5>
                                            <span class="designation">Historian</span>
                                        </div>
                                        <h4><a href="#">Social Profit from Venture (SROI) Gathering</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-2.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Milana Myles</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Marine and Oceanic Government Workers</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>10:00 am <br>11:00 am</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-3.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Gabrielle Winn</h5>
                                            <span class="designation">Insurance consultant</span>
                                        </div>
                                        <h4><a href="#">Home Life Open Entryway Open Occasion of 21</a></h4>
                                    </div>
                                </div>
                            </div>

                            <!-- schedule Block -->
                            <div class="schedule-block even">
                                <div class="inner-box">
                                    <div class="inner">
                                        <div class="date">
                                            <span>12:00 pm <br>01:00 pm</span>
                                        </div>
                                        <div class="speaker-info">
                                            <figure class="thumb">
                                                <img src="/assets/images/resource/thumb-4.jpg" alt="">
                                            </figure>
                                            <span class="icon fa fa-microphone"></span>
                                            <h5 class="name">Rene Wells</h5>
                                            <span class="designation">Art Critic</span>
                                        </div>
                                        <h4><a href="#">Developing Force Legislative issues of Arctics Motivation</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End schedule Section -->

    <!-- Call to Action -->
    <section class="call-to-action" style="background-image: url(images/background/1.jpg);">
        <div class="anim-icons full-width">
            <span class="icon icon-dotted-world left"></span>
            <span class="icon icon-dotted-world right"></span>
        </div>

        <div class="auto-container">
            <div class="content-box wow fadeInUp">
                <h2>Get Ticket Now! </h2>
                <span class="text">Experience the conference wherever you are. Register now for online access. Tune in live for the keynotes and watch sessions on demand. Also be sure to join our event</span>
                <a href="#" class="theme-btn btn-style-two"><span class="btn-title">Book Ticket</span></a>
            </div>
        </div>
    </section>
    <!-- End Call to Action -->

    <!-- Pricing Section -->
    <section class="pricing-section">
       <div class="auto-container">
           <div class="sec-title text-center">
               <span class="sub-title">GET TICKET</span>
               <h2>Explore Flexible Pricing Plans <br />
                Choose a Ticket</h2>
               <span class="divider"></span>
           </div>

           <div class="row">
                <!-- Pricing block -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp"  data-wow-delay="400ms">
                    <div class="inner-box">
                        <span class="title">Regular Plan</span>
                        <h3>Standard Pass</h3>
                        <div class="price"> <sup>$</sup>200<sub>USD</sub></div>
                        <ul class="features">
                            <li>Concert Attendance</li>
                            <li>20 Lottery Ticket</li>
                            <li>Priority Seating</li>
                            <li>5 Person Entry</li>
                            <li>Certificate</li>
                            <li>T-Shart</li>
                        </ul>
                        <button class="theme-btn btn-style-one"><span class="btn-title">Buy Ticket</span></button>
                    </div>
                </div>

                <!-- Pricing block -->
                <div class="pricing-block tagged col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <span class="title">Business Plan</span>
                        <h3>Flexible Pass</h3>
                        <div class="price"> <sup>$</sup>400<sub>USD</sub></div>
                        <ul class="features">
                            <li>Concert Attendance</li>
                            <li>40 Lottery Ticket</li>
                            <li>Priority Seating</li>
                            <li>7 Person Entry</li>
                            <li>Certificate</li>
                            <li>T-Shart</li>
                        </ul>
                        <button class="theme-btn btn-style-two"><span class="btn-title">Buy Ticket</span></button>
                    </div>
                </div>

                <!-- Pricing block -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="inner-box">
                        <span class="title">Enterprise Plan</span>
                        <h3>Fabulously Pass</h3>
                        <div class="price"> <sup>$</sup>600<sub>USD</sub></div>
                        <ul class="features">
                            <li>Concert Attendance</li>
                            <li>70 Lottery Ticket</li>
                            <li>Priority Seating</li>
                            <li>9 Person Entry</li>
                            <li>Certificate</li>
                            <li>T-Shart</li>
                        </ul>
                        <button class="theme-btn btn-style-one"><span class="btn-title">Buy Ticket</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Section -->

     <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">
            <div class="sec-title">
                <span class="sub-title">News & blogs</span>
                <h2>Latest From Newsroom</h2>
                <span class="divider"></span>
            </div>

            <div class="row">
                <!-- News Block -->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight">
                    <div class="inner-box">
                        <div class="image-box">
                            <span class="tag">Participants</span>
                            <figure class="image"><a href="#"><img src="/assets/images/resource/news-1.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <div class="author">
                                <figure class="thumb"><img src="/assets/images/resource/author-thumb-1.jpg" alt=""></figure>
                                <h5 class="name">Thomas Albart</h5>
                            </div>
                            <h4><a href="#">Chances are Good That There’s a Cloud Software as </a></h4>
                            <div class="text">Single stroke at the present moment and yet I feel that lorem quis bibendum auctor.</div>
                            <ul class="post-info">
                                <li><span class="far fa-calendar"></span> 21/08/2021</li>
                                <li><span class="far fa-comments"></span> 02 Comments</li>
                            </ul>    
                        </div>
                    </div>
                </div>

                <!-- News Block Three -->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="400ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <span class="tag">Virtual</span>
                            <figure class="image"><a href="#"><img src="/assets/images/resource/news-2.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <div class="author">
                                <figure class="thumb"><img src="/assets/images/resource/author-thumb-2.jpg" alt=""></figure>
                                <h5 class="name">Jamika Lora</h5>
                            </div>
                            <h4><a href="#">Chances are Good That There’s a Cloud Software as </a></h4>
                            <div class="text">Single stroke at the present moment and yet I feel that lorem quis bibendum auctor.</div>
                            <ul class="post-info">
                                <li><span class="far fa-calendar"></span> 21/08/2021</li>
                                <li><span class="far fa-comments"></span> 02 Comments</li>
                            </ul>    
                        </div>
                    </div>
                </div>

                <!-- News Block Three -->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="800ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <span class="tag">Marketing</span>
                            <figure class="image"><a href="#"><img src="/assets/images/resource/news-3.jpg" alt=""></a></figure>
                        </div>
                        <div class="lower-content">
                            <div class="author">
                                <figure class="thumb"><img src="/assets/images/resource/author-thumb-3.jpg" alt=""></figure>
                                <h5 class="name">Nicky Monitor</h5>
                            </div>
                            <h4><a href="#">We Have Top Executive and Start Up Here Event 2021</a></h4>
                            <div class="text">Single stroke at the present moment and yet I feel that lorem quis bibendum auctor.</div>
                            <ul class="post-info">
                                <li><span class="far fa-calendar"></span> 21/08/2021</li>
                                <li><span class="far fa-comments"></span> 02 Comments</li>
                            </ul>    
                        </div>
                    </div>
                </div>
            </div>

            <div class="sec-bottom-text"><div class="text">if you want to more Updates <a href="#">click here</a> now.</div></div>
        </div>
    </section>
    <!--End News Section -->


    <!--Clients Section-->
    <section class="clients-section">
        <div class="auto-container">
            <div class="row">
                <!-- Title Column -->
                <div class="title-column col-xl-3 col-lg-4 col-md-12">
                    <div class="sec-title">
                        <span class="sub-title">Clients</span>
                        <h2>Our Official <br>Sponsors</h2>
                        <div class="divider"></div>
                        <div class="text">We have dedicated tracks for every industry Whether you want to hire tech’s top talent.</div> 
                        <a href="#" class="theme-btn btn-style-one mt-4"><span class="btn-title">Buy Ticket</span></a>
                    </div>
                </div>

                <!-- Title Column -->
                <div class="title-column col-xl-9 col-lg-8 col-md-12">
                    <div class="sponsors-outer">
                        <div class="row">
                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/1.jpg" alt=""></a></figure>
                            </div>

                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="300ms">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/2.jpg" alt=""></a></figure>
                            </div>

                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="600ms">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/3.jpg" alt=""></a></figure>
                            </div>

                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="900ms">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/4.jpg" alt=""></a></figure>
                            </div>

                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="1200ms">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/5.jpg" alt=""></a></figure>
                            </div>

                            <!-- Client Block -->
                            <div class="client-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="1500ms">
                                <figure class="image-box"><a href="#"><img src="/assets/images/clients/6.jpg" alt=""></a></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Clients Section-->


    <!-- Subscribe Section -->
    <section class="subscribe-section">
        <div class="auto-container">
            <div class="row">
                <div class="title-column col-lg-5 col-md-12">
                    <span class="title">Don’t miss our future updates!</span>
                    <h3> Get subscribed today!</h3>
                </div>

                <div class="form-column col-lg-7 col-md-12">
                    <!--Newsletter Form-->
                    <div class="newsletter-form">
                        <form method="post" action="#">
                            <div class="form-group">
                                <input type="email" name="field-name" value="" placeholder="Get subscribed today!" required>
                                <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Submit Now</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Subscribe Section -->

@endsection

@section('script')

<script type="text/javascript">
    $(window).on('load', function(e) {
        e.stopPropagation();
        $('#staticBackdrop').modal('toggle');
    });
</script>
    
@endsection
