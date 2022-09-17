@extends('front.layouts.main_layout')

@section('title', 'Vendor Details')


@section('main-container')


<main id="body-content">
    
    <!-- Vendor Profile Start -->
    <div class="vendor-profile-wrap">            
        <div class="container">
            <div class="row">
                <?php
                    $image_path = vendor_helper::vendor_image_path($vendor->id);
                ?>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="vendor-profile-banner ">
                        <img src="{{ $image_path }}" class="img-responsive" alt="imag">
                    </div>
                    <div class="vendor-profile-info">
                        <div class="vendor-profile-content profile-single">
                            <div class="title">
                                <h2>{{ $vendor->brandname }}</h2>
                                <h4 class="tags">{{ $vendor->category_name }}</h4>
                            </div>
                            <div class="content">
                                <p><i class="fa fa-map-marker"></i>  {{ $vendor->city_name }} India</p>
                                <div class="reviews">
                                <span class="badge"><i class="fa fa-star-half-full"></i> 0.0</span> 0 Reviews
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="send-message">
                        <div class="card-shadow pos-rel">
                            <?php
                                if(Session::get('user_type') == 'user'){
                                    $user_id = Session::get('user_id');

                                    $user = App\Models\User::where('id',$user_id)->first();
                                    $user_details = App\Models\UserDetail::where('user_id',$user_id)->first();

                                    $email = Session::get('email');
                                    $name = Session::get('name');
                                    $mobile = $user->mobile;
                                    $event = $user_details->event;
                                    $is_logged_in = true;
                                }else{
                                    $user_id = "";
                                    $email = "";
                                    $name = "";
                                    $mobile = "";
                                    $event = "";
                                    $is_logged_in = false;
                                }
                            ?>
                            <div class="card-shadow-body">
                                <ul class="nav nav-pills theme-tabbing nav-fill" id="bpills-ta" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-send-tab" data-toggle="pill" href="#pills-send" role="tab" aria-controls="pills-send" aria-selected="false"><i class="fa fa-mobile"></i> Send Message</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-view-tab" data-toggle="pill" href="#pills-view" role="tab" aria-controls="pills-view" aria-selected="true"><i class="fa fa-list"></i> View Contact</a>
                                    </li>
                                </ul>
                                <div class="tab-content theme-tabbing" id="pills-tabContent">
                                    <div class="tab-pane fade" id="pills-send" role="tabpanel" aria-labelledby="pills-send-tab">
                                        <div class="send-message-message"></div>
                                    
                                        <div class="send-message-form">
                                            <form data-action="{{ url('/query/send-message') }}" method="post" class="query">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="name" id="name" placeholder="Full Name" value="{{ $name }}" class="form-control" />
                                                        <span class="text-danger error" id="name_error"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" name="number" id="number" placeholder="Phone Number" value="{{ $mobile }}" class="form-control" />
                                                        <span class="text-danger error" id="number_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <select name="budget" id="budget" class="form-light-select theme-combo">
                                                            <option value="0">Select Budget</option>
                                                            <option value="0-5000">0 - 5000</option>
                                                            <option value="5000-10000">5000 - 10000</option>
                                                            <option value="10000-20000">10000 - 20000</option>
                                                            <option value="20000-50000">20000 - 50000</option>
                                                            <option value="50000-100000">50000 - 100000</option>
                                                            <option value="100000-200000">100000 - 200000</option>
                                                        </select>
                                                        <span class="text-danger error" id="budget_error"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="Event Date" class="form-control" name="event" id="event"  data-toggle="datepicker" value="{{ $event }}" >
                                                        <span class="text-danger error" id="event_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <textarea rows="6" placeholder="Details About Your Wedding" name="details" class="form-control" cols="1" rows="1"></textarea>
                                                </div>
                                                
                                                @if(Session::get('user_type') == 'user')
                                                    <input type="hidden" name="user_id" value="{{ $user_id }}" />
                                                @endif
                                                <input type="hidden" name="is_logged_in"  value="{{ $is_logged_in }}">
                                                <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                                <button type="submit" name="send-message" class="btn btn-primary btn-block btn-rounded" id="send-message-button">Send Message</button>
                                            </form>
                                        </div>
                                        <div class="send-message-otp-div d-none mt-4">
                                            <form data-action="{{ url('query/otp') }}" class="verify_otp">
                                                <div class="row">
                                                    <div class="col-md-12 print-error-msg"></div>
                                                    <div class="col-md-12 text-center">
                                                        <h4>An OTP has been sent to <span id="mobile"></span></h3>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                        <div class="form-group">
                                                            <input id="send_message_otp" name="send_message_otp" type="number" placeholder="Enter OTP" class="form-control">
                                                            <span class="text-danger error" id="send_message_otp_error"></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="otp_id" id="otp_id" value="">
                                                            <input type="hidden" name="query_id" id="query_id" value="">
                                                            <input type="hidden" name="type" id="type" value="">
                                                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                                            <button type="submit" class="btn btn-default">Verify OTP</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>

                                    <div class="tab-pane fade" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab">
                                        <div class="view-contact-message"></div>

                                        <div class="view-contact-form">
                                            <form action="" method="post" data-action="{{ url('/query/view-contact') }}" method="post" class="query">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" value="{{ $name }}" class="form-control" />
                                                        <span class="text-danger error" id="full_name_error"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" name="mobile" id="mobile" placeholder="Phone Number" value="{{ $mobile }}" class="form-control" />
                                                        <span class="text-danger error" id="mobile_error"></span>
                                                    </div>
                                                </div>
                                                @if(Session::get('user_type') == 'user')
                                                    <input type="hidden" name="user_id" value="{{ $user_id }}" />
                                                @endif
                                                <input type="hidden" name="is_logged_in"  value="{{ $is_logged_in }}">
                                                <input type="hidden" name="type"  value="view_contact">
                                                <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                                <button type="submit" class="btn btn-primary btn-block btn-rounded">View Contact</button>
                                            </form>
                                        </div>
                                        <div class="view-contact-otp-div d-none mt-4 ">
                                            <form data-action="{{ url('query/otp') }}" class="verify_otp">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4>An OTP has been sent to <span id="mobile_1"></span></h3>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                        <div class="form-group">
                                                            <input id="view_contact_otp" name="view_contact_otp" type="number" placeholder="Enter OTP" class="form-control">
                                                            <span class="text-danger error" id="view_contact_otp_error"></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="otp_id" id="otp_id_1" value="">
                                                            <input type="hidden" name="query_id" id="query_id_1" value="">
                                                            <input type="hidden" name="type" id="type_1" value="">
                                                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                                            <button type="submit" class="btn btn-default">Verify OTP</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="view-contact-vendor"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Vendor Profile Start -->

    <!-- Vendor Profile Navigation -->
    <div class="container vendor-nav-sticky">
        <div class="vendor-nav text-center">
            <a href="#description"><i class="fa fa-file-text"></i> Description</a>
            <a href="#service_offered"><i class="fa fa-list"></i> Service Offered</a>
            <a href="#gallery"><i class="fa fa-image"></i> Gallery</a>
            <a href="#videos"><i class="fa fa-video-camera"></i> Videos</a>
            <a href="#reviews"><i class="fa fa-star-half-full"></i> Reviews</a>
            <a href="#location"><i class="fa fa-map-marker"></i> Location</a>
        </div>
    </div>
    <!-- Vendor Profile Navigation -->

    <section class="wide-tb-90 pt-0">
        <div class="container">
            <div class="row">

                <!-- Vendor Single Content -->
                <div class="col-lg-8 col-md-12">

                    <!-- Description -->
                    <div class="card-shadow pos-rel">
                        <a id="description" class="anchor-fake"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-file-text"></i> Description</h3>
                        </div>
                        @if($vendor->description)
                        <div class="card-shadow-body">
                            {{ $vendor->description }}
                        </div>
                        @endif
                    </div>
                    <!-- Description -->

                    <!-- Service Offered -->
                    <div class="card-shadow pos-rel">
                        <a id="service_offered" class="anchor-fake"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-list"></i> Service Offered</h3>
                        </div>
                        @if($vendor->service_offered)
                        <div class="card-shadow-body">
                            {{ $vendor->service_offered }}
                        </div>
                        @endif
                    </div>
                    <!-- Service Offered -->

                    <!-- Gallery -->
                    <div class="card-shadow pos-rel">
                        <a id="gallery" class="anchor-fake"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-image"></i> Gallery</h3>
                        </div>
                        @if($gallery->count() > 0)
                        <div class="card-shadow-body">
                            <div class="row vendor-img-gallery">
                                @foreach($gallery as $image)
                                    <?php
                                        $image_path = vendor_helper::gallery_image_path($vendor->id,$image->name);
                                    ?>
                                    <div class="col-md-3">
                                        <div class="vendor-gallery">
                                            <a href="{{ $image_path }}" title="{{$image->name}}">
                                                <img src="{{ $image_path }}" class="rounded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>
                            <!-- <div id="vendor-img-gallery">
                                <div class="row vendor-img-gallery">                                       
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="assets/images/vendors/vendor_img_5.jpg" title="Title come here">
                                                <img src="{{ asset('front/images/vendors/vendor_img_5.jpg') }}" class="rounded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="assets/images/vendors/vendor_img_6.jpg" title="Title come here">
                                                <img src="{{ asset('front/images/vendors/vendor_img_6.jpg') }}" class="rounded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="assets/images/vendors/vendor_img_7.jpg" title="Title come here">
                                                <img src="{{ asset('front/images/vendors/vendor_img_7.jpg') }}" class="rounded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="gallery-btn">
                                <a data-toggle="collapse" href="#vendor-img-gallery" role="button" aria-expanded="false" class="collapsed"><i class="fa fa-angle-down"></i> <span>3 More</span></a>
                            </div> -->
                        </div>
                        @endif
                    </div>
                    <!-- Gallery -->

                    <!-- Videos -->
                    <div class="card-shadow pos-rel">
                        <a id="videos" class="anchor-fake"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-video-camera"></i> Videos</h3>
                        </div>
                        @if($vendor->youtube)
                        <div class="card-shadow-body">
                            <div class="vendor-video">
                                <a class="popup-video" href="http://www.youtube.com/watch?v=0O2aH4XLbto">
                                    <i class="fa fa-play"></i>
                                    <img src="{{ asset('front/images/vendors/vendor_video.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Videos -->


                    <!-- Location -->
                    <div class="card-shadow pos-rel">
                        <a id="location" class="anchor-fake"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-map-marker"></i> Location</h3>
                        </div>
                        @if($vendor->address)
                        <div class="card-shadow-body">
                            <div id="map-holder">
                                <div id="map_extended" class="vendor-single-popup-wrap">
                                    <p>{{ $vendor->address }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Location -->
                    <?php /*
                    <!-- Reviews -->
                    <div class="card-shadow pos-rel">
                        <a id="reviews" class="anchor-fake"></a>
                        <div class="card-shadow-header d-md-flex justify-content-between align-items-center">
                            <h3><i class="fa fa-star-o"></i> Reviews of {{ $vendor->name }} for {{ $vendor->category_name }} Category</h3>
                            <a href="#review-form" class="btn btn-sm btn-dark mt-3 mt-md-0" id="write-review-form">Write A Review</a>
                        </div>
                        <div class="card-shadow-body border-bottom">
                            <div class="row no-gutters">
                                <div class="col-md-auto">
                                    <div class="review-count">
                                        <span>3.8</span>
                                        <small>out of 5.0</small>
                                        <div class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <!-- review-option -->
                                        <div class="col-md-4">
                                            <div class="review-option">
                                                <div class="icon">
                                                    <i class="fa fa-smile-o"></i> <span class="review-each-count">4.9</span>
                                                </div>
                                                <div class="count">
                                                    <strong>Quality Service</strong>
                                                    <div>
                                                        <div class="bar-base">
                                                            <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review-option -->

                                        <!-- review-option -->
                                        <div class="col-md-4">
                                            <div class="review-option">
                                                <div class="icon">
                                                    <i class="fa fa-exchange"></i> <span class="review-each-count">3.7</span>
                                                </div>
                                                <div class="count">
                                                    <strong>Facilities</strong>
                                                    <div>
                                                        <div class="bar-base">
                                                            <div class="bar-filled" style="width: 67%;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review-option -->

                                        <!-- review-option -->
                                        <div class="col-md-4">
                                            <div class="review-option">
                                                <div class="icon">
                                                    <i class="fa fa-male"></i> <span class="review-each-count">4.0</span>
                                                </div>
                                                <div class="count">
                                                    <strong>Staff</strong>
                                                    <div>
                                                        <div class="bar-base">
                                                            <div class="bar-filled" style="width: 75%;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review-option -->

                                        <!-- review-option -->
                                        <div class="col-md-4">
                                            <div class="review-option">
                                                <div class="icon">
                                                    <i class="fa fa-sliders"></i> <span class="review-each-count">4.9</span>
                                                </div>
                                                <div class="count">
                                                    <strong>Flexibility</strong>
                                                    <div>
                                                        <div class="bar-base">
                                                            <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review-option -->

                                        <!-- review-option -->
                                        <div class="col-md-4">
                                            <div class="review-option">
                                                <div class="icon">
                                                    <i class="fa fa-dollar"></i> <span class="review-each-count">4.9</span>
                                                </div>
                                                <div class="count">
                                                    <strong>Value of money</strong>
                                                    <div>
                                                        <div class="bar-base">
                                                            <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- review-option -->
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-shadow-body d-md-flex justify-content-between align-items-center py-3">
                            <strong>19 Reviews for Matrimony Wedding Photography</strong>
                            <div class="d-flex align-items-center col-md-5 col-12 p-0 mt-3 mt-md-0">
                                <small class="text-nowrap mr-3 ">Sort by</small>
                                <select class="theme-combo" name="state">
                                    <option value="AL">Rating: Highest</option>
                                    <option value="WY">Rating: Lowest</option>
                                    <option value="WY">Rating: Dates</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-shadow-body border-top">
                            <!-- Review Media -->
                            <div class="reviews-media">
                                <div class="media">
                                    <img class="thumb" src="asset/images/thumb_img_1.jpg" alt="">
                                    <div class="media-body">
                                        <div class="heading-wrap no-gutters">
                                            <div class="heading">
                                                <div class="col pl-0">
                                                    <h4 class="mb-0">Karon Balina</h4>
                                                    <div class="review-option-btn">
                                                        <a data-toggle="collapse" href="#review-option-toggle-1" role="button" aria-expanded="false" class="collapsed">
                                                            <span class="stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>                                    
                                                            </span>
                                                            <span>4.2 <i class="fa fa-angle-down arrow"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <small>Married on 17, Sep, 2020</small>
                                                </div>
                                            </div>
                                            <div id="review-option-toggle-1" class="collapse" >
                                                <div class="row">
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-smile-o"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Quality Service</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-exchange"></i> <span class="review-each-count">3.7</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Facilities</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 67%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-male"></i> <span class="review-each-count">4.0</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Staff</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 75%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-sliders"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Flexibility</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-dollar"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Value of money</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h3 class="fw-7">Excellent service</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Media -->

                            <!-- Review Media -->
                            <div class="reviews-media">
                                <div class="media">
                                    <img class="thumb" src="asset/images/thumb_img_3.jpg" alt="">
                                    <div class="media-body">
                                        <div class="heading-wrap no-gutters">
                                            <div class="heading">
                                                <div class="col pl-0">
                                                    <h4 class="mb-0">Karon Balina</h4>
                                                    <div class="review-option-btn">
                                                        <a data-toggle="collapse" href="#review-option-toggle-2" role="button" aria-expanded="false" class="collapsed">
                                                            <span class="stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>                                    
                                                            </span>
                                                            <span>4.2 <i class="fa fa-angle-down arrow"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <small>Married on 17, Sep, 2020</small>
                                                </div>
                                            </div>
                                            <div id="review-option-toggle-2" class="collapse" >
                                                <div class="row">
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-smile-o"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Quality Service</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-exchange"></i> <span class="review-each-count">3.7</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Facilities</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 67%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-male"></i> <span class="review-each-count">4.0</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Staff</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 75%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-sliders"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Flexibility</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-dollar"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Value of money</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h3 class="fw-7">Excellent service</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="media reply-box">
                                            <img src="assets/images/thumb_img_2.jpg" alt="" class="thumb ">
                                            <div class="media-body">
                                                <div class="d-md-flex justify-content-between mb-3">
                                                    <h4 class="mb-0">Sofia Lorence</h4>
                                                    <small class="txt-blue">17, Aug, 2020</small>
                                                </div>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                                                purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                                                vulputate fringilla. Donec lacinia congue felis in faucibus.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Media -->

                            <!-- Review Media -->
                            <div class="reviews-media">
                                <div class="media">
                                    <img class="thumb" src="asset/images/thumb_img_4.jpg" alt="">
                                    <div class="media-body">
                                        <div class="heading-wrap no-gutters">
                                            <div class="heading">
                                                <div class="col pl-0">
                                                    <h4 class="mb-0">Karon Balina</h4>
                                                    <div class="review-option-btn">
                                                        <a data-toggle="collapse" href="#review-option-toggle-3" role="button" aria-expanded="false" class="collapsed">
                                                            <span class="stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>                                    
                                                            </span>
                                                            <span>4.2 <i class="fa fa-angle-down arrow"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <small>Married on 17, Sep, 2020</small>
                                                </div>
                                            </div>
                                            <div id="review-option-toggle-3" class="collapse" >
                                                <div class="row">
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-smile-o"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Quality Service</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-exchange"></i> <span class="review-each-count">3.7</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Facilities</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 67%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-male"></i> <span class="review-each-count">4.0</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Staff</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 75%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-sliders"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Flexibility</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
        
                                                    <!-- review-option -->
                                                    <div class="col-md-4">
                                                        <div class="review-option">
                                                            <div class="icon">
                                                                <i class="fa fa-dollar"></i> <span class="review-each-count">4.9</span>
                                                            </div>
                                                            <div class="count">
                                                                <strong>Value of money</strong>
                                                                <div>
                                                                    <div class="bar-base">
                                                                        <div class="bar-filled" style="width: 80%;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- review-option -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h3 class="fw-7">Best weekend ever</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Media -->

                            <div class="text-center">
                                <a href="javascript:" class="btn btn-default btn-rounded">See more reviews</a>
                            </div>
                        </div>
                    </div>
                    <!-- Reviews -->
                    */ ?>
                    <!-- Write A Review -->
                    <div class="card-shadow pos-rel" >
                        <a id="review-form" class="anchor-fake" tabindex="-1"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-pencil"></i> Write A Review</h3>
                        </div>
                        <div class="card-shadow-body">

                            <div class="row rating-stars-wrap">
                                <!-- review-option -->
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                    <div class="review-option">
                                        <div class="icon">
                                            <i class="fa fa-smile-o"></i>
                                        </div>
                                        <div class="count">
                                            <strong>Quality Service</strong>
                                            <div class="rating-stars">
                                                <a href="#5" title="Give 5 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#4" title="Give 4 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#3" title="Give 3 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#2" title="Give 2 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#1" title="Give 1 star"><i class="fa fa-star-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review-option -->
                            
                                <!-- review-option -->
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                    <div class="review-option">
                                        <div class="icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <div class="count">
                                            <strong>Facilities</strong>
                                            <div class="rating-stars">
                                                <a href="#5" title="Give 5 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#4" title="Give 4 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#3" title="Give 3 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#2" title="Give 2 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#1" title="Give 1 star"><i class="fa fa-star-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review-option -->
                            
                                <!-- review-option -->
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                    <div class="review-option">
                                        <div class="icon">
                                            <i class="fa fa-male"></i>
                                        </div>
                                        <div class="count">
                                            <strong>Staff</strong>
                                            <div class="rating-stars">
                                                <a href="#5" title="Give 5 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#4" title="Give 4 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#3" title="Give 3 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#2" title="Give 2 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#1" title="Give 1 star"><i class="fa fa-star-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review-option -->
                            
                                <!-- review-option -->
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                    <div class="review-option">
                                        <div class="icon">
                                            <i class="fa fa-sliders"></i>
                                        </div>
                                        <div class="count">
                                            <strong>Flexibility</strong>
                                            <div class="rating-stars">
                                                <a href="#5" title="Give 5 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#4" title="Give 4 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#3" title="Give 3 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#2" title="Give 2 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#1" title="Give 1 star"><i class="fa fa-star-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review-option -->
                            
                                <!-- review-option -->
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                    <div class="review-option">
                                        <div class="icon">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div class="count">
                                            <strong>Value of money</strong>
                                            <div class="rating-stars">
                                                <a href="#5" title="Give 5 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#4" title="Give 4 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#3" title="Give 3 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#2" title="Give 2 stars"><i class="fa fa-star-o"></i></a>
                                                <a href="#1" title="Give 1 star"><i class="fa fa-star-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review-option -->
                            
                            </div>

                            <!-- Leave a Reply -->
                            <div class="row mt-4">
                                <div class="col-md-12 mb-0">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" placeholder="Your Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-0">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    </div>
                                </div>                                    
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Post Your Comment</button>                                    
                            </div>
                            <!-- Leave a Reply -->
                        </div>
                    </div>
                    <!-- Write A Review -->

                    

                </div>
                <!-- Vendor Single Content -->

                <!-- Vendor Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <aside class="row sidebar-widgets">
                        <!-- Sidebar Primary Start -->
                        <div class="sidebar-primary col-lg-12 col-md-6">

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Categories</h3>
                                
                                <div class="icon-box-style-3 sided">
                                    @if($vendor->icon)
                                        {!! $vendor->icon !!} 
                                    @else
                                        <i class="fa fa-life-ring"></i>
                                    @endif
                                    <span> {{ $vendor->category_name }} </span>
                                </div>
                            </div>
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Travel to Client Venue</h3>
                                
                                <div class="icon-box-style-3 sided">
                                    <i class="fa fa-map-marker"></i>
                                    <span> {{ ($vendor->is_travelable == 1) ? 'Yes': 'No' }} </span>
                                </div>
                            </div>
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Cancel Policy</h3>
                                
                                <div class="icon-box-style-3 sided">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                    <span> {{ $vendor->cancel_policy }} </span>
                                </div>
                            </div>
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Advance Payment</h3>
                                
                                <div class="icon-box-style-3 sided">
                                    <i class="fa fa-inr"></i>
                                    <span> {{ $vendor->advance_payment }}% </span>
                                </div>
                            </div>
                            <!-- Widget Wrap -->

                            
                            <!-- Widget Wrap -->
                            @if($vendor->gender)
                            <div class="widget">
                                <h3 class="widget-title">Advance Payment</h3>
                                
                                <div class="icon-box-style-3 sided">
                                    <i class="weddingdir_gender"></i>
                                    <span> {{ $vendor->gender }} </span>
                                </div>
                            </div>
                            @endif
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Statistics</h3>
                                
                                <div class="row">
                                    
                                    <div class="col-6 mb-0">
                                        <div class="icon-box-style-3 sided">
                                            <i class="fa fa-star-o"></i>
                                            <span> 0 Rating</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-0">
                                        <div class="icon-box-style-3 sided">
                                            <i class="fa fa-heart-o"></i>
                                            <span> 0 Favorite</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Widget Wrap -->

                            <div></div>
                        </div>
                        <!-- Sidebar Primary End -->

                        <!-- Sidebar Secondary Start -->
                        <div class="sidebar-secondary col-lg-12 col-md-6">

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Vendor Profile</h3>
                                <?php
                                    $image_path = vendor_helper::vendor_image_path($vendor->id);
                                ?>
                                <div class="profile-avatar">
                                    <img src="{{ $image_path }}" alt="">
                                    <div class="content">
                                        <small>Added By</small>
                                        {{ $vendor->name }}
                                    </div>
                                </div>
                                
                                <!-- <p>Proin viverra tincidunt lectus at sodales. Nam vitae dolor ipsum. Aenean at molestie nisl, id rhoncus orci.</p> -->

                                <div class="icon-box-style-3 sided mt-3 mb-0">
                                    <i class="fa fa-phone"></i>
                                    <span id="mobile"> **********</span>
                                </div>

                                <!--@if($social_media)
                                <div class="icon-box-style-3 sided mt-3 mb-0">
                                    <i class="fa fa-envelope-o"></i>
                                    <span> <a href="javascript:" class="btn-link btn-link-secondary"> {{ $social_media->website }} </a> </span>
                                </div>
                                @endif

                                 <div class="social-sharing sidebar-social border-top">
                                    <a href="javascript:" class="share-btn-facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript:" class="share-btn-twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="javascript:" class="share-btn-instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="javascript:" class="share-btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                </div> -->
                            </div>
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            @if($featured_vendors)
                            <div class="widget">
                                <h3 class="widget-title">Featured Listing</h3>
                                <div class="owl-carousel owl-theme" id="wedding-listing-single">                        
                                    <!-- Wedding Lisiting Single -->
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
                                                    <h3><a href="{{ $url }}">{{ $vendor->name }} ( {{$vendor->brandname }} ) {!! ($verified) ? '<span class="verified"><i class="fa fa-check-circle"></i></span>': '' !!} </a></h3>
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
                                    <!-- Wedding Lisiting Single -->

                                    
                                </div>
                            </div>
                            @endif
                            <!-- Widget Wrap -->
                        </div>
                        <!-- Sidebar Secondary End -->

                        
                    </aside>
                </div>
                <!-- Vendor Sidebar -->
            </div>
        </div>
    </section>
    
</main>

@endsection
