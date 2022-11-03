@extends('front.layouts.user_layout')

@section('title', 'Vendor Dashborad')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <div class="section-title wide-tb-30">
            <h2>Dashborad</h2>
            <div class="mt-1">
                @if(empty($details->brandname))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span>Please Add Brandname to Your Profile to visible in the Vendor listing</span>
                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                    </div>
                @endif
                @if(empty($details->featured_image))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span>Please Add Featured Image to Your Profile to visible in the Vendor listing</span>
                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                    </div>
                @endif
                @if(empty($details->description))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span>Please Add Description to Your Profile to visible in the Vendor listing</span>
                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                    </div>
                @endif
            </div> 
        </div>

        <!-- Vendor Cover Images Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-0">
                <div class="vendor-profile-img mt-5">
                    <div class="text">
                    @if($details->profile_image)
                    
                        <div class="img-holder avatar-wrap">
                            <img src="{{ asset('storage/upload/vendor/profile/'.$details->profile_image) }}" alt="">
                        </div>
                    @else
                        <div class="img-holder">
                            <i class="fa fa-picture-o"></i>
                        </div>
                    @endif
                       
                        <strong>Profile Image</strong>
                        <span>Best image size 250 x 250</span>
                    </div>
                    <div class="vendor-btn">
                        <a href="{{ url('/vendor/profile') }}" class="btn btn-outline-white btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Vendor Cover Images Section -->

        <div class="card-shadow mt-5">
            <div class="card-shadow-header">
                <div class="dashboard-head">
                    <h3>
                        Lead Plan
                    </h3>
                    <div class="links">
                        <a href="{{ url('vendor/plans') }}">View All <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-shadow-body">
                @if($leads)
                <div class="row my-2">
                    <div class="col-lg-4 col-md-4 mb-lg-0">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ $leads->plan_name }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Paln Details</strong></div>
                                            <a href="{{ url('vendor/plans') }}" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 mb-lg-0">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ $leads->total_lead }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Total Leads</strong></div>
                                            <a href="{{ url('vendor/leads') }}" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 mb-lg-0 ">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ ucwords($leads->is_addon) }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>All Addons</strong></div>
                                            <a href="{{ url('vendor/dashboard/addons') }}" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-4  mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ $leads->available_leads }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Available Leads</strong></div>
                                            <a href="{{ url('vendor/leads') }}" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ ($leads->total_lead - $leads->available_leads) }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Used Leads</strong></div>
                                            <a href="{{ url('vendor/leads') }}" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                              {{ $plan_expire_days }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Expire Days</strong></div>
                                            <a href="javascript:void(0)" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row my-5">
                    <div class="col-md-12 text-center">
                        <h3>You have not purchased Lead Plan!</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>
        

        

        <div class="card-shadow mt-dashboard mt-5">
            <div class="card-shadow-header">
                <div class="dashboard-head">
                    <h3>
                        Position Plans
                    </h3>
                    <div class="links">
                        <a href="{{ url('vendor/plans') }}">View All <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-shadow-body">
                @if($position)
                <div class="row my-2">
                    <div class="col-md-4 col-md-4 mb-lg-0">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ $position->plan_name }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Plan Details</strong></div>
                                            <a href="javascript:void(0)" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ date('M d, Y', strtotime($position->start_at) ) }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Plan Start Date</strong></div>
                                            <a href="javascript:void(0)" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{ date('M d, Y', strtotime($position->end_at) ) }}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Plan End Date</strong></div>
                                            <a href="javascript:void(0)" class="btn-veiw-all">View All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                    <div class="col-md-4 col-md-4 mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{$new_query_count}}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>New Query</strong></div>
                                            <a href="{{ url('vendor/query') }}" class="btn-veiw-all">View All (Plan Complimentary un-verified)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{$all_query_count}}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Total Queries</strong></div>
                                            <a href="{{ url('vendor/query') }}" class="btn-veiw-all">View All (Plan Complimentary un-verified)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mb-lg-0 mt-dashboard">
                        <div class="card-shadow">
                            <div class="card-shadow-body">
                                <div class="couple-info vendor-stats">
                                    <div class="couple-status-item">
                                        <div class="counter">
                                            {{$viewed_query_count}}
                                        </div>
                                        <div class="text">
                                            <div class="div"><strong>Viewed Queries</strong></div>
                                            <a href="{{ url('vendor/query') }}" class="btn-veiw-all">View All (Plan Complimentary un-verified)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                @else
                <div class="row my-5">
                    <div class="col-md-12 text-center">
                        <h3>You have not purchased Position Plan!</h3>
                    </div>
                </div>
                @endif
            </div>
            
        </div>

    </div>
</div>

@endsection