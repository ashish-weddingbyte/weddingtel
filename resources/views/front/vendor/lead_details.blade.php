@extends('front.layouts.user_layout')

@section('title', 'Lead Details')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <div class="section-title">
            <h2>Leads Details</h2>
        </div>

        <div class="card-shadow mt-dashboard">
            <div class="card-shadow-header">
                <div class="dashboard-head">
                    <h3>
                        Lead Details
                    </h3>
                    <div class="links">
                        <a href="{{ url('vendor/leads') }}">View All <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-shadow-body p-0">
                <ul class="list-unstyled my-listing">
                    <li>
                        <div class="row align-items-center">
                            
                            <div class="col-md-3">
                                <div class="title-listing">
                                    <div>Name</div>
                                    <a href="javascript:0">
                                        <div class="text-success">{{ $leads->name }}</div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="title-listing">
                                    <div>Mobile</div>
                                    <a href="tel:{{ $leads->mobile }}">
                                        <div class="text-success">{{ $leads->mobile }}</div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="title-listing">
                                    <div>Budget</div>
                                    <div class="text-success">{{ $leads->budget }}</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="info-listing">
                                    <div class="badge-wrap">
                                        <div>Event Date</div>
                                        <span class="badge badge-primary">       
                                            {{ date('M d, Y', strtotime($leads->event_date) ) }}
                                        </span>
                                    </div>
                                    <div class="badge-wrap">
                                        <div>Status</div>
                                        <span class="badge {{ ($leads->status == '1')? 'badge-success': 'badge-pending' }}">      
                                            @if($leads->status == 1)
                                                <span>Active</span>
                                            @else
                                                <span>Deactive</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                    <div class="title-listing">
                                        <div>Details</div>
                                        <div>{{ $leads->details }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title-listing">
                                        <div>City</div>
                                        <div class="text-info">{{ $leads->city }}</div>
                                    </div>
                                </div>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>


        
    </div>
</div>
@endsection