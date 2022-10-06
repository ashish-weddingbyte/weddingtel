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

                    <div class="widget mt-5">
                        <div class="text-center">
                            <a href="#review-form" class="btn btn-primary btn-sm btn-rounded" id="write-review-form">Write A Review</a>
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
                            {!! $vendor->description !!}
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
                            {!! $vendor->service_offered !!}
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
                        <?php
                            $url = vendor_helper::youtube_url($vendor->youtube);
                            $youtube_image_path = vendor_helper::youtube_thumbnail($vendor->youtube);
                        ?>
                        <div class="card-shadow-body">
                            <div class="vendor-video">
                                <a class="popup-video" href="{{ $url }}">
                                    <i class="fa fa-play"></i>
                                    <img src="{{ $youtube_image_path }}" alt="" height="100%" width="100%">
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
                    
                    <!-- Write A Review -->
                    <div class="card-shadow pos-rel" >
                        <a id="review-form" class="anchor-fake" tabindex="-1"></a>
                        <div class="card-shadow-header">
                            <h3><i class="fa fa-pencil"></i> Write A Review</h3>
                        </div>
                        <div class="card-shadow-body">
                            @if(Session::has('message'))
                                <div class="alert {{session('class')}}">
                                    <span>{{session('message')}}</sapn>
                                </div>
                            @endif
                            <form action="{{ url('write-review') }}" method="post">
                                @csrf
                                <div class="row rating-stars-wrap">
                                    <div class="from-group ml-2">
                                        <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                        <label class="star star-1" for="star-1"></label>
                                        @error('star')
                                            <div class="text-danger ml-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Leave a Reply -->
                                <div class="row">
                                    <div class="col-md-12 mb-0">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="comment" placeholder="Your Comments">{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(Session::get('user_type') == 'user')
                                        <input type="hidden" name="name" value="{{ Session::get('name') }}">

                                        <input type="hidden" name="email" value="{{ Session::get('email') }}">

                                        <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
                                    @else

                                        <div class="col-md-6 mb-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Your Name">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Your Email">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" value="" />
                                    @endif                                    
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                    <button type="submit" class="btn btn-primary">Post Your Review</button>                                    
                                </div>
                            </form>
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
