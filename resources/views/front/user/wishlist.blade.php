@extends('front.layouts.user_layout')

@section('title', 'Wishlist')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Wishlist Vendors</h2>
            <div class="mt-3">
                @if(Session::has('message'))
                    <div class="alert {{session('class')}}">
                        <span>{{session('message')}}</sapn>
                    </div>
                @endif
            </div>
        </div>
        <!-- Page Heading -->

        <!-- My Wishlist Section -->
        
        @if($all_vendors->count() >0)
            <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2">
                
                @foreach($all_vendors as $vendor)
                <?php
                    $image_path = vendor_helper::vendor_image_path($vendor->id);
                    $url = vendor_helper::vendor_profile_url($vendor->id);
                ?>
                
                <div class="col mb-2">
                    <div class="wedding-listing">
                        <div class="img">
                            <a href="listing-singular.html">
                                <img src="{{ $image_path }}" alt="">
                            </a>
                            <div class="img-content">
                                <div class="top text-right">
                                    <a class="favorite" href="javascript:void(0)" role="button" data-toggle="modal" data-target="#delete_modal-{{ $vendor->id }}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                                <div class="bottom">
                                    <a class="tags" href="javascript:void(0)">
                                        {{ $vendor->category_name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gap">
                                <h4><a href="{{ $url }}" target="_blank">{{$vendor->brandname }}</a></h4>
                                <p><i class="fa fa-map-marker"></i> {{ $vendor->city_name }}</p>
                            </div>
                            
                        </div>                                                
                    </div>
                    
                    <!-- Modal for Delete wishlist -->
                    <div class="modal fade" id="delete_modal-{{ $vendor->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered register-tab">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                        <h2 class="m-0" >Confirmation</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    

                                    <div class="card-shadow-body">
                                        <form  data-action="{{ url('tools/wishlist/remove/') }}" class="submit">
                                            <div class="row">
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <P class="text-danger">Are you sure, You want to Remove this Vendor from Wishlist!</P>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                                        <button type="submit" class="btn btn-default">Remove Vendor</button>

                                                        <button type="close" data-dismiss="modal" class="btn btn-secondary ">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        @else
            <div class="col-md-12 my-5">
                <div class="text-center mb-3">
                    <div class="custom-file button-style">
                        <h3>No Vendor Found!</h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="mt-4">
                <div class="theme-pagination">
                    {!! $all_vendors->links() !!}
                </div>
            </div>
        </div>

        <!-- My Wislist Section -->  
    </div>
</div>


@endsection