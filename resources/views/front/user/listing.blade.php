@extends('front.layouts.main_layout')

@section('title', 'Listing')


@section('main-container')
    <main id="body-content">

        <div class="map-listing-wrap wide-tb-40">
            <!-- <div class="map-container">
                <div id="map-holder">
                    <div id="map_extended" class="vendor-single-popup-wrap">
                        <p>This will be replaced with the Google Map.</p>
                    </div>
                </div>
            </div> -->
            <div class="listing-content">
                
                <div class="listing-post-wrap">
                    
                    <div class="listing-single-post">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-listing-grid" role="tabpanel" aria-labelledby="pills-listing-grid-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_1.jpg') }}" alt="">                                                    
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Fashion
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Happy Wedding Fashions <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                
                                    <div class="col-lg-4 col-md-6">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_2.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">                                                           
                                                        <span class="featured">
                                                            <i class="fa fa-star"></i>
                                                            <span>Featured</span>
                                                        </span>
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Photography
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Cool Wed Photography <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                
                                    <div class="col-lg-4 col-md-6 mx-auto">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_3.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Flora
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Lotus Wedding Florist <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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

                                    <div class="col-lg-4 col-md-6">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_1.jpg') }}" alt="">                                                    
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Fashion
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Happy Wedding Fashions <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                
                                    <div class="col-lg-4 col-md-6">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_2.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">                                                           
                                                        <span class="featured">
                                                            <i class="fa fa-star"></i>
                                                            <span>Featured</span>
                                                        </span>
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Photography
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Cool Wed Photography <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                
                                    <div class="col-lg-4 col-md-6 mx-auto">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:">
                                                    <img src="{{ asset('front/images/weddings/wedding_listing_3.jpg') }}" alt="">
                                                </a>
                                                <div class="img-content">
                                                    <div class="top">
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript.html">
                                                            Flora
                                                        </a>
                                                        <a class="favorite" href="javascript.html">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Lotus Wedding Florist <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
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
                
                                </div>
                            </div>
                            
                            <div class="tab-pane fade " id="pills-listing-list" role="tabpanel" aria-labelledby="pills-listing-list-tab">
                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <span class="featured">
                                                    <i class="fa fa-star"></i>
                                                    <span>Featured</span>
                                                </span>
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_1.jpg')}}" alt="" class="rounded"></a>
                                            </div>                                    
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite active"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <span class="featured">
                                                    <i class="fa fa-star"></i>
                                                    <span>Featured</span>
                                                </span>
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_2.jpg')}}" alt="" class="rounded"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_3.jpg')}}" alt="" class="rounded"></a>
                                            </div>                                    
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_4.jpg')}}" alt="" class="rounded"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_5.jpg')}}" alt="" class="rounded"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_6.jpg')}}" alt="" class="rounded"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->

                                <!-- Search Result List -->
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <a href="javascript:"><img src="{{ asset('front/images/search/search_img_7.jpg')}}" alt="" class="rounded"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite"><i class="fa fa-heart"></i></a>
                                                    <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p>Nullam facilisis massa id elit ornare lobortised convallis purus ac tincidunt efficiturstibulum et rutrum onec vitae finibus quaenean dignissim nibh vel ante accumsan sagittis. Integer gravida aliquet auctor.</p>
                                                <div class="bottom">
                                                    <span class="price-map">
                                                        <i class="fa fa-tag"></i>
                                                        <span>$500-$800</span>
                                                    </span>
                                                    <button type="button" class="btn btn-outline-primary btn-rounded">Request pricing</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search Result List -->
                            </div>
                        </div>
                        
                    </div>
                    <div class="theme-pagination">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>            
        </div>
    
    </main>
    
@endsection
