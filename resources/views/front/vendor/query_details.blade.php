@extends('front.layouts.user_layout')

@section('title', 'Lead Details')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <div class="section-title">
            <h2>Query Details</h2>
        </div>
        <div class="card-shadow mt-dashboard">
            <div class="card-shadow-header">
                <div class="dashboard-head">
                    <h3>
                        Query Details
                    </h3>
                    <div class="links">
                        <a href="{{ url('vendor/query') }}">View All <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-shadow-body p-0">
                <ul class="list-unstyled my-listing">
                    <li>
                        <div class="row align-items-center">
                            
                            <div class="col-md-2">
                                <div class="title-listing">
                                    <div>Name</div>
                                    <a href="javascript:0">
                                        <div class="text-success">{{ ucwords($query->name) }}</div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="title-listing">
                                    <div>Mobile</div>
                                    <div class="text-success">
                                        <a href="tel:{{ $query->mobile }}">{{ $query->mobile }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="title-listing">
                                    <div>Budget</div>
                                    <div class="text-success">
                                        @if(!empty($query->budget))
                                            {{ $query->budget }}
                                        @else
                                            NA
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="title-listing">
                                    <div>User Type</div>
                                    <div class="text-success">{{ ucwords($query->user_type) }}</div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="title-listing">
                                    <div>Query Type</div>
                                    <div class="text-success">{{ $query->query_type }}</div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="title-listing">
                                    <div>Details</div>
                                    <div>
                                        @if(!empty($query->details))
                                            {{$query->details}}
                                        @else
                                            NA
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="title-listing">
                                    <div>Event Date</div>
                                    <div>
                                        @if(!empty($query->event_date))
                                            {{ date('M d, Y', strtotime($query->event_date) ) }}
                                        @else
                                            NA
                                        @endif
                                    </div>
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