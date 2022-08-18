@extends('front.layouts.user_layout')

@section('title', 'Plans')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Pricing Plan</h2>
        </div>
        <!-- Page Heading -->

        <!-- My Pricing Section -->
        <div class="card-shadow">
            <div class="card-shadow-body">
                <div class="row align-items-center">
                    <div class="mb-0 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Type</span>
                            <h3>Silver</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Started</span>
                            <h3>July 30, 2020</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-4 col-lg-4 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Expires</span>
                            <h3 class="txt-danger">July 27, 2025</h3>
                        </div>
                    </div>
                    
                    <div class="mb-0 col-xl-1 col-lg-4 col-sm-6 mx-auto">
                        <div class="pricing-plan p-0 text-xl-right text-md-left pl-md-3 text-center">
                            <div class="badge badge-success">&nbsp;</div> 
                            <small>Active</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row my-5">

            <!-- Pricing Plan Wrap -->
            <div class="col-lg-6 col-md-6 col-xl-4 offset-xl-2">
                <div class="pricing-table-wrap premium">
                    <h3>Premium Plan</h3>
                    <div class="plan-price">
                        <sup>$</sup>1200
                    </div>
                    <ul class="list-unstyled">
                        <li>Number of Listings : 20</li>
                        <li>Featured Listing : 10</li>
                        <li>Support : 24/7</li>
                        <li>Validity : 18 month</li>
                    </ul>
                    <a href="javascript:" class="btn btn-primary btn-rounded">Buy Package</a>
                </div>
            </div>
            <!-- Pricing Plan Wrap -->

            <!-- Pricing Plan Wrap -->
            <div class="col-lg-6 col-md-6 col-xl-4 mt-5 mt-md-0">
                <div class="pricing-table-wrap">
                    <h3>Standerd Plan</h3>
                    <div class="plan-price">
                        <sup>$</sup>650
                    </div>
                    <ul class="list-unstyled">
                        <li>Number of Listings : 10</li>
                        <li>Featured Listing : 5</li>
                        <li>Support : 24/7</li>
                        <li>Validity : 10 month</li>
                    </ul>
                    <a href="javascript:" class="btn btn-default btn-rounded">Buy Package</a>
                </div>
            </div>
            <!-- Pricing Plan Wrap -->
        </div>
        <!-- My Pricing Section -->  
    </div>
</div>

@endsection