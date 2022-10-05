@extends('front.layouts.user_layout')

@section('title', 'Vendors')

@section('main-container')

<div class="main-contaner">
        <div class="container">
            <!-- Page Heading -->
            <div class="section-title">
                <h2>Vendor Manager</h2>
            </div>
            <!-- Page Heading -->

            <div class="row">
                <!-- Budget Start -->
                <div class="col-12 col-xl-3">
                    <div class="d-flex flex-column flex-xl-column-reverse">
                        
                        <div class="nav flex-column nav-pills theme-tabbing-vertical budget-tab mb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">


                            @if($categories)
                                @foreach($categories as $key => $category)
                                    <a class="nav-link {{ $key == 0 ? 'show active' : '' }}" id="v-pills-{{ $category->id }}-tab" data-toggle="pill" href="#v-pills-{{ $category->id }}" role="tab" aria-controls="v-pills-{{ $category->id }}" aria-selected="true">
                                        @if($category->icon)
                                            {!! $category->icon !!} 
                                        @else
                                            <i class="fa fa-life-ring"></i>
                                        @endif
                                        {{ $category->category_name }}
                                    </a>
                                @endforeach
                            
                            @endif
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 col-xl-9">
                    <div class="tab-content budget-tab-content" id="v-pills-tabContent">

                        @if($categories)
                            @foreach($categories as $key => $category)
                            
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="v-pills-{{$category->id}}" role="tabpanel" aria-labelledby="v-pills-{{$category->id}}-tab">
                                <?php
                                    $data = str_replace('-','_',$category->category_url);
                                    $vendors = $$data;
                                ?>
                                @if($vendors->count() >0)

                                    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                        
                                        @foreach($vendors as $vendor)
                                        <?php
                                            $image_path = vendor_helper::vendor_image_path($vendor->id);
                                            $url = vendor_helper::vendor_profile_url($vendor->id);
                                        ?>
                                        
                                        <div class="col">
                                            <div class="wedding-listing">
                                                <div class="img">
                                                    <a href="">
                                                        <img src="{{ $image_path }}" alt="">
                                                    </a>
                                                    <div class="img-content">
                                                        <!-- <div class="top text-right">                                                           
                                                            <a class="favorite" href="javascript:">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div> -->
                                                        <div class="bottom">
                                                            <div class="reviews">
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="gap">
                                                        <h4><a href="{{ $url }}" target="_blank">{{$vendor->brandname }}</a></h4>
                                                        <p><i class="fa fa-map-marker"></i> {{ $vendor->city_name }}</p>

                                                    </div>
                                                    
                                                </div>                                                
                                            </div>
                                        </div>
                                        
                                        @endforeach
                                        
                                    </div>
                                @else
                                    <div class="col-md-12 my-5">
                                        <div class="text-center mb-3">
                                            <div class="custom-file button-style">
                                                <h3>No Vendor Found!</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>

                            
                        @endforeach
                    
                    @endif

                    </div>
                </div>
                <!-- Budget End -->
            </div>

            
        </div>
    </div>

@endsection

