<header class="fixed-top header-anim">
    <div class="top-bar-stripe">
        <div class="container px-md-0">
            <div class="row align-items-center">
                <div class="col-lg-auto col-sm-12">
                    <div class="top-icons">
                        <span>The Right Way of Wedding Planning</span>
                    </div>
                </div>
                <div class="col-sm-12 col-lg">
                    <div class="social-icons">
                        <ul class="list-unstyled">
                            <li><a href="javascript:"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:"><i class="fa fa-instagram"></i></a>
                            <li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Main Navigation Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container text-nowrap bdr-nav px-0">
            <div class="d-flex mr-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('public/front/images/logo.png')}}" alt="" >
                </a>
            </div>
            <!-- Topbar Request Quote Start -->
            <span class="order-lg-last d-inline-flex ml-3">
                <a class="btn btn-primary btn-rounded" href="{{url('/login')}}"> Login</a>
            </span>
            <!-- Toggle Button Start -->
            <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Toggle Button End -->

            <!-- Topbar Request Quote End -->

            <div class="collapse navbar-collapse" id="navbarCollapse" data-hover="dropdown"
                data-animations="slideInUp slideInUp slideInUp slideInUp">
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item dropdown megamenu-li">
                        <a class="nav-link dropdown-toggle-mob" href="" id="megamenu-list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendors<i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list">
                            <div class="row">
                            <div class="col-sm-6 col-lg-4 col-md-4">
                            <h5>Image Slider</h5>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-md-4">
                            <h5>Links</h5>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-md-4">
                            <h5>Paragraph</h5>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/about')}}" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{url('/blog')}}">Blogs</a>    
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle-mob" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Policy <i class="fa fa-chevron-down"></i></a>    
                        <ul class="dropdown-menu dropdownhover-bottom">
                            <li><a class="dropdown-item" href="{{url('/')}}">Cancellation Policy</a></li>
                            <li><a class="dropdown-item" href="{{url('/')}}">Refund Policy</a></li>
                            <li><a class="dropdown-item" href="{{url('/')}}">Terms & Conditions</a></li>
                            <li><a class="dropdown-item" href="{{url('/')}}">Privacy Policy</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{url('/real-wedding')}}">Real Wedding </a>    
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Panel <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle-mob dropdown-item dropdown-toggle-click" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Couple Dashboard <i class="fa fa-chevron-right"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a href="couple-dashboard.html">Dashboard</a></li>
                                    <li><a href="couple-dashboard-todo-list.html">Checklist</a></li>
                                    <li><a href="couple-dashboard-vendor-manager.html">Vendor Manager</a></li>
                                    <li><a href="couple-dashboard-guest-manager.html">Guest List</a></li>
                                    <li><a href="couple-dashboard-budget.html">Budget</a></li>
                                    <li><a href="couple-dashboard-realwedding.html">RealWedding</a></li>
                                    <li><a href="javascript:">Seating Chart</a></li>
                                    <li><a href="javascript:">Registry</a></li>
                                    <li><a href="javascript:">Chat</a></li>
                                    <li><a href="couple-dashboard-profile.html">My Profile</a></li>
                                    <li><a href="javascript:">Wedding Website</a></li>            
                                    <li><a href="javascript:">Logout</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle-mob dropdown-item dropdown-toggle-click" href="#" id="navbarDropdown_vendor" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendor Dashboard <i class="fa fa-chevron-right"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown_vendor">
                                    <li><a href="vendor-dashboard.html">Dashboard</a></li>
                                    <li><a href="vendor-dashboard-listing.html">My Listing</a></li>
                                    <li><a href="vendor-dashboard-pricing.html">Pricing Table</a></li>
                                    <li><a href="vendor-dashboard-quote.html">Request Quote</a></li>
                                    <li><a href="vendor-dashboard-reviews.html">Reviews</a></li>
                                    <li><a href="vendor-dashboard-invoice.html">Invoice</a></li>
                                    <li><a href="javascript:">Chat</a></li>
                                    <li><a href="vendor-dashboard-profile.html">My Profile</a></li>
                                    <li><a href="javascript:">Logout</a></li>
                                </ul>
                            </li>                                
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
                    </li>
                </ul>
                <!-- Main Navigation End -->
            </div>


        </div>
    </nav>
    <!-- Main Navigation End -->


</header>
