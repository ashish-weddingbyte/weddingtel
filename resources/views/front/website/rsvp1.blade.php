<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Basic Page Needs
        ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Specific Meta
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Wedding Website | weddingbyte.com">
    <meta name="keywords" content="bride, business, couple, directory, groom, listing, login, map, marketing, realwedding, registration, rsvp, vendor, wedding, wedding planner">
    <meta name="author" content="weddingbyte">
    <meta name="MobileOptimized" content="320" />

    <!-- Titles
        ================================================== -->
    <title>Wedding Website | weddingbyte.com</title>

    <!-- Favicons
        ================================================== -->
    <link rel="icon" href="{{ asset('front/images/favicon/favicon-32x32.png' ) }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('front/images/favicon/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ asset('front/images/favicon/favicon2.ico' ) }}">

    <!-- CSS ( Bootstrap + Owlcarouses + Fontawesome + Animate + Select2 + Custom Style )
        ======================================================================================= -->
    <link href="{{ asset('front/library/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/fontawesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/owlcarousel/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/couple-website/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/admin.css') }}" rel="stylesheet">



</head>
<!-- end head -->
<!--body start-->

<body id="page-top">

    

    <div class="container-fluid admin-bar">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 text-center">
                <a href="#" class="btn admin-button">Edit</a>
            </div>
            <div class="col-4 col-md-4 col-lg-4 text-center">
                <a href="#" class="btn admin-button">Preview</a>
            </div>
            <div class="col-4 col-md-4 col-lg-4 text-center">
                <a href="#" class="btn admin-button">Share</a>
            </div>
        </div>
    </div>

    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md bg-dark header-anim" id="mainNav">
            <div class="logo-wrap">

                <!-- Toggle Button Start -->
                <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Toggle Button End -->
            </div>
            <div class="container">                
                
                <div class="collapse navbar-collapse justify-content-md-center" id="navbarResponsive">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#page-top">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#couple">Couple</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#our-story">Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#when-where">When & Where</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    
    <!--  Home Banner Start -->
    <section class="home-background" style="background: url({{ asset('front/library/couple-website/images/slider_img_1.jpg') }}) no-repeat">
        <div class="home-content">
            <div class="container">
                <div class="name">
                    <h1>{{ $user->name }} <i class="weddingdir_heart_ring"></i> {{ $details->partner_name }}</h1>
                    <em>Are getting Married!</em>
                    <div class="date">
                        <h3>{{ date('D - d F Y',strtotime($details->event)) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Home Banner End -->

    <div id="body-content">

        <!--  The Couple Start -->
        <section id="couple" class="wide-tb-120 bg-light">
            <div class="container">
                <div class="section-title text-center">
                    <h1>The Couple</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="text-center">
                            <img src="{{ asset('front/library/couple-website/images/couple-img.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 order-lg-13">
                        <div class="couple-info">
                            <!-- <span>Groom</span> -->
                            <h3>{{ $user->name }}</h3>
                            <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum me.</p>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 order-lg-2">
                        <div class="couple-info">
                            <!-- <span>Bride</span> -->
                            <h3>{{ $details->partner_name }}</h3>
                            <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum me.</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  The Couple End -->

        <!--  Our Story Start -->
        <section id="our-story" class="wide-tb-120 pb-0">
            <div class="container broken-layout">
                <div class="section-title text-center">
                    <h1>Our Story</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>
                <div class="story-timeline">
                    <div class="dot-top"></div>
                    <div class="dot-bottom"></div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="timeline-box left-box">
                                <div class="date">
                                    29<span>Nov</span>
                                </div>
                                <div class="head-img">
                                    <img src="{{ asset('front/library/couple-website/images/timeline_img_1.png')}}" alt="">
                                    <h3>First meet</h3>
                                </div>
                                <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="heart-icon">
                                <i class="weddingdir_ballon_heart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-6 order-md-last">
                            <div class="timeline-box right-box">
                                <div class="date">
                                    15 <span>Jan</span>
                                </div>
                                <div class="head-img">
                                    <img src="{{ asset('front/library/couple-website/images/timeline_img_2.png')}}" alt="">
                                    <h3>Ring Ceremoney</h3>
                                </div>
                                <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="heart-icon">
                                <i class="weddingdir_ballon_heart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="timeline-box left-box">
                                <div class="date">
                                    05<span>Feb</span>
                                </div>
                                <div class="head-img">
                                    <img src="{{ asset('front/library/couple-website/images/timeline_img_3.png')}}" alt="">
                                    <h3>Wedding Party</h3>
                                </div>
                                <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="heart-icon">
                                <i class="weddingdir_ballon_heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="story-blockquote">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <blockquote>
                                Better to have loved and lost, than to have never loved at all.
                                <footer><cite title="Source Title">~ St. Augustine ~</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-countdown bg-dark ">
                <div class="container counter-class">
                    <ul id="wedding-countdown" class="counter-class list-unstyled list-inline" data-date="{{ date('Y-m-d H:i:s',strtotime($details->event)) }}">
                        <li class="list-inline-item"><span class="counter-days"></span><div class="days_text">Days</div></li>
                        <li class="list-inline-item"><span class="counter-hours"></span><div class="hours_text">Hours</div></li>
                        <li class="list-inline-item"><span class="counter-minutes"></span><div class="minutes_text">Minutes</div></li>
                        <li class="list-inline-item"><span class="counter-seconds"></span><div class="seconds_text">Seconds</div></li>
                    </ul>
                </div>
            </div>
        </section>
        <!--  Our Story End -->

        <!--  Wedding Place Start -->
        <section id="when-where" class="wide-tb-120">
            <div class="container">
                <div class="section-title text-center">
                    <h1>When & Where</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="when-where-box">
                            <div class="place-icon">
                                <i class="weddingdir_hanging_heart"></i>
                            </div>
                            <h3>Wedding Ceremony</h3>
                            <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                            <div class="img">
                                <div class="place-info">
                                    Sunday, 14 February, 2016 — 10.00 AM — St. Peter Park, Kuta, Bali
                                </div>
                                <img src="{{ asset('front/library/couple-website/images/place_1.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="when-where-box">
                            <div class="place-icon">
                                <i class="weddingdir_wine"></i>
                            </div>
                            <h3>Wedding Party</h3>
                            <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                            <div class="img">
                                <div class="place-info bg-primary">
                                    Sunday, 14 February, 2016 — 10.00 AM — St. Peter Park, Kuta, Bali
                                </div>
                                <img src="{{ asset('front/library/couple-website/images/place_1.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  Wedding Place End -->

        

        

        <!--  Will You Attend Start -->
        <section class="will-you-attend">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="head">
                            <h1>Will You Attend?</h1>
                            <p><span>Kindly respond before 30 August</span></p>
                            <i class="weddingdir_cake_stand"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rsvp-form">
                            <div class="head">
                                <h5>R.S.V.P.</h5>
                                <img src="{{ asset('front/library/couple-website/images/flower_art.png')}}" alt="">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="First and last name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="state">
                                    <option>Select Option</option>
                                    <option value="AL">1</option>
                                    <option value="WY">2</option>
                                    <option value="WY">3</option>
                                    <option value="WY">More than 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea rows="6" placeholder="Your message" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <p><strong class="txt-orange">Meal preference</strong></p>

                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">Vegetarian</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Non-Vegetarian</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline3">Both</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-block">Sign your RSVP</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--  Will You Attend End -->

        

        

       
        <!--  Captured Moments Start -->
        <section class="wide-tb-120 captured-moments" id="gallery">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Captured Moments</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="portfolio-flters" class="list-unstyled">
                            <li data-filter="*" class="filter-active"><a href="javascript:">All Photos</a></li>
                            <li data-filter=".engagement"><a href="javascript:">Engagement</a></li>
                            <li data-filter=".prewedding"><a href="javascript:">Pre Wedding</a></li>
                            <li data-filter=".withfriends"><a href="javascript:">With Friends</a></li>
                        </ul>
                    </div>
                </div>
                <div class="isotope-gallery captured-img-gallery row">
                    <div class="gallery-item col-lg-3 col-md-6 col-12 engagement">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_1.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_1.jpg')}}" class="rounded" alt="">
                            </a>                                            
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 prewedding">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_2.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_2.jpg')}}" class="rounded" alt="">
                            </a>                                            
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 withfriends">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_3.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_3.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 engagement">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_4.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_4.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 prewedding">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_5.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_5.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 withfriends">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_6.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_6.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 prewedding">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_7.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_7.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-lg-3 col-md-6 col-12 engagement">
                        <div class="captured-gallery-item">
                            <a href="{{ asset('front/library/couple-website/images/gallery_img_8.jpg')}}" title="Title Come here">
                                <img src="{{ asset('front/library/couple-website/images/gallery_img_8.jpg')}}" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--  Captured Moments End -->

        
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="text">
                <h3>Just Get Married</h3>
                <h1>{{ $user->name }} <i class="weddingdir_heart_ring"></i> {{ $details->partner_name }}</h1>
                <img src="{{ asset('front/library/couple-website/images/flower_art_2.png')}}" alt="">
            </div>
            <div class="copyrights">
                Copyright © {{ date('Y') }} — Designed by <a href="{{ url('/') }}">weddingbyte.com</a>
            </div>
        </div>
    </footer>

    <!-- Back to Top
    ================================================== -->
    <a id="back-to-top" href="javascript:" class="btn btn-outline-primary back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/library/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('front/library/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="{{ asset('front/library/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('front/library/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/library/countdown/js/loopcounter.js') }}"></script> 
    <script src="{{ asset('front/library/isotope-layout/isotope.pkgd.min.js') }}"></script> 
    <script src="{{ asset('front/library/datepicker/js/datepicker.js') }}"></script> 
    <script src="{{ asset('front/library/couple-website/js/script.js') }}"></script>

    <script src="{{ asset('front/library/slide-reveal/jquery.slidereveal.min.js') }}"></script>

</body>

</html>