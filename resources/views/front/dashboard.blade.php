@extends('front.layouts.user_layout')

@section('title', 'Dashborad')


@section('main-container')

<div class="main-contaner">
    <div class="container">

        <!-- Couple Info Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-0">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="d-flex align-items-center h-100">
                            <div class="couple-img">
                                <img src="{{ asset('front/images/dashboard/couple_img.jpg') }}" class="hidden-desktop" alt="">
                                <div class="couple-btn">
                                    <a href="javascript:" class="btn btn-outline-white"><i class="fa fa-camera"></i> Photo</a>
                                    <span class="dropdown hover_out">
                                        <a class="btn btn-outline-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-share-alt"></i> Share
                                        </a>
                                    
                                        <span class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:"><i class="fa fa-facebook-f"></i> Facebook</a>
                                            <a class="dropdown-item" href="javascript:"><i class="fa fa-twitter"></i> Twitter</a>
                                            <a class="dropdown-item" href="javascript:"><i class="fa fa-instagram"></i> Instagram</a>
                                            <a class="dropdown-item" href="javascript:"><i class="fa fa-envelope-o"></i> Email</a>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="couple-counter">
                                <ul id="wedding-countdown" class="list-unstyled list-inline">
                                    <li class="list-inline-item"><span class="days">00</span><div class="days_text">Days</div></li>
                                    <li class="list-inline-item"><span class="hours">00</span><div class="hours_text">Hours</div></li>
                                    <li class="list-inline-item"><span class="minutes">00</span><div class="minutes_text">Minutes</div></li>
                                    <li class="list-inline-item"><span class="seconds">00</span><div class="seconds_text">Seconds</div></li>
                                </ul>
                            </div>
                        </div>                                    
                    </div>

                    <div class="col-lg-6 col-xl-7">
                        <div class="couple-info">
                            <div class="edit-btn">
                                <a href="couple-dashboard-profile.html" class="btn btn-outline-white btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                            <div class="text-center">
                                <div class="couple-avatar">
                                    <img src="{{ asset('front/images/dashboard/avatar_img.jpg') }}" alt="">
                                    <img src="{{ asset('front/images/dashboard/avatar_2_img.jpg') }}" alt="">

                                </div>
                                <h2>Hitesh & Priyanka</h2>
                                <span class="save-date"><i class="fa fa-calendar"></i> 11/12/2020</span>
                            </div>

                            <div class="couple-status">
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%"></div>
                                </div>
                                <div class="small-text">
                                    <span>Status</span>
                                    <span>Just said yes? Let's get started!</span>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                <div class="col">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            0
                                        </div>
                                        <div class="text">
                                            <strong>Out of 21</strong>
                                            <small>services hired</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            0
                                        </div>
                                        <div class="text">
                                            <strong>Out of 81</strong>
                                            <small>Tasks completed</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            2
                                        </div>
                                        <div class="text">
                                            <strong>Out of 02</strong>
                                            <small>Guests attending</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            2
                                        </div>
                                        <div class="text">
                                            <strong>Out of 02</strong>
                                            <small>Guests Seated</small>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Couple Info Section -->

        <div class="row">
            <div class="col-xl-8">
                <!-- Vendor Team -->
                <div class="card-shadow">
                    <div class="card-shadow-header">
                        <div class="dashboard-head">
                            <h3>
                                <span>of 21 categories hired</span>
                                Your vendor team
                            </h3>
                            <div class="links">
                                <a href="couple-dashboard-vendor-manager.html">View all my vendors <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light">
                        <div class="card-shadow-body">
                            <div class="row align-items-center">
                                <div class="col-md mb-3 mb-md-0">
                                    <input type="text" class="form-control form-light" placeholder="Start your search">
                                </div>
                                <div class="col-md mb-3 mb-md-0">
                                    <input type="text" class="form-control form-light" placeholder="Where">
                                </div>
                                <div class="col-md-auto">
                                    <a href="right-side-map-listing.html" class="btn btn-default">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow-body pb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dash-categories selected" style="background: url({{ asset('front/images/dashboard/dash_category.jpg') }}) no-repeat; background-size: cover;">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-pencil"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_location_heart"></i>
                                        Venue
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_pheras"></i>
                                        Wedding Pheras
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_location_heart"></i>
                                        Videographer
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_heart_envelope"></i>
                                        Invitations
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_love_gift"></i>
                                        Favors & Gifts
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="weddingdir_cake"></i>
                                        Wedding Cake
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Vendor Team -->

                <!-- Wedding details -->
                <div class="card-shadow">
                    <div class="card-shadow-header">
                        <div class="dashboard-head">
                            <h3>Wedding details</h3>
                        </div>
                    </div>

                    <div class="card-shadow-body">
                        <div class="wedding-detail-wrap row">
                            <div class="wedding-details-popups col">
                                <div class="wedding-details-items">
                                    <div class="wedding-color-theme purple">
                                        &nbsp;
                                    </div>                                    
                                    <div>
                                        <small>Color</small>
                                        <div class="head">Purple</div>
                                        <span class="count">9,489 couples</span>
                                    </div>

                                    
                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-pencil"></i></button>
                                    <div class="dropdown-menu">
                                        <div class="droplayer">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme black">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Black</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme blue">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Blue</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme blush">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Blush</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme brown">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Brown</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme burgundy">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Burgundy</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme champagne">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Champagne</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme glod">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Gold</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme gray">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Gray</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme green">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Green</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme ivory">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Ivory</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme orange">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Orange</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme pink">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Pink</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div class="wedding-color-theme red">
                                                            &nbsp;
                                                        </div>  
                                                        <span>Red</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>                                            
                            </div>

                            <div class="wedding-details-popups col">
                                <div class="wedding-details-items">
                                    <div class="question">
                                        <i class="fa fa-question"></i>
                                    </div>                                
                                    <div>
                                        <small>Season</small>
                                        <div class="head">...</div>
                                        <span class="count">&nbsp;</span>
                                    </div>

                                    
                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-pencil"></i></button>
                                    <div class="dropdown-menu season-icons">
                                        <div class="p-3">
                                            <ul class="list-unstyled ">
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/winter_icon.svg') }}" alt=""></div>
                                                        <span>Winter</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/spring_icon.svg') }}" alt=""></div>
                                                        <span>Spring</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/summer_icon.svg') }}" alt=""></div>
                                                        <span>Summer</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/fall_icon.svg') }}" alt=""></div>
                                                        <span>Fall</span>
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>                                            
                            </div>

                            <div class="wedding-details-popups col">
                                <div class="wedding-details-items">
                                    <div class="question">
                                        <i class="fa fa-question"></i>
                                    </div>                                
                                    <div>
                                        <small>Style</small>
                                        <div class="head">...</div>
                                        <span class="count">&nbsp;</span>
                                    </div>

                                    
                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-pencil"></i></button>
                                    <div class="dropdown-menu style-icons">
                                        <div class="p-3">
                                            <ul class="list-unstyled ">
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/beach_icon.svg') }}" alt=""></div>
                                                        <span>Beach</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/bohemian_icon.svg') }}" alt=""></div>
                                                        <span>Bohemian</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/casual_icon.svg') }}" alt=""></div>
                                                        <span>Casual</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/classic_icon.svg') }}" alt=""></div>
                                                        <span>Classic</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/elegant_icon.svg') }}" alt=""></div>
                                                        <span>Elegant</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/formal_icon.svg') }}" alt=""></div>
                                                        <span>Formal</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/glam_icon.svg') }}" alt=""></div>
                                                        <span>Glam</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/industrial_icon.svg') }}" alt=""></div>
                                                        <span>Industrial</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/modern_icon.svg') }}" alt=""></div>
                                                        <span>Modern</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/romantic_icon.svg') }}" alt=""></div>
                                                        <span>Romantic</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/rustic_icon.svg') }}" alt=""></div>
                                                        <span>Rustic</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:">
                                                        <div><img src="{{ asset('front/images/dashboard/vintage_icon.svg') }}" alt=""></div>
                                                        <span>Vintage</span>
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>                                            
                            </div>

                            <div class="wedding-details-popups col">
                                <div class="wedding-details-items">
                                    <div class="question">
                                        <i class="fa fa-question"></i>
                                    </div>                                
                                    <div>
                                        <small>Dress</small>
                                        <div class="head">...</div>
                                        <span class="count">&nbsp;</span>
                                    </div>

                                    
                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-pencil"></i></button>
                                    <div class="dropdown-menu season-icons dropdown-menu-right">
                                        <div class="p-3">
                                            <p><strong>Designer's Name</strong></p>
                                            <input type="text" class="form-control" placeholder="Find your designer">
                                        </div>
                                    </div>
                                </div>                                            
                            </div>

                            <div class="wedding-details-popups col">
                                <div class="wedding-details-items">
                                    <div class="question">
                                        <i class="fa fa-question"></i>
                                    </div>                                
                                    <div>
                                        <small>Honeymoon</small>
                                        <div class="head">...</div>
                                        <span class="count">&nbsp;</span>
                                    </div>

                                    
                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fa fa-pencil"></i></button>
                                    <div class="dropdown-menu season-icons dropdown-menu-right">
                                        <div class="p-3">
                                            <p><strong>Honeymoon Destination</strong></p>
                                            <input type="text" class="form-control" placeholder="Enter a Honeymoon destination">
                                        </div>
                                    </div>
                                </div>                                            
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <!-- Wedding details -->

                <div class="card-shadow"></div>
            </div>

            <div class="col-xl-4">
                <!-- Upcoming tasks -->
                <div class="card-shadow">
                    <div class="card-shadow-header">
                        <div class="dashboard-head">
                            <h3>
                                <span>0 of 80 completed</span>
                                Upcoming tasks
                            </h3>
                            <div class="links">
                                <a href="couple-dashboard-todo-list.html">View all tasks <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow-body p-0">
                        <div class="upcoming-task">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="custom-control custom-checkbox form-dark">
                                            <input type="checkbox" class="custom-control-input option-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">
                                                <span class="label-text"> Plan your engagement party</span>
                                                <small>Engagement</small>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="custom-control custom-checkbox form-dark">
                                            <input type="checkbox" class="custom-control-input option-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">
                                                <span class="label-text"> Plan your engagement party</span>
                                                <small>Engagement</small>
                                            </label>
                                        </div>
                                    </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!-- Upcoming tasks -->

                <!-- Guest List -->
                <div class="card-shadow">
                    <div class="card-shadow-header">
                        <div class="dashboard-head">
                            <h3>
                                Guest List
                            </h3>
                            <div class="links">
                                <a href="couple-dashboard-guest-manager.html">See Guest List <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow-body">
                        <div class="empty-guest-list">
                            <i class="weddingdir_guest_member"></i>
                            <p>You haven't added any guests yet</p>
                            <a class="btn btn-outline-default btn-rounded" href="couple-dashboard-guest-manager.html">Add guest</a>
                        </div>
                    </div>
                    
                </div>
                <!-- Guest List -->

                <!-- Budget -->
                <div class="card-shadow">
                    <div class="card-shadow-header">
                        <div class="dashboard-head">
                            <h3>
                                Budget
                            </h3>
                            <div class="links">
                                <a href="couple-dashboard-budget.html">View Budget <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow-body">
                        <div class="budget-estimation">
                            <div class="d-flex w-100">
                                <div class="etimated-cost">
                                    <div class="icon"><i class="weddingdir_saving_money"></i></div> 
                                    <p class="cost-price">$18000</p>
                                    <div>Estimated cost</div>
                                </div>
                                <div class="etimated-cost">
                                    <div class="icon"><i class="weddingdir_money_stack"></i></div>
                                    <p class="cost-price final">$0</p>
                                    <div>Final cost</div>
                                </div>
                            </div>
                            
                            <a class="btn btn-outline-default btn-rounded" href="couple-dashboard-budget.html">Manage expenses</a>
                        </div>
                    </div>
                    
                </div>
                <!-- Budget -->
            </div>
        </div>
        


        
    </div>
</div>

@endsection