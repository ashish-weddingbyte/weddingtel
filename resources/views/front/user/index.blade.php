@extends('front.layouts.main_layout')

@section('title', 'Home')


@section('main-container')
    <section class="slider-wrap style-second">
        <div class="slider-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 mx-auto">
                        <h1>Find the Perfect Wedding Vendor</h1>
                        <p class="lead txt-white text-center">Search over 360,000 wedding vendors with reviews, pricing, availability and more</p>
                        <div class="form-bg row no-gutters align-items-center">
                            <div class="col-12 col-md-5">
                                <select class="form-light-select theme-combo home-select-1" name="state">
                                    <option>Choose Vendor Type</option>
                                    <option value="AL">Vendor Type 1</option>
                                    <option value="WY">Vendor Type 2</option>
                                    <option value="WY">Vendor Type 3</option>
                                    <option value="WY">Vendor Type 4</option>
                                    <option value="WY">Vendor Type 5</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="px-2 w-100">
                                    <select class="form-light-select theme-combo home-select-2" name="state">
                                        <option>Choose Location</option>
                                        <option value="AL">Mumbai</option>
                                        <option value="WY">Goa</option>
                                        <option value="WY">Surat</option>
                                        <option value="WY">Delhi</option>
                                        <option value="WY">Baroda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <a href="right-side-map-listing.html" class="btn btn-default text-nowrap btn-block" >Search Now</a>
                            </div>
                        </div>
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


    <!-- Top Wedding Vendors Start -->
    <section class="wide-tb-50">
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
                                    <a href="{{ url('/vendors/all/'.$category->category_url) }}"><img src="{{ asset('front/default_image/default_category.jpg')}}" alt=""></a>
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
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-1">

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_1.jpg') }}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_camera"></i> <a href="javascript:">Photographer</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_2.jpg')}}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_venue"></i> <a href="javascript:">Venue & Hall</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_10.jpg')}}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_flowers"></i> <a href="javascript:">Florist</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_11.jpg')}}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_cake_stand"></i> <a href="javascript:">Wedding Cake</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_12.jpg')}}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_fashion"></i> <a href="javascript:">Fashion</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->

                <!-- Vendor Listing Wrap -->
                <div class="col">
                    <div class="vendor-wrap-alt">
                        <div class="img">
                            <img src="{{ asset('front/images/vendors/vendor_img_13.jpg')}}" alt="">
                            <div class="img-content">
                                <span class="rating">4.4</span>
                                <a href="javascript:" class="favorite"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </div>

                        <div class="content">
                            <div class="vendor-heading">
                                <h3><i class="weddingdir_music"></i> <a href="javascript:">Music & DJ</a></h3>
                                <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#request_quote">Get A Quote</a>
                            </div>
                            <div class="mb-2"><a href="mailto:Info@yourdomain.com" class="btn-link"><i class="fa fa-envelope"></i> Info@yourdomain.com</a></div>
                            <div><a href="tel:+08-125-852-9966" class="btn-link"><i class="fa fa-phone"></i> +08 125 852 9966</a></div>                                
                        </div>
                        <div class="content-footer">
                            <a class="btn btn-light btn-sm" href="javascript:">Follow Us</a>
                            <span class="dropdown hover_out">
                                <a class="btn btn-light btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i> Share
                                </a>
                                
                                <span class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Vendor Listing Wrap -->                    

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
            <div class="owl-carousel owl-theme dots-black" id="home-slider-listing">                        
                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_1.jpg')}}" alt="">                                                    
                            </a>
                            <div class="img-content">
                                <div class="top">
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Fashion
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Happy Wedding Fashions <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->

                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_2.jpg')}}" alt="">
                            </a>
                            <div class="img-content">
                                <div class="top">                                                           
                                    <span class="featured">
                                        <i class="fa fa-star"></i>
                                        <span>Featured</span>
                                    </span>
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Photography
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Cool Wed Photography <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->

                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_3.jpg')}}" alt="">
                            </a>
                            <div class="img-content">
                                <div class="top">
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Flora
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Lotus Wedding Florist <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->

                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_4.jpg')}}" alt="">                                                    
                            </a>
                            <div class="img-content">
                                <div class="top">
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Fashion
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Happy Wedding Fashions <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->

                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_5.jpg')}}" alt="">
                            </a>
                            <div class="img-content">
                                <div class="top">                                                           
                                    <span class="featured">
                                        <i class="fa fa-star"></i>
                                        <span>Featured</span>
                                    </span>
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Photography
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Cool Wed Photography <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->

                <!-- Wedding List -->
                <div class="item">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ asset('front/images/weddings/wedding_listing_6.jpg')}}" alt="">
                            </a>
                            <div class="img-content">
                                <div class="top">
                                    <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:">
                                        Flora
                                    </a>
                                    <a class="favorite" href="javascript:">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="listing-singular.html">Lotus Wedding Florist <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                <!-- Wedding List -->
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

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Post Blog -->
                    <div class="blog-wrap-home">                            
                        <div class="post-content">
                            <!-- Post Blog Image -->
                            <div class="post-img">
                                <img src="{{ asset('front/images/blogs/blog_home_1.jpg')}}" alt="">
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
                        <p class="lead">Sed ut perspiciatis unde omnis iste oluptatem accusantium doloremque laud.</p>
                        <a href="contact-us.html" class="btn btn-default btn-rounded btn-lg">Contact Us</a>
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
                                <h3><a href="right-side-map-listing.html">Mumbai</a> <span>12 Listings</span></h3>
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
                                <h3><a href="right-side-map-listing.html">Ahmedabad</a> <span>10 Listings</span></h3>
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
                                <h3><a href="right-side-map-listing.html">Koltaka</a> <span>30 Listings</span></h3>
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
                                <h3><a href="right-side-map-listing.html">Noida</a> <span>15 Listings</span></h3>
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
                                <h3><a href="right-side-map-listing.html">Delhi</a> <span>25 Listings</span></h3>
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
                                <h3><a href="right-side-map-listing.html">Kerala</a> <span>13 Listings</span></h3>
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
                                    <h3>Mark Hunter</h3>
                                    <div>New York, USA</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">
                                Sed ut perspiciatis unde omnis iste nat error sit voluptatem accusantium doau dantium totam rem aperiam eaque.
                            </div>
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
                                    <h3>Mark Hunter</h3>
                                    <div>New York, USA</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">
                                Sed ut perspiciatis unde omnis iste nat error sit voluptatem accusantium doau dantium totam rem aperiam eaque.
                            </div>
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
                                    <h3>Mark Hunter</h3>
                                    <div>New York, USA</div>
                                </div>
                                <div class="icon"><i class="weddingdir_chat"></i></div>
                            </div>
                            <div class="text">
                                Sed ut perspiciatis unde omnis iste nat error sit voluptatem accusantium doau dantium totam rem aperiam eaque.
                            </div>
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
                                <h5 class="price">Price $300</h5>
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
                                <h5 class="price">Price $450</h5>
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
                                <h5 class="price">Price $350</h5>
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
                                <h5 class="price">Price $480</h5>
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
                    <a href="javascript:" class="btn btn-default btn-rounded btn-lg mr-3 mb-3">Get Started Now</a>
                    <a href="javascript:" class="btn btn-outline-default btn-rounded btn-lg mb-3">Our Services</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Callout Style Main End -->


    <!-- Wedding Plannign  Start -->
    <section class="wide-tb-50">
        <div class="container">
            <div class="section-title text-center">
                <h1>Wedding Planning Tool</h1>
            </div>            
            <div class="row">
                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_budget"></i>
                        </div>
                        <h4>Budget</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->

                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_calendar_heart"></i>
                        </div>
                        <h4>Guest List</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->

                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_seating_chart"></i>
                        </div>
                        <h4>Seating Chart</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->

                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_bell"></i>
                        </div>
                        <h4>Check List</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->

                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_heart_ring"></i>
                        </div>
                        <h4>Real Weddings</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->

                <!-- Features Icons -->
                <div class="col-lg-4 col-xl-2 text-center col-6">
                    <div class="why-choose-icons">
                        <div class="icon-big-cirlce mx-auto">
                            <i class="weddingdir_shopping_bag_heart"></i>
                        </div>
                        <h4>Vendors</h4>
                        <!-- <a href="javascript:" class="circle-arrow"><i class="fa fa-angle-right"></i></a> -->
                    </div>
                </div>
                <!-- Features Icons -->
                
            </div>
        </div>
    </section>
    <!-- Wedding Plannign  End -->

</main>

@endsection