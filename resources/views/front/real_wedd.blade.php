@extends('front.layouts.main_layout')

@section('title', 'Real Weddings')


@section('main-container')


<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Real Wedding</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Real Wedding</li>
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

<main id="body-content">
 
    <section class="wide-tb-50">
        <div class="container">
            @if($real_wedding)
                <div class="row">
                    @foreach($real_wedding as $real)
                        <?php
                            $media = user_helper::real_wedding_media($real->id);
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="real-wedding-wrap top-heading">
                                <div class="real-wedding">
                                    <div class="text-center">
                                        <h3><a href="real-wedding-details.html">{{ ucwords($real->name) }} Weds {{ ucwords($real->partner_name) }}</a></h3>
                                        <p><i class="fa fa-map-marker"></i> {{ $real->city }}</p>
                                    </div>
                                    <div class="img real-wedd-long-img">
                                        <div class="overlay">
                                            <i class="weddingdir_heart_double_alt"></i>
                                            Our Story
                                        </div>
                                        <a href="{{ url('real-wedds/'.$real->id) }}"><img src="{{ asset('storage/upload/realwedding/profile/'.$real->featured_image)}}" alt=""></a>
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

                    @endforeach
                </div>
            @endif
        </div>

        
        <div class="mt-4">
            <div class="theme-pagination">
                {!! $real_wedding->links() !!}
            </div>
        </div>
    </section>
    
</main>


@endsection
