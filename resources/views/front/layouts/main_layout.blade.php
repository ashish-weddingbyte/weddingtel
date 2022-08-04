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
        <title>WeddingByte.com | @yield('title')</title>

        <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon" href="{{ asset('front/images/favicon/apple-touch-icon.png') }}" sizes="180x180">
        <link rel="icon" href="{{ asset('front/images/favicon/favicon-32x32.png' ) }}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{ asset('front/images/favicon/favicon-16x16.png') }}" sizes="16x16" type="image/png">
        <link rel="icon" href="{{ asset('front/images/favicon/favicon2.ico' ) }}">

        <!-- CSS ( Bootstrap + Owlcarouses + Fontawesome + Animate + Select2 + Custom Style )
        ======================================================================================= -->
        <link href="{{ asset('front/css/base.css') }}" rel="stylesheet">

        
    </head>
    <!-- end head -->
    <!--body start-->
    <body>    

    <!-- preloader -->
    <div class="preloader">
        <div class="status">
            <img src="{{ asset('front/images/logo.png') }}" alt="">
        </div>
    </div>
    <!-- end preloader -->

    <!--  WeddingDir top -->
    @include('front.includes.header')
    <!--  WeddingDir top -->

    <!-- page content start -->

    @yield('main-container')

    <!-- page content end -->


    <footer>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="footer-logo">
                                <img src="{{ asset('front/images/logo.png') }}" alt="">
                                <p>Sed ut perspiciatis unde mnis iste natus error sit ptatem accus antium doloremque lauda ntium.</p>
                            </div>
                            <div><a href="javascript:" class="btn btn-primary">Know More</a></div>
                        </div>
        
                        <div class="col-md">
                            <div class="footer-widget">
                                <h3 class="widget-title">Categories</h3>
                                <ul class="list-unstyled icons-listing mb-0 widget-listing arrow">
                                    <li><a href="javascript:">Venue</a></li>
                                    <li><a href="javascript:">Dresses</a></li>
                                    <li><a href="javascript:">Florist</a></li>
                                    <li><a href="javascript:">Cake</a></li>
                                    <li><a href="javascript:">Photographer</a></li>
                                    <li><a href="javascript:">Music DJ</a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="col-md">
                            <div class="footer-widget">
                                <h3 class="widget-title">Locations</h3>
                                <ul class="list-unstyled icons-listing mb-0 widget-listing arrow">
                                    <li><a href="javascript:">Ahmedabad</a></li>
                                    <li><a href="javascript:">Vodadara</a></li>
                                    <li><a href="javascript:">Surat</a></li>
                                    <li><a href="javascript:">Rajkot</a></li>
                                    <li><a href="javascript:">Punjab</a></li>
                                    <li><a href="javascript:">Hariyana</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mr-top-footer">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="footer-widget">
                                <h3 class="widget-title">Contact Us</h3>
                                <div class="widget-contact">
                                    <p>4998 Elk Creek Road Canton, GA 30114</p>
                                    <p>Call : <a href="tel:+81-258-852-6699">+81 258 852 6699</a></p>
                                    <p>Mail : <a href="mailto:Info@weddingdir.com">Info@weddingdir.com</a></p>
                                </div>
                                <div class="social-icons-footers">
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:"><i class="fa fa-instagram"></i></a>
                                        <li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6 col-12">
                            <div class="footer-widget">
                                <h3 class="widget-title">Newsletter</h3>
                                <p>Subscribe to our newsletter  to receive exclusive offers and wedding tips.</p>
                                <div class="mb-3"><input type="text" class="form-control form-light" id="exampleFormControlInput1" placeholder="Enter Email Address"></div>
                                <button type="button" class="btn btn-default">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-auto col-12">
                        © {{ date('Y') }} All rights reserved. Build with <i class="fa fa-heart" style="color:#fc2779;" aria-hidden="true"></i> in India.
                    </div>
                    <div class="col-md-auto col-12 copyrights-link ml-md-auto">
                        <a href="javascript:">Home</a> | <a href="javascript:">About</a> | <a href="javascript:">Contact Us</a> | <a href="javascript:">Terms & Conditions</a> |   <a href="javascript:">Privacy Policy</a>  
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Back to Top
    ================================================== -->
    <a id="back-to-top" href="javascript:" class="btn btn-outline-primary back-to-top"><i class="fa fa-arrow-up"></i></a>

    
    
    <!-- All The JS Files
      ================================================== -->
    <script src="{{ asset('front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/library/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/library/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/library/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('front/library/magnific-popup/jquery.magnific-popup.min.js') }}"></script>  
    <script src="{{ asset('front/library/isotope-layout/isotope.pkgd.min.js') }}"></script> 
    <script src="{{ asset('front/library/datepicker/js/datepicker.js') }}"></script>    
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
</body>

</html>