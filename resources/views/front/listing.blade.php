@extends('front.layouts.main_layout')

@section('title', 'Vendors')


@section('main-container')


<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Vendors</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item " aria-current="page">{{ ucwords( $city ) }}</li>
                @if($category)
                    <li class="breadcrumb-item " aria-current="page">{{ ucwords( $category ) }}</li>
                @endif
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

<main id="body-content">
 
    <section class="wide-tb-40">
        <div class="container">
            <!-- position vendors start -->
            @if( $position_vendors->count() > 0 )
                <div class="row">
                    @foreach($position_vendors as $vendor)
                    <?php
                        $image_path = vendor_helper::vendor_image_path($vendor->id);

                        $url = vendor_helper::vendor_profile_url($vendor->id);
                        $verified = vendor_helper::check_verified_vendor($vendor->id);

                        $paid = true ;

                    ?>
                    <div class="col-lg-4 col-md-6 my-4">
                        <div class="wedding-listing">
                            <div class="img">
                                <a href="javascript:">
                                    <img src="{{ $image_path }}" alt="">                                                    
                                </a>
                                <div class="img-content">
                                    <div class="top">
                                        <!-- <span class="price">
                                            <i class="fa fa-tag"></i>
                                            <span>$500-$800</span>
                                        </span> -->

                                        <!-- @if($vendor->is_featured)
                                        <span class="featured">
                                            <i class="fa fa-star"></i>
                                            <span>Featured</span>
                                        </span>
                                        @endif -->

                                        <!-- @if($vendor->is_top)
                                        <span class="is_top">
                                            <i class="fa fa-arrow-up"></i>
                                            <span>Top</span>
                                        </span>
                                        @endif -->

                                        @if($paid)
                                        <span class="is_verified">
                                            <i class="fa fa-check"></i>
                                            <span>verified</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="bottom">
                                        <a class="tags" href="{{ $url }}">
                                            {{ $vendor->category_name }}
                                        </a>
                                        <a class="favorite" href="javascript.html">
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="gap">
                                    <h3><a href="{{ $url }}"> {{$vendor->brandname }} {!! ($verified) ? '<span class="verified"><i class="fa fa-check-circle"></i></span>': '' !!} </a></h3>
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
                </div>
            @endif
            <!-- position vendors end -->

            <!-- all other vendors start -->
            @if( $all_vendors->count() > 0 )
            <div class="row">
                @foreach($all_vendors as $vendor)
                <?php
                    $image_path = vendor_helper::vendor_image_path($vendor->id);

                    $url = vendor_helper::vendor_profile_url($vendor->id);
                    $verified = vendor_helper::check_verified_vendor($vendor->id);
                    $wishlist = user_helper::check_wishlist($vendor->id);
                    $paid = true ;

                ?>
                <div class="col-lg-4 col-md-6 my-4">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="javascript:">
                                <img src="{{ $image_path }}" alt="">                                                    
                            </a>
                            <div class="img-content">
                                <div class="top">
                                    <!-- <span class="price">
                                        <i class="fa fa-tag"></i>
                                        <span>$500-$800</span>
                                    </span> -->

                                    <!-- @if($vendor->is_featured)
                                    <span class="featured">
                                        <i class="fa fa-star"></i>
                                        <span>Featured</span>
                                    </span>
                                    @endif -->

                                    <!-- @if($vendor->is_top)
                                    <span class="is_top">
                                        <i class="fa fa-arrow-up"></i>
                                        <span>Top</span>
                                    </span>
                                    @endif -->

                                    @if($paid)
                                    <span class="is_verified">
                                        <i class="fa fa-check"></i>
                                        <span>verified</span>
                                    </span>
                                    @endif
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="{{ $url }}">
                                        {{ $vendor->category_name }}
                                    </a>
                                     @if(Session::get('user_type') == 'user')
                                        <a href="javascript:void(0)" class="favorite wishlist {{ ( $wishlist == true) ? 'wishlist-active' : '' }}" id="wishlist-{{ $vendor->id }}"  data-vendor-id="{{ $vendor->id }}" data-action="{{ url('tools/wishlist/change-status/') }}" data-status="{{ ( $wishlist == true) ? '1' : '0' }}"><i class="fa fa-heart-o"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h3><a href="{{ $url }}"> {{$vendor->brandname }} {!! ($verified) ? '<span class="verified"><i class="fa fa-check-circle"></i></span>': '' !!} </a></h3>
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
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3>Vendors Not Available in {{ ucwords ($city) }} City.</h3>
                    </div>
                </div>
            </div>
            @endif
            <!-- all other vendors end -->
        </div>

        
        <div class="mt-4">
            <div class="theme-pagination">
                {!! $all_vendors->links() !!}
            </div>
        </div>
    </section>
    
</main>


@endsection
