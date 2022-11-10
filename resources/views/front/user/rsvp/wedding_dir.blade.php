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
    <meta name="description" content="WeddingDir - Wedding Directory HTML Template">
    <meta name="keywords" content="bride, business, couple, directory, groom, listing, login, map, marketing, realwedding, registration, rsvp, vendor, wedding, wedding planner">
    <meta name="author" content="wp-organic">
    <meta name="MobileOptimized" content="320" />

    <!-- Titles
        ================================================== -->
    <title>weddingbyte.com</title>

    <!-- Favicons
        ================================================== -->
    <link rel="icon" href="{{ asset('front/images/favicon/favicon-32x32.png' ) }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('front/images/favicon/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ asset('front/images/favicon/favicon2.ico' ) }}">

    <!-- CSS ( Bootstrap + Owlcarouses + Fontawesome + Animate + Select2 + Custom Style )
        ======================================================================================= -->
    <link href="{{ asset('front/library/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/fontawesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/owlcarousel/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('front/library/couple-website/css/style.css') }}" rel="stylesheet">


</head>
<!-- end head -->
<!--body start-->

<body id="page-top">

    <!-- preloader -->
    <div class="preloader">
        <div class="status">
            <img src="assets/images/logo_light.svg" alt="">
        </div>
    </div>
    <!-- end preloader -->

    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md fixed-top header-anim" id="mainNav">
            <div class="logo-wrap">
                <a class="navbar-brand js-scroll-trigger" href="index.html"><img src="assets/images/logo_light.svg" alt=""></a>
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
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#latest-news">Latest News</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!--  Home Banner Start -->
    <section class="home-background">
        <div class="home-content">
            <div class="container">
                <div class="name">
                    <h1>Hitesh <i class="weddingdir_heart_ring"></i> Priyanka</h1>
                    <em>Are getting Married!</em>
                    <div class="date">
                        <h3>Friday - 11 December 2020</h3>
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
                            <span>Groom</span>
                            <h3>Hitesh</h3>
                            <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum me.</p>
                            <div class="social-icons">
                                <ul class="list-unstyled">
                                    <li><a href="javascript:"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:"><i class="fa fa-instagram"></i></a>
                                    </li><li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 order-lg-2">
                        <div class="couple-info">
                            <span>Bride</span>
                            <h3>Priyanka</h3>
                            <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum me.</p>
                            <div class="social-icons">
                                <ul class="list-unstyled">
                                    <li><a href="javascript:"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:"><i class="fa fa-instagram"></i></a>
                                    </li><li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
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

            <div class="bg-countdown bg-dark">
                <div class="container">
                    <ul id="wedding-countdown" class="list-unstyled list-inline">
                        <li class="list-inline-item"><span class="days">00</span><div class="days_text">Days</div></li>
                        <li class="list-inline-item"><span class="hours">00</span><div class="hours_text">Hours</div></li>
                        <li class="list-inline-item"><span class="minutes">00</span><div class="minutes_text">Minutes</div></li>
                        <li class="list-inline-item"><span class="seconds">00</span><div class="seconds_text">Seconds</div></li>
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

        <!--  Wedding Location Start -->
        <section>
            <div id="map-holder">
                <div id="map_extended" class="location-map-wrap">
                    <p>This will be replaced with the Google Map.</p>
                </div>
            </div>
        </section>
        <!--  Wedding Location End -->

        <!--  Gift Registry Start -->
        <section class="wide-tb-120">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Gift Registry</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>    
                <div class="owl-carousel owl-theme dots-black" id="slider-partners">                        
                    <!-- Partners Slider Images -->
                    <div class="item">
                        <div class="partners-slider">
                            <img src="{{ asset('front/images/partners/partners_img_1.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Partners Slider Images -->

                    <!-- Partners Slider Images -->
                    <div class="item">
                        <div class="partners-slider">
                            <img src="{{ asset('front/images/partners/partners_img_2.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Partners Slider Images -->

                    <!-- Partners Slider Images -->
                    <div class="item">
                        <div class="partners-slider">
                            <img src="{{ asset('front/images/partners/partners_img_3.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Partners Slider Images -->

                    <!-- Partners Slider Images -->
                    <div class="item">
                        <div class="partners-slider">
                            <img src="{{ asset('front/images/partners/partners_img_4.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Partners Slider Images -->

                    <!-- Partners Slider Images -->
                    <div class="item">
                        <div class="partners-slider">
                            <img src="{{ asset('front/images/partners/partners_img_5.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Partners Slider Images -->
                    
                </div>
            </div>
        </section>
        <!--  Gift Registry End -->

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
                                <select class="theme-combo" name="state">
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

        <!--  The Groomsmen Start -->
        <section class="wide-tb-120">
            <div class="container">
                <div class="section-title text-center">
                    <h1>The Groomsmen</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_1.jpg')}}" alt="">
                            <h4>Donald Morrison</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_2.jpg')}}" alt="">
                            <h4>Donald Morrison</h4>
                        </div>
                    </div>
                    <div class="col-md-12 spacer-30 d-md-block d-lg-none d-none">&nbsp;</div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_3.jpg')}}" alt="">
                            <h4>Donald Morrison</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_4.jpg')}}" alt="">
                            <h4>Donald Morrison</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  The Groomsmen End -->

        <!--  The Bridesmaids Start -->
        <section class="wide-tb-120 pt-0">
            <div class="container">
                <div class="section-title text-center">
                    <h1>The Bridesmaids</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_5.jpg')}}" alt="">
                            <h4>Martha Pearson</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_6.jpg')}}" alt="">
                            <h4>Martha Pearson</h4>
                        </div>
                    </div>
                    <div class="col-md-12 spacer-30 d-md-block d-lg-none d-none">&nbsp;</div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_7.jpg')}}" alt="">
                            <h4>Martha Pearson</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="friends-members">
                            <img src="{{ asset('front/library/couple-website/images/friends_img_8.jpg')}}" alt="">
                            <h4>Martha Pearson</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  The Bridesmaids End -->

        <!--  What They Say Start -->
        <section class="what-they-say">
            <div class="container">
                <div class="section-title text-center">
                    <h1>What THey Say</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-12 mx-auto">
                        <div class="testimonail-slider">
                            <div class="owl-carousel owl-theme" id="slider-testimonail">                        
                                <!-- Testimonail Quotes -->
                                <div class="item">
                                    <div class="testimonail-quotes">
                                        <div class="text">
                                            A man's got two shots for jewelry: a wedding ring and a watch. The watch is a lot easier to get on and off than a wedding ring.
                                        </div>
                                        <div class="name">~ John Mayer ~</div>
                                    </div>
                                </div>
                                <!-- Testimonail Quotes -->
                                
                                <!-- Testimonail Quotes -->
                                <div class="item">
                                    <div class="testimonail-quotes">
                                        <div class="text">
                                            A man's got two shots for jewelry: a wedding ring and a watch. The watch is a lot easier to get on and off than a wedding ring.
                                        </div>
                                        <div class="name">~ John Mayer ~</div>
                                    </div>
                                </div>
                                <!-- Testimonail Quotes -->
                                
                                <!-- Testimonail Quotes -->
                                <div class="item">
                                    <div class="testimonail-quotes">
                                        <div class="text">
                                            A man's got two shots for jewelry: a wedding ring and a watch. The watch is a lot easier to get on and off than a wedding ring.
                                        </div>
                                        <div class="name">~ John Mayer ~</div>
                                    </div>
                                </div>
                                <!-- Testimonail Quotes -->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--  What They Say End -->

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

        <!--  Latest News & Updates Start -->
        <section class="wide-tb-120" id="latest-news">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Latest News & Updates</h1>
                    <p class="sub-head">We are so excited to celebrate our special day with our family and friends. <br>Thank you so much for visiting our wedding website!</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <!-- Post Blog -->
                        <div class="blog-wrap-home">                            
                            <div class="post-content">
                                <!-- Post Blog Image -->
                                <div class="post-img">
                                    <img src="{{ asset('front/images/blogs/blog_home_1.jpg') }}" alt="">
                                </div>
                                <!-- Post Blog Image -->
                                <!-- Post Blog Content -->
                                <div class="home-content">                                    
                                    <span class="meta-date">July 12, 2020</span>

                                    <div class="mt-auto">
                                        <span class="post-category">
                                            <a href="javascript:">Wedding</a>
                                        </span>
                                        <h3 class="blog-title"><a href="blog-details.html" class="post-title">Wedding Tips For Fashion</a></h3>
                                        <div class="entry-content">
                                            <p>Quis autem vel eum prehenderit qui in ea voluptate velit esse quam nihil mole.</p>
                                        </div>
                                        <div class="read-more">
                                            <a href="blog-details.html" class="btn btn-link btn-link-default">Read More</a>
                                        </div>               
                                    </div>                     
                                </div>                   
                                <!-- Post Blog Content -->
                            </div>                            
                        </div>
                        <!-- Post Blog -->
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <!-- Post Blog -->
                        <div class="blog-wrap-home">                            
                            <div class="post-content">
                                <!-- Post Blog Image -->
                                <div class="post-img">
                                    <img src="{{ asset('front/images/blogs/blog_home_2.jpg')}}" alt="">
                                </div>
                                <!-- Post Blog Image -->
                                <!-- Post Blog Content -->
                                <div class="home-content">                                    
                                    <span class="meta-date">July 12, 2020</span>

                                    <div class="mt-auto">
                                        <span class="post-category">
                                            <a href="javascript:">Photography</a>
                                        </span>
                                        <h3 class="blog-title"><a href="blog-details.html" class="post-title">Photography The Effects</a></h3>
                                        <div class="entry-content">
                                            <p>Quis autem vel eum prehenderit qui in ea voluptate velit esse quam nihil mole.</p>
                                        </div>
                                        <div class="read-more">
                                            <a href="blog-details.html" class="btn btn-link btn-link-default">Read More</a>
                                        </div>               
                                    </div>                     
                                </div>                   
                                <!-- Post Blog Content -->
                            </div>                            
                        </div>
                        <!-- Post Blog -->
                    </div>

                    <div class="col-lg-4 col-md-6 mx-auto mt-md-5 mt-lg-0">
                        <!-- Post Blog -->
                        <div class="blog-wrap-home">                            
                            <div class="post-content">
                                <!-- Post Blog Image -->
                                <div class="post-img">
                                    <img src="{{ asset('front/images/blogs/blog_home_3.jpg')}}" alt="">
                                </div>
                                <!-- Post Blog Image -->
                                <!-- Post Blog Content -->
                                <div class="home-content">                                    
                                    <span class="meta-date">July 12, 2020</span>

                                    <div class="mt-auto">
                                        <span class="post-category">
                                            <a href="javascript:">Fashion</a>
                                        </span>
                                        <h3 class="blog-title"><a href="blog-details.html" class="post-title">Apparels & Makeup Kits</a></h3>
                                        <div class="entry-content">
                                            <p>Quis autem vel eum prehenderit qui in ea voluptate velit esse quam nihil mole.</p>
                                        </div>
                                        <div class="read-more">
                                            <a href="blog-details.html" class="btn btn-link btn-link-default">Read More</a>
                                        </div>               
                                    </div>                     
                                </div>                   
                                <!-- Post Blog Content -->
                            </div>                            
                        </div>
                        <!-- Post Blog -->
                    </div>
                </div>
                
            </div>
        </section>
        <!--  Latest News & Updates End -->

    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="text">
                <h3>Just Get Married</h3>
                <h1>Hitesh <i class="weddingdir_heart_ring"></i> Priyanka</h1>
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
    <script src="{{ asset('front/library/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('front/library/magnific-popup/jquery.magnific-popup.min.js') }}"></script>  
    <script src="{{ asset('front/library/countdown/js/jquery.countdown.min.js') }}"></script>  
    <script src="{{ asset('front/library/isotope-layout/isotope.pkgd.min.js') }}"></script> 
    <script src="{{ asset('front/library/datepicker/js/datepicker.js') }}"></script> 
    <script src="{{ asset('front/library/couple-website/js/script.js') }}"></script>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="{{ asset('front/library/maps/jquery.gmap.min.js') }}"></script> 

</body>

</html>