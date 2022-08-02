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

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
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
        <!-- <link href="assets/css/base.css" rel="stylesheet"> -->
        <link href="{{ asset('front/library/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/bootstrap/css/bootstrap-dropdownhover.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/select2/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/jquery-ui/css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/fontawesome/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/datepicker/css/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/owlcarousel/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/perfect-scrollbars/perfect-scrollbar.css') }}" rel="stylesheet">
        
        <!-- Dashbaord Main Style -->
        <link href="{{ asset('front/css/dashboard.css') }}" rel="stylesheet">
                
    </head>
    <!-- end head -->
    <!--body start-->
    <body class="open">    

    <!-- preloader -->
    <div class="preloader">
        <div class="status">
            <img src="{{ asset('front/images/logo.png') }}" alt="">
        </div>
    </div>
    <!-- end preloader -->

    <!--  WeddingDir top -->
    <header class="fixed-top header-anim">    
        <!-- Main Navigation Start -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid text-nowrap bdr-nav px-0">
                <a href="javascript:" class="sidebar-toggle mobile" data-toggle="offcanvas">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="d-flex mx-auto align-items-center">                    
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ asset('front/images/logo.png') }}" alt="">
                    </a> 
                    <a href="javascript:" class="sidebar-toggle desktop" data-toggle="offcanvas">
                        <i class="fa fa-bars"></i>
                    </a>                   
                </div>
                <!-- Toggle Button Start -->
                <button class="navbar-toggler x collapsed" type="button" data-toggle="offcanvas-mobile"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Toggle Button End -->
    
                <!-- Topbar Request Quote End -->
    
                <div class="collapse navbar-collapse offcanvas-collapse-mobile" id="navbarCollapse" data-hover="dropdown"
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
                        <!-- <li class="nav-item dropdown user-profile">
                            <a class="nav-link" href="index.html" id="dropdown04" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('front/images/dashboard/avatar_img.jpg') }}" alt="">
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" aria-labelledby="dropdown04">
                                <li><a class="dropdown-item" href="couple-dashboard.html">Dashboard</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-todo-list.html">Checklist</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-vendor-manager.html">Vendor Manager</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-guest-manager.html">Guest List</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-budget.html">Budget</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-realwedding.html">RealWedding</a></li>
                                <li><a class="dropdown-item" href="javascript:">Seating Chart</a></li>
                                <li><a class="dropdown-item" href="javascript:">Registry</a></li>
                                <li><a class="dropdown-item" href="javascript:">Chat</a></li>
                                <li><a class="dropdown-item" href="couple-dashboard-profile.html">My Profile</a></li>
                                <li><a class="dropdown-item" href="javascript:">Wedding Website</a></li>            
                                <li><a class="dropdown-item" href="javascript:">Logout</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <!-- Main Navigation End -->
                </div>
            </div>
        </nav>
        <!-- Main Navigation End -->
    </header>
    <!--  WeddingDir top -->

    <main>
        <aside class="offcanvas-collapse">
            <div class="avatar-wrap">
                <?php
                    $user_id = Session::get('user_id');
                    $user = App\Models\User::find($user_id);
                    $details = App\Models\UserDetail::where('user_id',$user_id)->first();
                ?>
                @if($details->profile)
                    <img src="{{ asset('storage/upload/user/profile/'.$details->profile) }}" alt="">
                @else
                    <img src="{{ asset('front/default_image/default_groom.png') }}" alt="">
                @endif
                
                <h3>{{  ucwords($user->name) }}</h3>                
            </div>
            <div class="sidebar-nav">
                <ul class="list-unstyled">
                    <li class="{{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/tools/dashboard') }}"><i class="weddingdir_heart_ring"></i> Dashboard</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'checklist') ? 'active' : '' }}">
                        <a href="{{ url('/tools/checklist') }}"><i class="weddingdir_checklist"></i> Checklist</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'vendors') ? 'active' : '' }}">
                        <a href="{{ url('/tools/vendors') }}"><i class="weddingdir_vendor_manager"></i> Vendor Manager</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'guestlist') ? 'active' : '' }}">
                        <a href="{{ url('/tools/guestlist') }}"><i class="weddingdir_guestlist"></i> Guest List</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'budget') ? 'active' : '' }}">
                        <a href="{{ url('/tools/budget') }}"><i class="weddingdir_budget"></i> Budget</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'real-wedding') ? 'active' : '' }}">
                        <a href="{{ url('/tools/real-wedding') }}"><i class="weddingdir_dove"></i> RealWedding</a>
                    </li>
                    
                    <li class="{{ (request()->segment(2) == 'profile') ? 'active' : '' }}">
                        <a href="{{ url('/tools/profile') }}"><i class="weddingdir_my_profile"></i> My Profile</a>
                    </li>
                    
                    <li>
                        <a href="{{ url('logout') }}"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="body-content">
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
        </div>        
    </main>
    

    
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
    <script src="{{ asset('front/library/countdown/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/library/perfect-scrollbars/perfect-scrollbar.min.js') }}"></script>    
    <script src="{{ asset('front/js/dashboard.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    
    @switch(request()->segment(2))
        @case('checklist')
           
            @break
    
        @case('budget')
            <script src="{{ asset('front/library/apex-chart/apexcharts.js') }}"></script>
            <script src="{{ asset('front/library/apex-chart/chart-data.js') }}"></script>
            @break

        @case('real-wedding')
            <script src="{{ asset('front/library/summernote/summernote-bs4.min.js') }}"></script>
            @break
    
        @default
            
    @endswitch

</body>

</html>