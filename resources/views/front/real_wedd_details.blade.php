@extends('front.layouts.main_layout')

@section('title', 'Real Weddings Details')


@section('main-container')

<main id="body-content">

    <!-- Real Wedding Single Start -->
    <section class="real-wedding-single-wrap">
        <div class="real-wedding-single-img">
            <img src="{{ asset('storage/upload/realwedding/profile/'.$real_wedding->featured_image)}}" alt="">
        </div>
        <div class="real-wedding-single">
            <div class="container h-80">
                <div class="row align-items-lg-end d-flex h-100 align-items-center">
                    <div class="col-lg-5">
                        <div class="name">
                            <div class="ring">
                                <i class="weddingdir_heart_ring"></i>
                            </div>
                            <?php
                                // $user = user_helper::user_real_wedding_data($real_wedding->user_id);
                            ?>
                            <div>
                                <h2>{{ ucwords($real_wedding->name) }} Weds {{ ucwords($real_wedding->partner_name) }}</h2>
                                <span><i class="fa fa-map-marker"></i> {{ $real_wedding->city_name }}</span>
                                <span><i class="fa fa-calendar"></i> {{ date('M d, Y ', strtotime($real_wedding->date) ) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Real Wedding Single End -->

    <section class="wide-tb-90">
        <div class="container">
            <!-- Our Story -->
            <div class="card-shadow pos-rel">
                <div class="card-shadow-header">
                    <h3><i class="fa fa-file-text"></i> Our Story</h3>
                </div>
                <div class="card-shadow-body">
                    {!! $real_wedding->description !!}
                </div>
            </div>
            <!-- Our Story -->

            <!-- Photo Gallery -->
            <div class="card-shadow pos-rel">
                <div class="card-shadow-header d-lg-flex align-items-center justify-content-between">
                    <h3><i class="fa fa-image"></i> Photo Gallery</h3>
                </div>
                <div class="card-shadow-body">
                    @if($gallery)
                    <div class="isotope-gallery vendor-img-gallery row">
                        @foreach($gallery as $image)
                        <div class="gallery-item col-lg-4 col-md-6 col-12">
                            <div class="vendor-gallery">
                                <a href="{{ asset('storage/upload/realwedding/gallery/'.$image->name)}}" title="Title Come here">
                                    <img src="{{ asset('storage/upload/realwedding/gallery/'.$image->name)}}" class="rounded" alt="">
                                </a>                                            
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <!-- Photo Gallery -->

            
            
            <!-- Similar RealWedding     -->
            <div class="card-shadow pos-rel">
                <div class="card-shadow-header">
                    <h3><i class="weddingdir_birde"></i> Similar RealWedding</h3>
                </div>
                <div class="card-shadow-body">
                    @if($similar_real_wedd)
                    <div class="row">
                        @foreach($similar_real_wedd as $real)
                        <?php
                            $media = user_helper::real_wedding_media($real->id);
                        ?>
                        <!-- Real Wedding Stories -->
                        <div class="col-lg-4 col-md-6">
                            <div class="real-wedding-wrap top-heading">
                                
                                <div class="real-wedding">
                                    <div class="text-center">
                                        <h3><a href="{{ url('real-wedds/'.$real->id) }}">{{ ucwords($real->name) }} Weds {{ ucwords($real->partner_name) }}</a></h3>
                                        <p><i class="fa fa-map-marker"></i> {{ $real->city }}</p>
                                    </div>
                                    <div class="img real-wedd-long-img">
                                        <div class="overlay">
                                            <i class="weddingdir_heart_double_alt"></i>
                                            Our Story
                                        </div>
                                        <a href="{{ url('real-wedds/'.$real->id) }}">
                                            <img src="{{ asset('storage/upload/realwedding/profile/'.$real->featured_image)}}" alt="">
                                        </a>
                                        <div class="date">
                                            {{ date('M d, Y ', strtotime($real->date) ) }}
                                        </div>
                                    </div>
                                    <ul class="list-unstyled gallery">
                                        @foreach($media as $key => $value)
                                        <li>
                                            <a href="{{ url('real-wedds/'.$real->id) }}">
                                                @if($key == 2)
                                                    <div class="load-more">
                                                        Load <br>More
                                                    </div>
                                                @endif
                                                <div class="real-wedd-short-img">
                                                    <img src="{{ asset('storage/upload/realwedding/gallery/'.$value->name)}}" alt="">
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    
                                    </ul>
                                </div>                            
                            </div>
                        </div>
                        <!-- Real Wedding Stories -->                    
                        @endforeach
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ url('/real-wedds') }}" class="btn btn-default btn-rounded btn-lg">More Real Weddings</a>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Similar RealWedding -->
        </div>
    </section>

</main>


@endsection
