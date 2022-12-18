<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SalesApp</title>
    <!-- Stylesheets -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
    <link href="/assets/plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
    <link href="/assets/plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">
    <!--Color Switcher Mockup-->
    <link href="/assets/css/color-switcher-design.css" rel="stylesheet">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="/assets/js/respond.js"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Main Header-->
        <header class="main-header header-style-two">

            <!-- Header top -->
            <div class="header-top">
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="top-left">
                            <ul class="contact-list-two">
                                <!-- <li><strong>Address</strong> 203 Madison Ave, NY, USA </li>
                                <li><strong>Timing</strong> Monday - Friday 9am - 6pm </li> -->
                            </ul>
                        </div>

                        <div class="top-right">
                            <ul class="social-icon-three">
                                <li><a href="#"><span class="fab fa-dribbble"></span></a></li>
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Top -->

            <!-- Header Lower -->
            <div class="header-lower">
                <div class="auto-container">
                    <!-- Main box -->
                    <div class="main-box">
                        <div class="logo-box">
                            <div class="logo">
                                <!-- <a href="{{route('home')}}"><img src="/assets/images/logo.jpg" alt="" title=""></a> -->
                            </div>
                        </div>

                        <div class="nav-outer">

                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-md">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li><a href="#hme">Home</a></li>
                                        <li><a href="#abt">About</a></li>
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>

                            <!-- Main Menu End-->
                            <div class="outer-box clearfix">
                                <!-- Search Btn -->
                                <div class="search-box-btn search-btn search-box-outer"><span class="icon fa fa-search"></span></div>

                                <!-- Quote Btn -->
                                <div class="btn-box">
                                    <a href="#" class="theme-btn btn-style-one"><span class="btn-title"> Get Quote</span></a>
                                </div>

                                <button class="nav-toggler"><i class="flaticon flaticon-menu-2"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="auto-container">

                    <div class="main-box">
                        <div class="logo-box">
                            <div class="logo">
                                <!-- <a href="/"><img src="/assets/images/logo.jpg" alt="" title=""></a> -->
                            </div>
                            <div class="upper-right">
                                <div class="search-box">
                                    <button class="search-btn mobile-search-btn"><i class="flaticon-search-2"></i></button>
                                </div>
                                <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>
                            </div>
                        </div>

                        <!--Keep This Empty / Menu will come through Javascript-->
                    </div>
                </div>
            </div><!-- End Sticky Menu -->

            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="logo">
                    <!-- <a href="{{route('home')}}"><img src="/assets/images/logo.jpg" alt="" title=""></a> -->
                </div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <div class="outer-box">
                        <!-- Search Btn -->
                        <div class="search-box">
                            <button class="search-btn mobile-search-btn"><i class="flaticon-search-2"></i></button>
                        </div>

                        <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>

                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                <nav class="menu-box">
                    <div class="upper-box">
                        <div class="nav-logo">
                            <!-- <a href="{{route('home')}}"><img src="/assets/images/logo.jpg" alt="" title=""></a> -->
                        </div>
                        <div class="close-btn"><i class="icon flaticon-close"></i></div>
                    </div>

                    <ul class="navigation clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </ul>

                    <ul class="contact-list-one">
                        <!-- <li><i class="flaticon-location"></i> 203 Madison Ave, NY, USA <strong>Address</strong></li>
                        <li><i class="flaticon-alarm-clock-1"></i>Monday - Friday 9am - 6pm <strong>Timing</strong></li>
                        <li><i class="flaticon-email-1"></i> <a href="mailto:info@salesapp.com">info@salesapp.com</a> <strong>Mail to us</strong></li> -->
                    </ul>

                    <ul class="social-links">
                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fab fa-pinterest"></span></a></li>
                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fab fa-dribbble"></span></a></li>
                    </ul>
                </nav>
            </div><!-- End Mobile Menu -->

            <!-- Header Search -->
            <div class="search-popup">
                <button class="close-search"><i class="flaticon-close"></i></button>
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search" required="">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- End Header Search -->

        </header>
        <!--End Main Header -->

        <!-- Hidden bar back drop -->
        <div class="form-back-drop"></div>

        <!-- Hidden Bar -->
        <section class="hidden-bar">
            <div class="inner-box">
                <div class="title-box">
                    <h2>Contact Us</h2>
                    <div class="cross-icon"><span class="fa fa-times"></span></div>
                </div>

                <!--Appointment Form-->
                <div class="form-style-one">
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="username" placeholder="Your Name *">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="email" placeholder="Your Email *">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="phone" value="" placeholder="Your Phone*" required>
                        </div>
                        <div class="form-group">
                            <textarea name="contact_message" class="message" placeholder="Text Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="theme-btn btn-style-one" type="button" id="submit" name="submit-form"><span class="btn-title">Submit Now</span> </button>
                        </div>
                    </form>
                </div>

                <ul class="contact-list-one">
                    <!-- <li><i class="flaticon-location"></i> 203 Madison Ave, NY, USA <strong>Address</strong></li>
                    <li><i class="flaticon-alarm-clock-1"></i>Monday - Friday 9am - 6pm <strong>Timing</strong></li>
                    <li><i class="flaticon-email-1"></i> <a href="mailto:info@salesapp.com">info@salesapp.com</a> <strong>Mail to us</strong></li> -->
                </ul>
            </div>
        </section>
        <!--End Hidden Bar -->

        @yield('main')

        <!-- Main Footer -->
        <div id="contact"></div>
        <footer class="main-footer">
            <div class="auto-container">
                <!-- Footer Content -->
                <div class="footer-content wow fadeInUp">
                    <div class="text-center">
                        <div class="footer-logo">
                            <!-- <a href="#"><img src="/assets/images/logo.jpg" alt=""></a> -->
                        </div>
                        <!-- <div class="text">We have very good strength in innovative technology and tools with over 35 years of experience. We makes long-term investments goal in global companies in different sectors, mainly in Europe and other countries.</div> -->
                    </div>
                    <ul class="social-icon-two">
                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fab fa-pinterest"></span></a></li>
                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fab fa-dribbble"></span></a></li>
                    </ul>

                    <ul class="contact-list-one">
                        <!-- <li><i class="flaticon-location"></i> 203 Madison Ave, NY, USA <strong>Address</strong></li>
                        <li><i class="flaticon-alarm-clock-1"></i>Monday - Friday 9am - 6pm <strong>Timing</strong></li>
                        <li><i class="flaticon-email-1"></i> <a href="mailto:info@salesapp.com">info@salesapp.com</a> <strong>Mail to us</strong></li> -->
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner-container">
                        <ul class="footer-nav">
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>

                        <div class="copyright-text">
                            <p>Copyright © 2022 All Rights Reserved by <a href="https://technixserv.com/" target=_blank>Technixserv</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div>
    <!-- End Page Wrapper -->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <!--Revolution Slider-->
    <script src="/assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="/assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="/assets/js/main-slider-script.js"></script>
    <!--Revolution Slider-->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.fancybox.js"></script>
    <script src="/assets/js/jquery.countdown.js"></script>
    <script src="/assets/js/appear.js"></script>
    <script src="/assets/js/owl.js"></script>
    <script src="/assets/js/wow.js"></script>
    <script src="/assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    var hash = this.hash;

                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>

    @yield('script')

    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.9.0/firebase-app.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyC3_gj12-5MxiWDfAiMUebWN1fodKusRAY",
            authDomain: "m-app-bc74c.firebaseapp.com",
            projectId: "m-app-bc74c",
            storageBucket: "m-app-bc74c.appspot.com",
            messagingSenderId: "331439146240",
            appId: "1:331439146240:web:ebd65e06e732da3a56dfe5"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
    </script>

</body>

</html>