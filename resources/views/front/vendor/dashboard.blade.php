@extends('front.layouts.user_layout')

@section('title', 'Vendor Dashborad')


@section('main-container')

<div class="main-contaner">
    <div class="container">

        <!-- Vendor Cover Images Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-0">
                <div class="vendor-banner-cover">
                    <i class="fa fa-picture-o"></i>
                    Upload Banner Cover Images
                    <span>Best Size 1980 x 400</span>
                </div>
                <div class="vendor-profile-img">
                    <div class="text">
                        <div class="img-holder">
                            <i class="fa fa-picture-o"></i>
                        </div>
                        <strong>Upload Brand Image</strong>
                        <span>Best image size 250 x 250</span>
                    </div>
                    <div class="vendor-btn">
                        <a href="vendor-dashboard-profile.html" class="btn btn-outline-white btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Vendor Cover Images Section -->

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                <div class="card-shadow">
                    <div class="card-shadow-body">
                        <div class="couple-info vendor-stats">
                            <div class="couple-status-item">
                                <div class="counter">
                                    750
                                </div>
                                <div class="text">
                                    <div class="div"><strong>Total Credit</strong></div>
                                    <a href="javascript:" class="btn-veiw-all">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                <div class="card-shadow">
                    <div class="card-shadow-body">
                        <div class="couple-info vendor-stats">
                            <div class="couple-status-item">
                                <div class="counter">
                                    12
                                </div>
                                <div class="text">
                                    <div class="div"><strong>Listed Item</strong></div>
                                    <a href="vendor-dashboard-listing.html" class="btn-veiw-all">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                <div class="card-shadow">
                    <div class="card-shadow-body">
                        <div class="couple-info vendor-stats">
                            <div class="couple-status-item">
                                <div class="counter">
                                    29
                                </div>
                                <div class="text">
                                    <div class="div"><strong>Chat conversation</strong></div>
                                    <a href="javascript:" class="btn-veiw-all">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-dashboard mb-3 mb-lg-0">
                <div class="card-shadow">
                    <div class="card-shadow-body">
                        <div class="couple-info vendor-stats">
                            <div class="couple-status-item">
                                <div class="counter">
                                    89
                                </div>
                                <div class="text">
                                    <div class="div"><strong>Your Review</strong></div>
                                    <a href="vendor-dashboard-reviews.html" class="btn-veiw-all">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-dashboard">
                <div class="card-shadow">
                    <div class="card-shadow-body">
                        <div class="couple-info vendor-stats">
                            <div class="couple-status-item">
                                <div class="counter">
                                    75
                                </div>
                                <div class="text">
                                    <div class="div"><strong>Request quote</strong></div>
                                    <a href="vendor-dashboard-quote.html" class="btn-veiw-all">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-shadow mt-dashboard mt-5">
            <div class="card-shadow-header">
                <div class="dashboard-head">
                    <h3>
                        Your Listing
                    </h3>
                    <div class="links">
                        <a href="vendor-dashboard-listing.html">View All <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-shadow-body p-0">
                <ul class="list-unstyled my-listing">
                    <li>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <a href="javascript:">
                                    <img src="assets/images/vendors/vendor_img_1.jpg" class="rounded" alt="">
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="title-listing">
                                    <a href="listing-singular.html">
                                        <div>Fiona</div>
                                        <span>Paris</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-listing">
                                    <div class="badge-wrap">
                                        <div>Task Date</div>
                                        <span class="badge badge-primary">                                                        
                                            September 18, 2020
                                        </span>
                                    </div>
                                    <div class="badge-wrap">
                                        <div>Status</div>
                                        <span class="badge badge-pending">                                                        
                                            Pending
                                        </span>
                                    </div>
                                    <div class="badge-wrap text-center">
                                        <div>Action</div>
                                        <div class="dropdown hover_out listing-action">
                                            <button class="btn listing-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <a href="javascript:">
                                    <img src="assets/images/vendors/vendor_img_2.jpg" class="rounded" alt="">
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="title-listing">
                                    <a href="listing-singular.html">
                                        <div>Fiona</div>
                                        <span>Paris</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-listing">
                                    <div class="badge-wrap">
                                        <div>Task Date</div>
                                        <span class="badge badge-primary">                                                        
                                            September 18, 2020
                                        </span>
                                    </div>
                                    <div class="badge-wrap">
                                        <div>Status</div>
                                        <span class="badge badge-danger">                                                        
                                            Awaiting for Approval
                                        </span>
                                    </div>
                                    <div class="badge-wrap text-center">
                                        <div>Action</div>
                                        <div class="dropdown hover_out listing-action">
                                            <button class="btn listing-action-link" type="button" id="dropdownMenuButton1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <a href="javascript:">
                                    <img src="assets/images/vendors/vendor_img_3.jpg" class="rounded" alt="">
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="title-listing">
                                    <a href="listing-singular.html">
                                        <div>Fiona</div>
                                        <span>Paris</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-listing">
                                    <div class="badge-wrap">
                                        <div>Task Date</div>
                                        <span class="badge badge-primary">                                                        
                                            September 18, 2020
                                        </span>
                                    </div>
                                    <div class="badge-wrap">
                                        <div>Status</div>
                                        <span class="badge badge-success">                                                        
                                            Publish
                                        </span>
                                    </div>
                                    <div class="badge-wrap text-center">
                                        <div>Action</div>
                                        <div class="dropdown hover_out listing-action">
                                            <button class="btn listing-action-link" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>

    </div>
</div>

@endsection