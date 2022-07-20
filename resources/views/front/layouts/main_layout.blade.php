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
    <header class="fixed-top header-anim">
        <div class="top-bar-stripe">
            <div class="container px-md-0">
                <div class="row align-items-center">
                    <div class="col-lg-auto col-sm-12">
                        <div class="top-icons">
                            <span>The Right Way of Wedding Planning</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg">
                        <div class="social-icons">
                            <ul class="list-unstyled">
                                <li><a href="javascript:"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:"><i class="fa fa-instagram"></i></a>
                                <li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Main Navigation Start -->
        <nav class="navbar navbar-expand-lg">
            <div class="container text-nowrap bdr-nav px-0">
                <div class="d-flex mr-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('front/images/logo.png')}}" alt="" >
                    </a>
                </div>
                <!-- Topbar Request Quote Start -->
                <span class="order-lg-last d-inline-flex ml-3">
                    <a class="btn btn-primary btn-rounded" href="{{url('/login')}}"> Login</a>
                </span>

                <!-- Toggle Button Start -->
                <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Toggle Button End -->
    
                <!-- Topbar Request Quote End -->
    
                <div class="collapse navbar-collapse" id="navbarCollapse" data-hover="dropdown"
                    data-animations="slideInUp slideInUp slideInUp slideInUp">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" id="dropdown03" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Home <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom" aria-labelledby="dropdown03">
                                <li><a class="dropdown-item" href="index.html">Home page 1</a></li>
                                <li><a class="dropdown-item" href="index-2.html">Home page 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom">                                
                                <li><a class="dropdown-item" href="about-us.html">About Us</a></li>                                
                                <li><a class="dropdown-item" href="pricing.html">Pricing Table</a></li>
                                <li><a class="dropdown-item" href="team-page.html">Meet Our Team</a></li>
                                <li><a class="dropdown-item" href="error-404.html">404 Error Page</a></li>
                                <li><a class="dropdown-item" href="faq.html">FAQ's</a></li>
                                <li><a class="dropdown-item" href="typography.html">Typography</a></li>                                
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog <i class="fa fa-chevron-down"></i></a>    
                            <ul class="dropdown-menu dropdownhover-bottom">
                                <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                                <li><a class="dropdown-item" href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listing <i class="fa fa-chevron-down"></i></a>    
                            <ul class="dropdown-menu dropdownhover-bottom">
                                <li><a class="dropdown-item" href="right-side-map-listing.html">Right Side Map Listing</a></li>
                                <li><a class="dropdown-item" href="search-result-page.html">Search Result Page</a></li>
                                <li><a class="dropdown-item" href="listing-singular.html">Listing Singular</a></li>
                                <li><a class="dropdown-item" href="vendor-singular.html">Vendor Singular</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Real Wedding <i class="fa fa-chevron-down"></i></a>    
                            <ul class="dropdown-menu dropdownhover-bottom">
                                <li><a class="dropdown-item" href="real-wedding.html">Real Wedding</a></li>
                                <li><a class="dropdown-item" href="real-wedding-details.html">Real Wedding Details</a></li>
                                <li><a class="dropdown-item" href="couple-website.html">Couple Website</a></li>
                            </ul>
                        </li>                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Panel <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right">
                                <li class="dropdown">
                                    <a class="dropdown-toggle-mob dropdown-item dropdown-toggle-click" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Couple Dashboard <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a href="couple-dashboard.html">Dashboard</a></li>
                                        <li><a href="couple-dashboard-todo-list.html">Checklist</a></li>
                                        <li><a href="couple-dashboard-vendor-manager.html">Vendor Manager</a></li>
                                        <li><a href="couple-dashboard-guest-manager.html">Guest List</a></li>
                                        <li><a href="couple-dashboard-budget.html">Budget</a></li>
                                        <li><a href="couple-dashboard-realwedding.html">RealWedding</a></li>
                                        <li><a href="javascript:">Seating Chart</a></li>
                                        <li><a href="javascript:">Registry</a></li>
                                        <li><a href="javascript:">Chat</a></li>
                                        <li><a href="couple-dashboard-profile.html">My Profile</a></li>
                                        <li><a href="javascript:">Wedding Website</a></li>            
                                        <li><a href="javascript:">Logout</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle-mob dropdown-item dropdown-toggle-click" href="#" id="navbarDropdown_vendor" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendor Dashboard <i class="fa fa-chevron-right"></i></a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown_vendor">
                                        <li><a href="vendor-dashboard.html">Dashboard</a></li>
                                        <li><a href="vendor-dashboard-listing.html">My Listing</a></li>
                                        <li><a href="vendor-dashboard-pricing.html">Pricing Table</a></li>
                                        <li><a href="vendor-dashboard-quote.html">Request Quote</a></li>
                                        <li><a href="vendor-dashboard-reviews.html">Reviews</a></li>
                                        <li><a href="vendor-dashboard-invoice.html">Invoice</a></li>
                                        <li><a href="javascript:">Chat</a></li>
                                        <li><a href="vendor-dashboard-profile.html">My Profile</a></li>
                                        <li><a href="javascript:">Logout</a></li>
                                    </ul>
                                </li>                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.html">Contact Us</a>
                       </li>
                    </ul>
                    <!-- Main Navigation End -->
                </div>
    
    
            </div>
        </nav>
        <!-- Main Navigation End -->
    </header>
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
                        © 2022 All rights reserved.
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
    <script src="{{ asset('front/library/bootstrap/js/bootstrap-dropdownhover.min.js') }}"></script>
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