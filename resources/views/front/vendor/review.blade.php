@extends('front.layouts.user_layout')

@section('title', 'Review')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Reviews</h2>
        </div>
        <!-- Page Heading -->

        <!-- Reviews Section -->
        <div class="card-shadow">
            <div class="card-shadow-body">
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
        </div>

        <div class="card-shadow">
            <div class="card-shadow-body p-0">
                <div class="d-flex justify-content-between row border-bottom p-4">
                    <div class="col-md-4">
                        <div class="search-review-list">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control form-dark form-control-sm" placeholder="Search list">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3 mt-md-0">
                        <select class="theme-combo" name="state" style="width: 100%;">
                            <option>Select Your Listing</option>
                            <option>Listing Photography</option>
                            <option>Listing Cake</option>
                            <option>Listing Music</option>
                            <option>Listing Florist</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-shadow-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="reviews-tabbing-wrap">
                            <div class="nav flex-column nav-pills theme-tabbing-vertical reviews-tabbing" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-general" role="tab"
                                    aria-controls="v-pills-general" aria-selected="true">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_1.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab"
                                    aria-controls="v-pills-vendor" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_5.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-groom-tab" data-toggle="pill" href="#v-pills-groom" role="tab"
                                    aria-controls="v-pills-groom" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_3.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab"
                                    aria-controls="v-pills-pricing" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_4.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-general-1" data-toggle="pill" href="#v-pills-general-1" role="tab"
                                    aria-controls="v-pills-general-1" aria-selected="true">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_1.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-vendor-1-tab" data-toggle="pill" href="#v-pills-vendor-1" role="tab"
                                    aria-controls="v-pills-vendor-1" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_5.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-groom-1-tab" data-toggle="pill" href="#v-pills-groom-1" role="tab"
                                    aria-controls="v-pills-groom-1-tab" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_3.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="nav-link" id="v-pills-pricing-1-tab" data-toggle="pill" href="#v-pills-pricing-1" role="tab"
                                    aria-controls="v-pills-pricing-1" aria-selected="false">
                                    <div class="reviews-media">
                                        <div class="media">
                                            <img class="thumb" src="assets/images/thumb_img_4.jpg" alt="">
                                            <div class="media-body">
                                                <div class="heading-wrap no-gutters">
                                                    <div class="heading">
                                                        <h4 class="mb-0">Karon Balina</h4>
                                                        <div class="review-option-btn">
                                                            
                                                                <span class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <i class="fa fa-star-o"></i>                                    
                                                                </span>
                                                                <span>4.2</span>
                                                        </div>
                                                        <small>Married on 17, Sep, 2020</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">Love The Response</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-groom" role="tabpanel" aria-labelledby="v-pills-groom-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">Excellent Customer Support</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">100% Recommendation</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-general-1" role="tabpanel"
                                aria-labelledby="v-pills-general-1">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-vendor-1" role="tabpanel" aria-labelledby="v-pills-vendor-1-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">Love The Response</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-groom-tab-1" role="tabpanel" aria-labelledby="v-pills-groom-tab-1">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">Excellent Customer Support</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                            <div class="tab-pane fade" id="v-pills-pricing-1" role="tabpanel" aria-labelledby="v-pills-pricing-1-tab">
                                <!-- Review Media -->
                                <div class="reviews-media">
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h3 class="fw-7">100% Recommendation</h3>
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
                                    <div class="summernote"></div>
                                    <a href="javascript:" class="btn btn-default btn-sm mt-3">Add Your Reply</a>
                                </div>
                                <!-- Review Media -->
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Reviews Section -->  
    </div>
</div>

@endsection