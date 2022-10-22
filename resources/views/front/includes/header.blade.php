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
                            <li><a href="https://www.facebook.com/Weddingbyte/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/weddingbyte/" target="_blank"><i class="fa fa-instagram"></i></a></li>
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
                    <img src="{{ asset('front/images/logo.png')}}" alt="" >
                </a>
            </div>
            <!-- Topbar Request Quote Start -->
            <span class="order-lg-last d-inline-flex">
            @if( Session::has('user_id') )
                @if(Session::get('user_type') == 'user')
                    <a class="btn btn-primary btn-rounded" href="{{ url('tools/dashboard') }}"> {{ Session::get('name') }}</a>
                @endif

                @if(Session::get('user_type') == 'vendor')
                    <a class="btn btn-primary btn-rounded" href="{{ url('vendor/dashboard') }}"> {{ Session::get('name') }}</a>
                @endif

            @else
                <a class="btn btn-primary btn-rounded" href="{{url('/login')}}">Bride Login</a>
                &nbsp;
                <a class="btn btn-success btn-rounded" href="{{url('/vendor-login')}}">Vendor Login</a>
            @endif
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
                        <a class="nav-link dropdown-toggle-mob" href="javascript:void(0)" id="megamenu-list-vendors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendors<i class="fa fa-chevron-down"></i></a>
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
                        <a class="nav-link dropdown-toggle-mob" href="javascript:void(0)" id="megamenu-list-city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Venues<i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu dropdownhover-bottom"  aria-labelledby="megamenu-list-city">
                            <?php
                                $city = App\Models\City::where('status','1')->where('is_top','1')->limit(16)->get()->toArray();
                                $cities = array_chunk($city,4);
                            ?>
                            <div class="row">

                                @foreach($cities as $city)
                                <div class="col-sm-6 col-lg-3 col-md-4">
                                    @foreach($city as $c)
                                        <a class="dropdown-item" href="{{ url('/vendors/all/'.$c['name']) }}">{{ $c['name'] }}</a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item ">
                        <a href="{{ url('/blogs') }}" class="nav-link">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/real-wedds') }}" class="nav-link">Real-Wedding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                    </li>
                    @if( Session::has('user_id') )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                    </li>
                    @endif
                </ul>
                <!-- Main Navigation End -->
            </div>

        </div>
    </nav>
    <!-- Main Navigation End -->
</header>