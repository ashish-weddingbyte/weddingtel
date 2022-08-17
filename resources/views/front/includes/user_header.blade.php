<header class="fixed-top header-anim">
<!-- <div class="top-bar-stripe">
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
                        <li><a href="javascript:"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Main Navigation Start -->
<nav class="navbar navbar-expand-lg">
    <div class="container text-nowrap bdr-nav px-0">
        <div class="d-flex mr-auto">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('front/images/logo.png')}}" alt="" >
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown megamenu-li">
                    <a class="nav-link dropdown-toggle-mob" href="" id="megamenu-list-vendors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendors<i class="fa fa-chevron-down"></i></a>
                    <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list-vendors">
                        <?php
                            $category = App\Models\Category::where('status','1')->limit(12)->get()->toArray();
                            $category = array_chunk($category,3);
                        ?>
                        <div class="row">
                            @foreach($category as $cat)
                            <div class="col-sm-6 col-lg-4 col-md-4">
                                @foreach($cat as $c)
                                    <a class="dropdown-item" href="{{ url('/vendors/all/'.$c['category_url']) }}">{{ $c['category_name'] }}</a>
                                @endforeach
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown megamenu-li">
                    <a class="nav-link dropdown-toggle-mob" href="" id="megamenu-list-city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Venues<i class="fa fa-chevron-down"></i></a>
                    <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list-city">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3 col-md-4">
                                <a class="dropdown-item" href="{{ url('vendors/mumbai') }}">Mumbai</a>
                                <a class="dropdown-item" href="{{ url('vendors/pune') }}">Pune</a>
                                <a class="dropdown-item" href="{{ url('vendors/hyderabad') }}">Hyderabad</a>
                                <a class="dropdown-item" href="{{ url('vendors/panchkula') }}">Panchkula</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 col-md-4">
                                <a class="dropdown-item" href="{{ url('vendors/amritsar') }}">Amritsar</a>
                                <a class="dropdown-item" href="{{ url('vendors/noida') }}">Noida</a>
                                <a class="dropdown-item" href="{{ url('vendors/delhi') }}">Delhi</a>
                                <a class="dropdown-item" href="{{ url('vendors/chandigarh') }}">Chandigarh</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 col-md-4">
                                <a class="dropdown-item" href="{{ url('vendors/jaipur') }}">Jaipur</a>
                                <a class="dropdown-item" href="{{ url('vendors/lucknow') }}">Lucknow</a>
                                <a class="dropdown-item" href="{{ url('vendors/kanpur') }}">Kanpur</a>
                                <a class="dropdown-item" href="{{ url('vendors/bhopal') }}">Bhopal</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 col-md-4">
                                <a class="dropdown-item" href="{{ url('vendors/meerut') }}">Meerut</a>
                                <a class="dropdown-item" href="{{ url('vendors/bareilly') }}">Bareilly</a>
                                <a class="dropdown-item" href="{{ url('vendors/surat') }}">Surat</a>
                                <a class="dropdown-item" href="{{ url('vendors/ghaziabad') }}">Ghaziabad</a>
                            </div>
                        </div>
                    </div>
                </li>
                
                <li class="nav-item ">
                    <a href="{{ url('/') }}" class="nav-link">Blogs</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Real-Wedding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                </li>
            </ul>
            <!-- Main Navigation End -->
        </div>


    </div>
</nav>
<!-- Main Navigation End -->
</header>



<header class="fixed-top header-anim">    
    <!-- Main Navigation Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid text-nowrap bdr-nav px-0">
            <a href="javascript:" class="sidebar-toggle mobile" data-toggle="offcanvas">
                <i class="fa fa-bars"></i>
            </a>
            <div class="d-flex mx-auto align-items-center">                    
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('front/images/logo.png') }}" alt="">
                </a> 
                <a href="javascript:" class="sidebar-toggle desktop" data-toggle="offcanvas">
                    <i class="fa fa-bars"></i>
                </a>                   
            </div>
            <!-- Toggle Button Start -->
            <button class="navbar-toggler x collapsed" type="button" data-toggle="offcanvas-mobile"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <!-- Toggle Button End -->

            <!-- Topbar Request Quote End -->

            <div class="collapse navbar-collapse offcanvas-collapse-mobile" id="navbarCollapse" data-hover="dropdown"
                data-animations="slideInUp slideInUp slideInUp slideInUp">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown megamenu-li">
                        <a class="nav-link dropdown-toggle-mob" href="" id="megamenu-list-vendors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendors<i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list-vendors">
                            <?php
                                $category = App\Models\Category::where('status','1')->limit(12)->get()->toArray();
                                $category = array_chunk($category,3);
                            ?>
                            <div class="row">
                                @foreach($category as $cat)
                                <div class="col-sm-6 col-lg-4 col-md-4">
                                    @foreach($cat as $c)
                                        <a class="dropdown-item" href="{{ url('/vendors/all/'.$c['category_url']) }}">{{ $c['category_name'] }}</a>
                                    @endforeach
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </li>


                    <li class="nav-item dropdown megamenu-li">
                        <a class="nav-link dropdown-toggle-mob" href="" id="megamenu-list-city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Venues<i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list-city">
                            <div class="row">
                                <div class="col-sm-6 col-lg-3 col-md-4">
                                    <a class="dropdown-item" href="{{ url('vendors/mumbai') }}">Mumbai</a>
                                    <a class="dropdown-item" href="{{ url('vendors/pune') }}">Pune</a>
                                    <a class="dropdown-item" href="{{ url('vendors/hyderabad') }}">Hyderabad</a>
                                    <a class="dropdown-item" href="{{ url('vendors/panchkula') }}">Panchkula</a>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-md-4">
                                    <a class="dropdown-item" href="{{ url('vendors/amritsar') }}">Amritsar</a>
                                    <a class="dropdown-item" href="{{ url('vendors/noida') }}">Noida</a>
                                    <a class="dropdown-item" href="{{ url('vendors/delhi') }}">Delhi</a>
                                    <a class="dropdown-item" href="{{ url('vendors/chandigarh') }}">Chandigarh</a>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-md-4">
                                    <a class="dropdown-item" href="{{ url('vendors/jaipur') }}">Jaipur</a>
                                    <a class="dropdown-item" href="{{ url('vendors/lucknow') }}">Lucknow</a>
                                    <a class="dropdown-item" href="{{ url('vendors/kanpur') }}">Kanpur</a>
                                    <a class="dropdown-item" href="{{ url('vendors/bhopal') }}">Bhopal</a>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-md-4">
                                    <a class="dropdown-item" href="{{ url('vendors/meerut') }}">Meerut</a>
                                    <a class="dropdown-item" href="{{ url('vendors/bareilly') }}">Bareilly</a>
                                    <a class="dropdown-item" href="{{ url('vendors/surat') }}">Surat</a>
                                    <a class="dropdown-item" href="{{ url('vendors/ghaziabad') }}">Ghaziabad</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item ">
                        <a href="{{ url('/') }}" class="nav-link">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Real-Wedding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                    </li>

                    @if( Session::has('user_type') )
                    <li class="nav-item dropdown user-profile">
                        <a class="nav-link" href="{{ url('/') }}" id="user-menu" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> {{  Session::get('name'); }} &nbsp;<i class="fa fa-angle-down"></i>
                        </a>
                        @if(Session::get('user_type') == 'user')
                        <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" aria-labelledby="user-menu">
                            <li><a class="dropdown-item" href="{{ url('tools/dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ url('tools/profile') }}">My Profile</a></li> 
                            <li><a class="dropdown-item" href="{{ url('tools/checklist') }}">Checklist</a></li>
                            <li><a class="dropdown-item" href="{{ url('tools/vendors') }}">Vendor Manager</a></li>
                            <li><a class="dropdown-item" href="{{ url('tools/guestlist') }}">Guest List</a></li>
                            <li><a class="dropdown-item" href="{{ url('tools/budget') }}">Budget</a></li>
                            <li><a class="dropdown-item" href="{{ url('tools/real-wedding') }}">RealWedding</a></li>          
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                        
                        @elseif(Session::get('user_type') == 'vendor')
                        
                        <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" aria-labelledby="user-menu">
                            <li><a href="{{ url('tools/dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">My Listing</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">Pricing Table</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">Request Quote</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">Reviews</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">Invoice</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">Chat</a></li>
                            <li><a href="{{ url('tools/dashboard') }}">My Profile</a></li>
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                        @else
                        
                        @endif
                    </li>
                    @endif
                </ul>
                <!-- Main Navigation End -->
            </div>
        </div>
    </nav>
    <!-- Main Navigation End -->
</header>