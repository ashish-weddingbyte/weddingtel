@extends('front.layouts.main_layout')

@section('title', 'Vendors')


@section('main-container')


<section class="search-result-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <h1>Find the Perfect Wedding Vendor</h1>
                <?php
                    $categories = App\Models\Category::where('status','1')->get();
                    $cities = App\Models\City::where('status','1')->get();

                    $city_from_url = request()->segment(2);
                    $category_form_url = request()->segment(3);
                    $keyword_form_url = request()->segment(4);

                ?>
                <form action="{{ url('search-keyword') }}" method="post">
                    @csrf
                    <div class="form-bg row no-gutters align-items-center">
                        <div class="col-12 col-md-3">
                            <select class="form-light-select theme-combo" name="category" >
                                <option value='0'>Choose Vendor Type</option>
                                <option value="all" {{ ($city_from_url == 'all')?'selected':''}}>All Categories</option>
                                @if($categories)
                                    @foreach($categories as $category)
                                        @if($category->category_url == $category_form_url)
                                            <option value="{{ $category->category_url }}" selected>{{ $category->category_name }}</option>
                                        @else
                                            <option value="{{ $category->category_url }}">{{ $category->category_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select class="form-light-select theme-combo" name="city">
                                <option value='0'>Choose Location</option> 
                                <option value="all" {{ ($city_from_url == 'all')?'selected':''}}>All Cities</option>
                                @if($cities)   
                                    @foreach($cities as $city)
                                        @if($city->name == $city_from_url)
                                            <option value="{{ $city->name }}" selected>{{ $city->name }}</option>
                                        @else
                                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" name="keyword" placeholder="Keyword" value="{{ $keyword_form_url }}">
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="submit" value="Search Now" class="btn btn-default text-nowrap btn-block" name="search" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="view-by">
            <strong>View By</strong> 
            @if(!empty($city_from_url))
                <a href="javascript:void(0)" class="selected-tags btn-link-primary">{{ $city_from_url }}</a>
            @endif
            @if(!empty($category_form_url))
                <a href="javascript:void(0)" class="selected-tags btn-link-primary">{{$category_form_url }}</a>
            @endif
            &nbsp; &nbsp;
            @if(!empty($keyword_form_url))
                <a href="javascript:void(0)" class="selected-tags btn-link-primary">{{ $keyword_form_url }}</a>
            @endif
        </div>            
    </div>
</section>


<main id="body-content">
 
    <section class="wide-tb-40">
        <div class="container">
            <div class="row">
                <!-- position vendors start -->
                @if( $position_vendors->count() > 0 )
                    
                    @foreach($position_vendors as $vendor)
                    <?php
                        $image_path = vendor_helper::vendor_image_path($vendor->id);

                        $url = vendor_helper::vendor_profile_url($vendor->id);
                        $verified = vendor_helper::check_verified_vendor($vendor->id);
                        $rating = vendor_helper::get_rating_of_vendor($vendor->id);
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
                                        {!! str_repeat('<span><i class="fa fa-star"></i></span>', round($rating['avg']) ) !!}
                                        {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - round($rating['avg']) ) !!}                                    
                                    </span>
                                    ({{ $rating['count'] }} review)
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                @endif
                <!-- position vendors end -->

                <!-- all other vendors start -->
                @if( $all_vendors->count() > 0 )
                
                    @foreach($all_vendors as $vendor)
                    <?php
                        $image_path = vendor_helper::vendor_image_path($vendor->id);

                        $url = vendor_helper::vendor_profile_url($vendor->id);
                        $verified = vendor_helper::check_verified_vendor($vendor->id);
                        $wishlist = user_helper::check_wishlist($vendor->id);
                        $paid = true ;
                        $rating = vendor_helper::get_rating_of_vendor($vendor->id);
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
                                        {!! str_repeat('<span><i class="fa fa-star"></i></span>', round($rating['avg']) ) !!}
                                        {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - round($rating['avg']) ) !!}                                    
                                    </span>
                                    ({{ $rating['count'] }} review)
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                @else
            
                <div class="col-md-12">
                    <div class="text-center">
                        <h3>Vendors Not Available in {{ ucwords ($search_city) }} City.</h3>
                    </div>
                </div>
                
                @endif
            </div>
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
