@extends('front.layouts.main_layout')

@section('title', 'Home')


@section('main-container')
    <section class="slider-wrap style-second">
        <div class="slider-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 mx-auto">
                        <h1>WeddingByte The Right Way of Wedding Planning</h1>
                        <p class="lead txt-white text-center">Search over 100,000 wedding vendors with reviews, pricing, availability and more</p>
                        <form action="{{ url('vendors') }}" method="post">
                            @csrf
                            <div class="form-bg row no-gutters align-items-center">
                                <div class="col-12 col-md-5">
                                    <select class="form-light-select theme-combo" name="category" >
                                        <option value='0'>Choose Vendor Type</option>
                                        <option value="all">All Categories</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_url }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="px-2 w-100">
                                        <select class="form-light-select theme-combo" name="city">
                                            <option value='0'>Choose Location</option> 
                                            <option value="all">All Cities</option>
                                            @if($cities)   
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <input type="submit" value="Search Now" class="btn btn-default text-nowrap btn-block" name="search" />
                                </div>
                            </div>
                        </form>
                        <!-- <p class="lead txt-white text-center">Or browse featured categories</p>
                        <div class="slider-category">
                            <a href="javascript:"><i class="weddingdir_cake_floor"></i></a>
                            <a href="javascript:"><i class="weddingdir_fashion"></i></a>
                            <a href="javascript:"><i class="weddingdir_cup_cakes"></i></a>
                            <a href="javascript:"><i class="weddingdir_flowers"></i></a>
                            <a href="javascript:"><i class="weddingdir_music"></i></a>
                        </div> -->
                    </div>
                </div>           
            </div>
            
        </div>
    </section>

<main id="body-content">

    <!-- Wedding Plannign  Start -->
    <section class="wide-tb-50 bg-light-gray">
    <div class="container">
        <div class="section-title text-center">
            <h1>Wedding Planning Tool</h1>
        </div>            
        <div class="row">
            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/budget') }} @else {{ url('/login') }}  @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_budget"></i>
                        </div>

                        <h4>Budget</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->

            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/tools/budget') }} @else {{ url('/login') }} @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_calendar_heart"></i>
                        </div>
                        <h4>Guest List</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->

            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/tools/guestlist') }} @else {{ url('/login') }} @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_seating_chart"></i>
                        </div>
                        <h4>Seating Chart</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->

            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/tools/checklist') }} @else {{ url('/login') }} @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_bell"></i>
                        </div>
                        <h4>Check List</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->

            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/tools/real-wedding') }} @else {{ url('/login') }} @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_heart_ring"></i>
                        </div>
                        <h4>Real Weddings</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->

            <!-- Features Icons -->
            
            <div class="col-lg-4 col-xl-2 text-center col-6">
                <a href="@if(Session::get('user_type') == 'user') {{ url('/tools/vendors') }} @else {{ url('/login') }} @endif">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_shopping_bag_heart"></i>
                        </div>
                        <h4>Vendors</h4>
                    </div>
                </a>
            </div>
            
            <!-- Features Icons -->
            
        </div>
    </div>
</section>
<!-- Wedding Plannign  End -->

    <!-- Top Wedding Vendors Start -->
    <section class="wide-tb-50 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Top Category</h1>
            </div>
            <div class="row row-cols-2 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">

                @if($categories)
                    @foreach($categories as $category)
                        
                        <div class="col">
                            <div class="vendor-listing-wrap">                                    
                                <div class="vendor-img">
                                    <div class="overlay-box">
                                        <a href="{{ url('/vendors/all/'.$category->category_url) }}" class="btn btn-default btn-rounded btn-sm">View Details</a> 
                                    </div>
                                    <div class="vendor-icon">
                                        @if($category->icon)
                                            {!! $category->icon !!} 
                                        @else
                                            <i class="fa fa-life-ring"></i>
                                        @endif
                                    </div>
                                    <a href="{{ url('/vendors/all/'.$category->category_url) }}"><img src="{{ asset('storage/upload/category/'.$category->image)}}" alt=""></a>
                                </div>
                                <div class="content">
                                    <h3><a href="{{ url('/vendors/all/'.$category->category_url) }}">{{ ucwords($category->category_name) }}</a></h3>
                                </div>                               
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- Top Wedding Vendors End -->

    
    <!-- Top Wedding Vendors Start -->
    <section class="wide-tb-30 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Top Vendors</h1>
            </div>
            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-1">

                @if($top_vendors)

                    @foreach($top_vendors as $vendor)
                        <?php
                            $image_path = vendor_helper::vendor_image_path($vendor->id);

                            $verified = vendor_helper::check_verified_vendor($vendor->id);                    
                            $url = vendor_helper::vendor_profile_url($vendor->id);
                        ?>
                        <div class="col ">
                            <div class="vendor-wrap-alt">
                                <div class="img">
                                    <img src="{{ $image_path }}" alt="{{ $vendor->featured_image }}">
                                    <div class="img-content-top">
                                        <div class="top">
                                            <span class="is_top">
                                                <i class="fa fa-arrow-up"></i>
                                                <span>Top</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="img-content">
                                        <span class="rating">1.0</span>
                                        <a href="javascript:void;" class="favorite"><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="vendor-heading">
                                        <h3>
                                            @if($vendor->icon)
                                                {!! $vendor->icon !!} 
                                            @else
                                                <i class="fa fa-life-ring"></i>
                                            @endif
                                            <a href="{{ $url }}">{{ ucwords($vendor->name) }}</a>
                                        </h3>
                                        <!-- <a href="{{ $url }}" class="btn btn-sm btn-default">Get A Quote</a> -->
                                    </div>
                                    <div class="mb-2">
                                        <i class="fa fa-list" aria-hidden="true"></i> 
                                        {{ $vendor->brandname }} {!! ($verified) ? '<span class="verified"><i class="fa fa-check-circle"></i></span>': '' !!}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> 
                                        {{ ucwords($vendor->city_name) }}
                                    </div>
                                    
                                </div>
                               
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- Top Wedding Vendors End --> 
 


    <!-- Top Wedding Listings Start -->
    <section class="wide-tb-50 floral-bg bg-light-gray">
        <div class="container">
            <div class="section-title text-center">
                <h1>Top Featured Vendors</h1>
            </div>
            @if($featured_vendors)
            <div class="owl-carousel owl-theme dots-black" id="home-slider-listing">                        
                
                @foreach($featured_vendors as $vendor)
                <?php
                    $image_path = vendor_helper::vendor_image_path($vendor->id);
                               
                    $url = vendor_helper::vendor_profile_url($vendor->id);

                    $verified = vendor_helper::check_verified_vendor($vendor->id);

                ?>
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="{{ $url }}">
                                <img src="{{ $image_path }}" alt="{{ $vendor->featured_image }}">
                            </a>
                            <div class="img-content">
                                <div class="top">  
                                    <span class="featured">
                                        <i class="fa fa-star"></i>
                                        <span>Featured</span>
                                    </span>
                                    <!-- <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span> -->
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="{{ $url }}">
                                        {{ $vendor->category_name }}
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="{{ $url }}">{{$vendor->brandname }} {!! ($verified) ? '<span class="verified"><i class="fa fa-check-circle"></i></span>': '' !!} </a></h3>
                                <div><i class="fa fa-map-marker"></i> {{ $vendor->city_name }}</div>
                            </div>
                            <div class="reviews">
                                <span class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>                                    
                                </span>
                                (6 review)
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            @endif
            </div>
        </div>
    </section>
    <!-- Wedding Dir Features End -->


    <!-- Latest News & Updates Start -->
    <section class="wide-tb-50 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Latest Blogs</h1>
            </div>

            @if($blogs)
            <div class="row">
                @foreach($blogs as $blog)
                <?php
                    $blog_url = url('/blog').'/'.str_replace(' ','-',trim($blog->title));
                ?>
                <div class="col-lg-4 col-md-6">
                    <!-- Post Blog -->
                    <div class="blog-wrap-home">                            
                        <div class="post-content">
                            <!-- Post Blog Image -->
                            <div class="post-img blog-image">
                                <img src="{{ asset('storage/upload/blog/'.$blog->featured_image)}}" alt="">
                            </div>
                            <!-- Post Blog Image -->
                            <!-- Post Blog Content -->
                            <div class="home-content">                                    
                                <span class="meta-date">{{ date('M d, Y', strtotime($blog->created_at) ) }}</span>

                                <div class="mt-auto">
                                    <span class="post-category">
                                        <a href="{{ url('/blogs/'.$blog->category_url ) }}">{{ $blog->category_name }}</a>
                                    </span>
                                    <h3 class="blog-title"><a href="{{ $blog_url }}" class="post-title">{{ $blog->title }}</a></h3>
                                    <div class="entry-content">
                                        <!-- <p>Quis autem vel eum prehenderit qui in ea voluptate velit esse quam nihil mole.</p> -->
                                    </div>
                                    <div class="read-more">
                                        <a href="{{ $blog_url }}" class="btn btn-link btn-link-default">Read More</a>
                                    </div>               
                                </div>                     
                            </div>                   
                            <!-- Post Blog Content -->
                        </div>                            
                    </div>
                    <!-- Post Blog -->
                </div>
                @endforeach

            </div>
            @endif
        </div>
    </section>
    <!-- Latest News & Updates End -->

    <!-- Callout Style Main Start -->
    <section class="callout-main bg-light-gray">
        <div class="container-fluid pl-0">
            <div class="row">
                <div class="col-lg-6" style="background: url({{ asset('front/images/callout_img.jpg') }}) center center no-repeat; background-size: cover;">
                    <img src="{{ asset('front/images/callout_img.jpg') }}" class="d-lg-none invisible" alt="">                    
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="callout-text">
                        <div class="section-title">
                            <h1>The Best Wedding Vendor Service</h1>                        
                        </div> 
                        <p class="lead">Trusted Wedding Services for every Indian Wedding</p>
                        <a href="{{ url('/contact') }}" class="btn btn-default btn-rounded btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Callout Style Main End -->



    <!-- Celebraty Wedding Start -->
    <section class="wide-tb-50 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Celebrity wedding</h1>
            </div>            
            <div class="row">
                
                <div class="col-md-6 col-lg-3">
                    <div class="team-style-default">
                        <div class="social-wrap">
                            <img src="{{ asset('front/images/about/team/team_img_1.jpg')}}" alt="">
                            
                        </div>
                        <div class="content">
                            <h3 class="fw-7">David William</h3>
                            <div>CEO And Founder</div>
                        </div>
                        
                    </div>
                </div>
                

                
                <div class="col-md-6 col-lg-3">
                    <div class="team-style-default">
                        <div class="social-wrap">
                            <img src="{{ asset('front/images/about/team/team_img_2.jpg')}}" alt="">
                            
                        </div>
                        <div class="content">
                            <h3 class="fw-7">Hendry Cavill</h3>
                            <div>Co-Founder</div>
                        </div>
                        
                    </div>
                </div>
                

                <!-- Spacer For Medium -->
                <div class="w-100 d-none d-md-block d-lg-none spacer-60"></div>
                <!-- Spacer For Medium -->

                
                <div class="col-md-6 col-lg-3">
                    <div class="team-style-default">
                        <div class="social-wrap">
                            <img src="{{ asset('front/images/about/team/team_img_3.jpg')}}" alt="">
                            
                        </div>
                        <div class="content">
                            <h3 class="fw-7">Ford Hunter</h3>
                            <div>Chief Manager</div>
                        </div>
                        
                    </div>
                </div>
                

                
                <div class="col-md-6 col-lg-3">
                    <div class="team-style-default">
                        <div class="social-wrap">
                            <img src="{{ asset('front/images/about/team/team_img_6.jpg')}}" alt="">
                            
                        </div>
                        <div class="content">
                            <h3 class="fw-7">Dane Johnson</h3>
                            <div>Dane Johnson</div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Celebraty Wedding End -->


    <!-- Popular locations Start -->
    <section class="wide-tb-50 bg-light-gray ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Popular City</h1>
            </div>
            <div class="row">
                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">                            
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3>
                                    <a href="{{ url('/vendors/mumbai') }}">Mumbai</a> 
                                    <!-- <span>12 Listings</span> -->
                                </h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_6.jpg')}}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->

                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3><a href="{{ url('/vendors/ahmedabad') }}">Ahmedabad</a></h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_7.jpg')}}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->

                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3><a href="{{ url('/vendors/kolkata') }}">Kolkata</a> </h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_8.jpg')}}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->

                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3><a href="{{ url('/vendors/noida') }}">Noida</a> </h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_9.jpg') }}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->

                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3><a href="{{ url('/vendors/delhi') }}">Delhi</a> </h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_10.jpg') }}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->

                <!-- Popular Locations Alternate -->
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="popular-locations-alternate">
                        <div class="overlay-box">
                            <div class="mt-auto">
                                <h3><a href="{{ url('/vendors/kerala') }}">Kerala</a> </h3>
                            </div>
                        </div>
                        <img src="{{ asset('front/images/locations/location_img_11.jpg') }}" alt="">
                    </div>                        
                </div>
                <!-- Popular Locations Alternate -->
            </div>
        </div>
    </section>
    <!-- Popular locations End -->


    <!-- Real Wedding Start -->
    <section class="wide-tb-50 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Real Wedding</h1>
            </div>
            <div class="row">
                <!-- Real Wedding Stories -->
                <div class="col-lg-4 col-md-6">
                    <div class="real-wedding-wrap top-heading">
                        
                        <div class="real-wedding">
                            <div class="head">
                                <h3><a href="real-wedding-details.html">Karen Weds Raymond</a></h3>
                                <p><i class="fa fa-map-marker"></i> Vadodara, Gujarat, India</p>
                            </div>
                            <div class="img">
                                <div class="overlay">
                                    <i class="weddingdir_heart_double_alt"></i>
                                    Our Story
                                </div>
                                <a href="real-wedding-details.html"><img src="{{ asset('front/images/realwedding/real_wedding_1.jpg')}}" alt=""></a>
                                <div class="date">
                                    June 26, 2020
                                </div>
                            </div>
                            <ul class="list-unstyled gallery">
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_1.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_2.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <div class="load-more">
                                            Load <br>More
                                        </div>
                                        <img src="{{ asset('front/images/realwedding/gallery_3.jpg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>                            
                    </div>
                </div>
                <!-- Real Wedding Stories -->                    

                <!-- Real Wedding Stories -->
                <div class="col-lg-4 col-md-6">
                    <div class="real-wedding-wrap top-heading">                            
                        <div class="real-wedding">
                            <div class="head">
                                <h3><a href="real-wedding-details.html">Karen Weds Raymond</a></h3>
                                <p><i class="fa fa-map-marker"></i> Vadodara, Gujarat, India</p>
                            </div>
                            <div class="img">
                                <div class="overlay">
                                    <i class="weddingdir_heart_double_alt"></i>
                                    Our Story
                                </div>
                                <a href="real-wedding-details.html"><img src="{{ asset('front/images/realwedding/real_wedding_2.jpg')}}" alt=""></a>
                                <div class="date">
                                    June 26, 2020
                                </div>
                            </div>
                            <ul class="list-unstyled gallery">
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_4.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_5.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <div class="load-more">
                                            Load <br>More
                                        </div>
                                        <img src="{{ asset('front/images/realwedding/gallery_6.jpg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>                            
                    </div>
                </div>
                <!-- Real Wedding Stories -->

                <!-- Real Wedding Stories -->
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="real-wedding-wrap top-heading">                            
                        <div class="real-wedding">
                            <div class="head">
                                <h3><a href="real-wedding-details.html">Karen Weds Raymond</a></h3>
                                <p><i class="fa fa-map-marker"></i> Vadodara, Gujarat, India</p>
                            </div>
                            <div class="img">
                                <div class="overlay">
                                    <i class="weddingdir_heart_double_alt"></i>
                                    Our Story
                                </div>
                                <a href="real-wedding-details.html"><img src="{{ asset('front/images/realwedding/real_wedding_3.jpg')}}" alt=""></a>
                                <div class="date">
                                    June 26, 2020
                                </div>
                            </div>
                            <ul class="list-unstyled gallery">
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_7.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <img src="{{ asset('front/images/realwedding/gallery_8.jpg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="real-wedding-details.html">
                                        <div class="load-more">
                                            Load <br>More
                                        </div>
                                        <img src="{{ asset('front/images/realwedding/gallery_9.jpg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>                            
                    </div>
                </div>
                <!-- Real Wedding Stories -->
            </div>
            <div class="text-center">
                <a href="javascript:" class="btn btn-default btn-rounded btn-lg">More Real Weddings</a>
            </div>
        </div>
    </section>
    <!-- Real Wedding End -->
    
    



    <!-- Customer Feedback Start -->
    <section class="wide-tb-50 ">
        <div class="container">
            <div class="section-title text-center">
                <h1>Testimonials</h1>
            </div>            
            <div class="owl-carousel owl-theme dots-black" id="slider-feedback">                        
                <!-- Customer Testimonials -->
                <div class="item">
                    <div class="customer-feedback-alternate">                            
                        <div class="content">
                            <div class="name-wrap">
                                <img src="{{ asset('front/images/feedback_1.jpg') }}" alt="">
                                <div class="head">
                                    <h3>Vikas Arora</h3>
                                    <div>New Delhi, India</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">This is a very professional managed organisation – everything we experienced at the wedding was exceptional. The staff were all very efficient and polite.</div>
                        </div>
                    </div>
                </div>
                <!-- Customer Testimonials -->

                <!-- Customer Testimonials -->
                <div class="item">
                    <div class="customer-feedback-alternate">                            
                        <div class="content">
                            <div class="name-wrap">
                                <img src="{{ asset('front/images/feedback_3.jpg')}}" alt="">
                                <div class="head">
                                    <h3>Amandeep</h3>
                                    <div>Mohali, India</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">You did a wonderful job for us and we very grateful for the expert input provided by wedding byte in advance for the big day. It was our wonderful day which was made special</div>
                        </div>
                    </div>
                </div>
                <!-- Customer Testimonials -->

                <!-- Customer Testimonials -->
                <div class="item">
                    <div class="customer-feedback-alternate">                            
                        <div class="content">
                            <div class="name-wrap">
                                <img src="{{ asset('front/images/feedback_2.jpg')}}" alt="">
                                <div class="head">
                                    <h3>Rajan</h3>
                                    <div>Chandigarh, India</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">Just wanted to you people at wedding byte , to say thank you so much for all the work you put into our wedding. The whole day went so well and organised and really I couldn’t have asked for a better day! We’ve had so many people commenting on how amazing the wedding was planned .</div>
                        </div>
                    </div>
                </div>
                <!-- Customer Testimonials -->

                <!-- Customer Testimonials -->
                <div class="item">
                    <div class="customer-feedback-alternate">                            
                        <div class="content">
                            <div class="name-wrap">
                                <img src="{{ asset('front/images/feedback_3.jpg')}}" alt="">
                                <div class="head">
                                    <h3>Bhuvesh Sharma</h3>
                                    <div>Jaipur, India</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">Thank you for your work through the organising of our wedding reception, our guests and we had the most wonderful time. The venue looked simply superb on the wedding day and the staff working at our event were very efficient</div>
                        </div>
                    </div>
                </div>
                <!-- Customer Testimonials -->

                
            </div>
        </div>
    </section>
    <!-- Customer Feedback End -->

    <!-- Wedding Fashion Gallery Start -->
    <section class="wide-tb-50 bg-light-gray">
        <div class="container">
            <div class="section-title text-center">
                <h1>Wedding Fashion Gallery</h1>
            </div>         
            
            <div class="row">
                <!-- Fashion Gallery -->
                <div class="col-lg-3 col-md-6">
                    <div class="fashion-gallery">
                        <div class="img">
                            <div class="product-option">
                                <a href="javascript:"><i class="fa fa-heart-o"></i></a>
                                <a href="javascript:"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:"><i class="fa fa-expand"></i></a>
                            </div>
                            <img src="{{ asset('front/images/fashion/fashion_img_1.jpg') }}" alt="">
                        </div>
                        <div class="content-wrap">
                            <div class="content">
                                <h3><a href="javascript:">Allure Bridesmaids </a></h3>
                                <h5 class="price">Price INR 300</h5>
                                <div class="desciption">
                                    Silhouette Sheath, Neckline V-neck 
                                </div>
                                <a href="javascript:" class="btn btn-sm btn-default btn-rounded">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fashion Gallery -->

                <!-- Fashion Gallery -->
                <div class="col-lg-3 col-md-6">
                    <div class="fashion-gallery">
                        <div class="img">
                            <div class="product-option">
                                <a href="javascript:"><i class="fa fa-heart-o"></i></a>
                                <a href="javascript:"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:"><i class="fa fa-expand"></i></a>
                            </div>
                            <img src="{{ asset('front/images/fashion/fashion_img_2.jpg') }}" alt="">
                        </div>
                        <div class="content-wrap">
                            <div class="content">
                                <h3><a href="javascript:">Sorella Veta</a></h3>
                                <h5 class="price">Price INR 450</h5>
                                <div class="desciption">
                                    Silhouette Sheath, Neckline V-neck 
                                </div>
                                <a href="javascript:" class="btn btn-sm btn-default btn-rounded">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fashion Gallery -->

                <!-- Fashion Gallery -->
                <div class="col-lg-3 col-md-6">
                    <div class="fashion-gallery">
                        <div class="img">
                            <div class="product-option">
                                <a href="javascript:"><i class="fa fa-heart-o"></i></a>
                                <a href="javascript:"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:"><i class="fa fa-expand"></i></a>
                            </div>
                            <img src="{{ asset('front/images/fashion/fashion_img_3.jpg')}}" alt="">
                        </div>
                        <div class="content-wrap">
                            <div class="content">
                                <h3><a href="javascript:">Hayley Paige</a></h3>
                                <h5 class="price">Price INR 350</h5>
                                <div class="desciption">
                                    Silhouette Sheath, Neckline V-neck 
                                </div>
                                <a href="javascript:" class="btn btn-sm btn-default btn-rounded">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fashion Gallery -->

                <!-- Fashion Gallery -->
                <div class="col-lg-3 col-md-6">
                    <div class="fashion-gallery">
                        <div class="img">
                            <div class="product-option">
                                <a href="javascript:"><i class="fa fa-heart-o"></i></a>
                                <a href="javascript:"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:"><i class="fa fa-expand"></i></a>
                            </div>
                            <img src="{{ asset('front/images/fashion/fashion_img_4.jpg')}}" alt="">
                        </div>
                        <div class="content-wrap">
                            <div class="content">
                                <h3><a href="javascript:">Maggy Sottero</a></h3>
                                <h5 class="price">Price INR 480</h5>
                                <div class="desciption">
                                    Silhouette Sheath, Neckline V-neck 
                                </div>
                                <a href="javascript:" class="btn btn-sm btn-default btn-rounded">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fashion Gallery -->                    

            </div>

            <div class="text-center mt-md-4">
                <a href="javascript:" class="btn btn-lg btn-default btn-rounded">View All Collections</a>
            </div>
            
        </div>
    </section>
    <!-- Wedding Fashion Gallery End -->


    <!-- Callout Style Main Start -->
    <section class="call-out-bg">
        <div class="overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-md-0 txt-white">Are You Looking For Vendor For Your Wedding</h1>
                </div>
                <div class="col-lg-6 text-lg-right mt-lg-0 mt-md-4">
                    <a href="{{ url('/register') }}" class="btn btn-default btn-rounded btn-lg mr-3 mb-3">Get Started Now</a>
                    <a href="{{ url('/vendors/all') }}" class="btn btn-outline-default btn-rounded btn-lg mb-3">Our Services</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Callout Style Main End -->


</main>

@endsection