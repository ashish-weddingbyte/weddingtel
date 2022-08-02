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

                            <!-- <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="v-pills-{{$category->id}}" role="tabpanel" aria-labelledby="v-pills-{{$category->id}}-tab">                                    
                                <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                    <div class="col">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="listing-singular.html">
                                                    <img src="{{ asset('front/images/vendors/vendor_img_1.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top text-right">                                                           
                                                        <a class="favorite" href="javascript:">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                    <div class="bottom">
                                                        <div class="reviews">
                                                            <span class="stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>                                    
                                                            </span>
                                                            2662
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h4><a href="listing-singular.html">Happy Wedding Fashions</a></h4>
                                                    <p><i class="fa fa-map-marker"></i> Surat, Gujrat, India</p>

                                                    <div class="form-group">
                                                        <select class="theme-combo" name="state" style="width: 100%;">
                                                            <option>Unavailable</option>
                                                            <option>Not a Good Fit</option>
                                                            <option>Evaluating</option>
                                                            <option>Hired</option>
                                                        </select>
                                                    </div>

                                                    <div class="d-flex align-items-center row no-gutters">
                                                        <div class="col-9">
                                                            <label>Overall fit</label>
                                                            <div class="rating-stars">
                                                                <a href="#5" title="Give 5 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#4" title="Give 4 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#3" title="Give 3 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#2" title="Give 2 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#1" title="Give 1 star"><i class="fa fa-heart-o"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <div><label>Price</label></div>
                                                            <div class="d-flex align-items-center">
                                                                <span class="mr-2">$</span>
                                                                <input type="text" class="form-control price-wedding" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <label>Notes</label>
                                                        <textarea class="form-control" placeholder="Text here" rows="3">Text here</textarea>
                                                    </div>
                                                    
                                                </div>
                                                <div class="bottom-footer">
                                                    <span><a href="javascript:"><i class="fa fa-phone"></i> Phone number</a></span>
                                                    <span><a href="javascript:" data-toggle="modal" data-target="#request_quote"><i class="fa fa-envelope-o"></i> Contact</a></span>
                                                </div>    
                                            </div>                                                
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="listing-singular.html">
                                                    <img src="{{ asset('front/images/vendors/vendor_img_3.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top text-right">                                                           
                                                        <a class="favorite" href="javascript:">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                    <div class="bottom">
                                                        <div class="reviews">
                                                            <span class="stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                                <i class="fa fa-star-o"></i>                                    
                                                            </span>
                                                            2662
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h4><a href="listing-singular.html">Happy Wedding Fashions</a></h4>
                                                    <p><i class="fa fa-map-marker"></i> Surat, Gujrat, India</p>

                                                    <div class="form-group">
                                                        <select class="theme-combo" name="state" style="width: 100%;">
                                                            <option>Unavailable</option>
                                                            <option>Not a Good Fit</option>
                                                            <option>Evaluating</option>
                                                            <option>Hired</option>
                                                        </select>
                                                    </div>

                                                    <div class="d-flex align-items-center row no-gutters">
                                                        <div class="col-9">
                                                            <label>Overall fit</label>
                                                            <div class="rating-stars">
                                                                <a href="#5" title="Give 5 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#4" title="Give 4 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#3" title="Give 3 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#2" title="Give 2 stars"><i class="fa fa-heart-o"></i></a>
                                                                <a href="#1" title="Give 1 star"><i class="fa fa-heart-o"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <div><label>Price</label></div>
                                                            <div class="d-flex align-items-center">
                                                                <span class="mr-2">$</span>
                                                                <input type="text" class="form-control price-wedding" placeholder="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <label>Notes</label>
                                                        <textarea class="form-control" placeholder="Text here" rows="3">Text here</textarea>
                                                    </div>
                                                    
                                                </div>
                                                <div class="bottom-footer">
                                                    <span><a href="javascript:"><i class="fa fa-phone"></i> Phone number</a></span>
                                                    <span><a href="javascript:" data-toggle="modal" data-target="#request_quote"><i class="fa fa-envelope-o"></i> Contact</a></span>
                                                </div>    
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            
                        @endforeach
                    
                    @endif

                    </div>
                </div>
                <!-- Budget End -->
            </div>

            
        </div>
    </div>

@endsection

