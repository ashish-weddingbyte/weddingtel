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
        <meta name="description" content="Wedding Byte is the one-stop shop for all your needs related to hiring professionals for wedding arrangements like photographers, engagement makeup, bridal makeup artists, mehndi artists, choreographers etc.">
        <meta name="keywords" content="bride, business, couple, directory, groom, listing, login, map, marketing, realwedding, registration, rsvp, vendor, wedding, wedding planner">
        <meta name="author" content="WeddingByte">
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
        
        <link href="{{ asset('front/library/select2/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/jquery-ui/css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/fontawesome/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/datepicker/css/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/owlcarousel/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/library/perfect-scrollbars/perfect-scrollbar.css') }}" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- Page Level Styles -->
        <link href="{{ asset('front/library/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
        
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
    @include('front.includes.user_header')
    <!--  WeddingDir top -->

    <main>
        @if(Session::get('user_type') == 'user')
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
                    <li class="{{ user_helper::active_menu('dashboard') }}">
                        <a href="{{ url('/tools/dashboard') }}"><i class="weddingdir_heart_ring"></i> Dashboard</a>
                    </li>
                    <li class="{{ user_helper::active_menu('checklist') }}">
                        <a href="{{ url('/tools/checklist') }}"><i class="weddingdir_checklist"></i> Checklist</a>
                    </li>
                    <li class="{{ user_helper::active_menu('vendors') }}">
                        <a href="{{ url('/tools/vendors') }}"><i class="weddingdir_vendor_manager"></i> Vendor Manager</a>
                    </li>
                    <li class="{{ user_helper::active_menu('guestlist') }}">
                        <a href="{{ url('/tools/guestlist') }}"><i class="weddingdir_guestlist"></i> Guest List</a>
                    </li>
                    <li class="{{ user_helper::active_menu('budget') }}">
                        <a href="{{ url('/tools/budget') }}"><i class="weddingdir_budget"></i> Budget</a>
                    </li>
                    <li class="{{ user_helper::active_menu('review') }}">
                        <a href="{{ url('/tools/review') }}"><i class="fa fa-star"></i> Ratings & Reviews</a>
                    </li>
                    <li class="{{ user_helper::active_menu('wishlist') }}">
                        <a href="{{ url('/tools/wishlist') }}"><i class="weddingdir_heart_double_face"></i> Wishlist</a>
                    </li>

                    <li class="{{ user_helper::active_menu('real-wedding') }}">
                        <a href="{{ url('/tools/real-wedding') }}"><i class="weddingdir_dove"></i> Real-Wedding</a>
                    </li>
                    
                    <li class="{{ user_helper::active_menu('profile') }}">
                        <a href="{{ url('/tools/profile') }}"><i class="weddingdir_my_profile"></i> My Profile</a>
                    </li>
                    <li class="{{ user_helper::active_menu('/wedding-website') }}">
                        <a href="{{ url('/tools/wedding-website') }}"><i class="weddingdir_websote_demo"></i> Wedding Website</a>
                    </li>
                    
                    <li>
                        <a href="{{ url('logout') }}"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </aside>
        @endif

        @if(Session::get('user_type') == 'vendor')
        <aside class="offcanvas-collapse">
            <div class="avatar-wrap">
                <?php
                    $user_id = Session::get('user_id');
                    $user = App\Models\User::find($user_id);
                    $details = App\Models\VendorDetail::where('user_id',$user_id)->first();

                    $exclusive = vendor_helper::check_exclusive($user_id);
                ?>
                @if($details->profile_image)
                    <img src="{{ asset('storage/upload/vendor/profile/'.$details->profile_image) }}" alt="">
                @else
                    <img src="{{ asset('front/default_image/default_vendor.png') }}" alt="">
                @endif
                
                <h3>{{  ucwords($user->name) }}</h3>                
            </div>
            <div class="sidebar-nav">
                <ul class="list-unstyled">
                    <li class="{{ user_helper::active_menu('dashboard') }}">
                        <a href="{{ url('/vendor/dashboard') }}"><i class="weddingdir_dashboard"></i> Dashboard</a>
                    </li>
                    <li class="{{ user_helper::active_menu('profile') }}">
                        <a href="{{ url('/vendor/profile') }}"><i class="weddingdir_my_profile"></i> My Profile</a>
                    </li>
                    <li class="{{ user_helper::active_menu('plans') }}">
                        <a href="{{ url('/vendor/plans') }}"><i class="fa fa-money" aria-hidden="true"></i> Plans</a>
                    </li>
                    @if($exclusive == true)
                        <li class="{{ user_helper::active_menu('exclusive-leads') }}">
                            <a href="{{ url('/vendor/exclusive-leads') }}"><i class="weddingdir_pricing_plans"></i>Exclusive Leads</a>
                        </li>
                    @else
                        <li class="{{ user_helper::active_menu('leads') }}">
                            <a href="{{ url('/vendor/leads') }}"><i class="weddingdir_pricing_plans"></i> Leads</a>
                        </li>
                    @endif
                    <li class="{{ user_helper::active_menu('query') }}">
                        <a href="{{ url('/vendor/query') }}"><i class="weddingdir_request_quote"></i> Query</a>
                    </li>
                    <li class="{{ user_helper::active_menu('wishlist') }}">
                        <a href="{{ url('/vendor/wishlist') }}"><i class="weddingdir_heart_double"></i> Wishlist</a>
                    </li>
                    <li class="{{ user_helper::active_menu('invoice') }}">
                        <a href="{{ url('/vendor/invoice') }}"><i class="weddingdir_invoice"></i> Invoice</a>
                    </li>
                    <li class="{{ user_helper::active_menu('template') }}">
                        <a href="{{ url('/vendor/template') }}"><i class="weddingdir_my_listing"></i> Template</a>
                    </li>
                    <li class="{{ user_helper::active_menu('review') }}">
                        <a href="{{ url('/vendor/review') }}"><i class="weddingdir_reviews"></i> Reviews</a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </aside>
        @endif
        <div class="body-content">
            <!-- page content start -->
                @yield('main-container')
            <!-- page content end -->
            <footer class="bg-light-gray">
                @if(Session::get('user_type') == 'user')
                <div class="container">
                     <div class="row no-gutters">
                        <div class="col-lg-12 col-md-12">
                            <div class="footer-logo">
                                <img src="{{ asset('front/images/logo.png') }}" alt="">
                                <p>WeddingByte is an Indian online wedding planning platform and a wedding media publisher, enabling couples to plan their weddings in a convenient & cost-effective manner.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters my-4">
                        <div class="col-lg-12">
                            <div class="footer-widget">
                                <h3 class="widget-title">Wedding Vendors in over 100 cities</h3>
                                <?php
                                    $categories = App\Models\Category::where('status','1')->get();
                                ?>
                                @foreach($categories as $category)
                                    <?php  
                                        $data = vendor_helper::footer_data($category->id);
                                    ?>

                                    @if(!empty($data))
                                    <p><a href="{{ url('/vendors/all/'.$category->category_url) }}"><span class="icon">{!! $category->icon !!} </span> {{ $category->category_name }} </a></p>
                                    <div class="footer-category-link ml-md-auto my-3">
                                        <a href="{{ url('/vendors/all/'.$category->category_url) }}">{{$category->category_name}}</a>
                                        @foreach($data as $d)
                                        | <a href="{{ url('/vendors/'.$d->name.'/'.$category->category_url) }}">{{$category->category_name}} in {{ $d->name }}</a> 
                                        @endforeach
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
                @endif
        
                <div class="copyrights">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-auto col-12">
                                © {{ date('Y') }} All rights reserved. Build with <i class="fa fa-heart" style="color:#fc2779;" aria-hidden="true"></i> in India.
                            </div>
                            <div class="col-md-auto col-12 copyrights-link ml-md-auto">
                                <a href="{{ url('/') }}">Home</a> | <a href="{{ url('/') }}">About</a> | <a href="{{ url('/contact') }}">Contact Us</a> | <a href="{{ url('term-and-conditions') }}">Terms & Conditions</a> | <a href="{{ url('privacy-policy') }}">Privacy Policy</a> | <a href="{{ url('cancellation-policy') }}">Cancellation Policy</a>  
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
    <script src="{{ asset('front/library/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/library/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front/library/jquery-ui/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('front/library/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('front/library/isotope-layout/isotope.pkgd.min.js') }}"></script> 
    <script src="{{ asset('front/library/datepicker/js/datepicker.js') }}"></script> 
    <script src="{{ asset('front/library/countdown/js/loopcounter.js') }}"></script>
    <script src="{{ asset('front/library/perfect-scrollbars/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('front/library/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('front/js/dashboard.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>

    
    @switch(request()->segment(2))
        @case('checklist')
           
            @break
    
        @case('budget')
            
            @break

        
        @default
            
    @endswitch

</body>

</html>