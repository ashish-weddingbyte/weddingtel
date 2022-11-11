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


    <footer class="bg-light-gray">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12">
                    <div class="footer-logo">
                        <img src="{{ asset('front/images/logo.png') }}" alt="">
                        <p>WeddingByte is an Indian online wedding planning platform and a wedding media publisher, enabling couples to plan their weddings in a convenient & cost-effective manner.</p>
                        <a href="{{ url('/vendor-register') }}" class="btn btn-default btn-rounded btn-lg mb-3">Register As a Vendor</a>
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