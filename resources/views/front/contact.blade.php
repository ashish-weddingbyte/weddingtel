@extends('front.layouts.main_layout')

@section('title', 'Contact Us')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Contact US</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact US</li>
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

    <main id="body-content">

        <section class="wide-tb-60">
            <div class="container">
                <div class="row login-section">
                    <div class="col-lg-5  p-0" id="login-image">
                        <div class="wizard_image">
                            <img src="{{ asset('front/images/bg_contact.jpg') }}" class="" alt="">
                        </div>                 
                    </div>
                    <div class="col-md-12 col-lg-7">
                        <div class="wizard_form">
                            <div class="p-4">
                                
                                <div class="section-title my-4 ">
                                    @if(Session::has('message'))
                                        <div class="alert {{session('class')}}">
                                            <span>{{session('message')}}</sapn>
                                        </div>
                                    @endif
                                    <h3>WeddingByte</h3>
                                    <p><a href="javascript:void(0)">The right way of wedding planning.</a></p> 
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-contact progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>                      
                                </div> 
                                
                                <div class="login-form mb-4">
                                    <form action="{{ url('/contact/update') }}" data-action="{{ url('/contact/save') }}" method="post" id="contact-form" >
                                        @csrf
                                        <fieldset>
                                            <h2>Step 1</h2>
                                            <div class="form-group mt-3">
                                                <input type="number" class="form-control" id="contact_mobile" name="mobile" placeholder="Mobile">
                                            </div>
                                        
                                            <div class="contact_id"></div>
                                            <input type="button" name="next" class="next btn btn-primary btn-rounded" value="Next" />
                                        </fieldset>
                                        <fieldset style="display:none">
                                            <h2> Step 2</h2>
                                            <div class="form-group mt-3">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                    $categories = App\Models\Category::all();
                                                ?>

                                                <select  name="service" id="service" class="form-control form-light-select theme-combo">
                                                    <option value="0">Select Service</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->category_name}}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <input type="button" name="previous" class="previous btn btn-primary btn-rounded" value="Previous" />
                                            <input type="submit" name="submit" class="submit btn btn-success btn-rounded" value="Skip & Submit"  />
                                            <input type="button" name="next" class="next btn btn-primary btn-rounded" value="Next" />
                                        </fieldset>
                                        <fieldset style="display:none">
                                            <h2>Step 3</h2>
                                            <div class="form-group mt-3">
                                                <input type="date" class="form-control" id="date" name="date" placeholder="Event Date">
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                    $cities = App\Models\City::orderBy('name','asc')->get();
                                                ?>
                                                <select class="form-light-select theme-combo" name="city">
                                                    <option value='NULL'>Choose Location</option>
                                                    @if($cities)   
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->name }}">{{ $city->name }} ( {{ $city->state }} )</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <input type="button" name="previous" class="previous btn btn-primary btn-rounded" value="Previous" />
                                            <input type="submit" name="submit" class="submit btn btn-success btn-rounded" value="Submit" id="submit_data" />
                                        </fieldset>
                                    </form>
                                    
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Details End -->

        <!-- Contact Details Start -->
        <section class="wide-tb-50">
            <div class="container">
                <div class="row contact-broken">
                    <!-- Contact Details Wrap -->
                    <div class="col-md-6">
                        <div class="contact-details-wrap">
                            <i class="weddingdir_support"></i>
                            <h3 class="txt-primary">Customer Support</h3>
                            <p class="my-4">Call our helpline.</p>
                            <div>Phone number: <a href="tel:9888629762" class="btn-link btn-link-default">9888629762</a></div>
                            
                        </div>
                    </div>
                    <!-- Contact Details Wrap -->

                    <!-- Contact Details Wrap -->
                    <!-- <div class="col-md-4">
                        <div class="contact-details-wrap">
                            <i class="weddingdir_location"></i>
                            <h3 class="txt-primary">Our Address</h3>
                            <p class="my-4">Our offices are located in the Georgia.</p>
                            <div>Address: 4998 Elk Creek Road <br>Canton, GA 30114</div>
                        </div>
                    </div> -->
                    <!-- Contact Details Wrap -->

                    <!-- Contact Details Wrap -->
                    <div class="col-md-6">
                        <div class="contact-details-wrap">
                            <i class="weddingdir_mail"></i>
                            <h3 class="txt-primary">Other Enquiries</h3>
                            <p class="my-4">Please contact us at the email below for all other inquiries.</p>
                            <div>Email Us: <a href="mailto:customercare@weddingbyte.com" class="btn-link btn-link-primary">customercare@weddingbyte.com</a> </div>
                        </div>
                    </div>
                    <!-- Contact Details Wrap -->
                </div>
            </div>
        </section>
    </main>
    
@endsection


