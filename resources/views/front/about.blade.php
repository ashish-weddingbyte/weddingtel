@extends('front.layouts.main_layout')

@section('title', 'About')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>About</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

    <main id="body-content">

        <section class="wide-tb-30">
            <div class="container">
                <div class="row">
                   <div class="col-md-6 col-sm-12 col-lg-6">
                        
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        
                        <div class="entry-content">
                            <h2>Hi! Welcome to Wedding Byte</h2>
                            <h3><i>Find Best Wedding Destination</i></h3>
                            <p>WeddingByte Your destination for perfect wedding Marriage is one event in your life which should stand out in truly glorious way in your life events. We at weddingbyte assist you in planning for this special day , with you without getting the stress for searching for the services in marriage . Wedding byte is a place where you can find the best vendors , along with prices at the click of one button. Irrespective of it that you are looking for makeup artist , photographers , Wedding planners , wedding byte can help you in finding the right vendor for your perfect wedding.</p>
                        </div>
                        <a href="{{ url('/contact') }}" class="btn btn-default btn-rounded btn-lg">Contact Us</a>
                        
                    </div>
                    <div class="col-lg-6" style="background: url({{ asset('front/images/callout_img.jpg') }}) center center no-repeat; background-size: cover;">
                        <img src="{{ asset('front/images/callout_img.jpg') }}" class="d-lg-none invisible" alt="">                    
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Details End -->
    </main>
    
@endsection


