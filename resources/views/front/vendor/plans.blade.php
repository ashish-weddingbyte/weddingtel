@extends('front.layouts.user_layout')

@section('title', 'Plans')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Plans</h2>
        </div>
        <!-- Page Heading -->

        <!-- My Pricing Section -->
        <div class="card-shadow">
            <div class="card-shadow-body">
                @if($vendor_plan)
                <div class="row align-items-center">
                    <div class="mb-0 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Name</span>
                            <h3>{{ $vendor_plan->plan_name }}</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Started</span>
                            <h3>{{ date('M d, Y', strtotime($vendor_plan->start_at) ) }}</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-4 col-lg-4 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Plan Expires</span>
                            <h3 class="txt-danger">{{ date('M d, Y', strtotime($vendor_plan->end_at) ) }}</h3>
                        </div>
                    </div>
                    
                    <div class="mb-0 col-xl-1 col-lg-4 col-sm-6 mx-auto">
                        <div class="pricing-plan p-0 text-xl-right text-md-left pl-md-3 text-center">
                            <div class="badge {{ ($vendor_plan->is_active == '1')? 'badge-success': 'badge-danger' }}">&nbsp;</div> 
                            @if($vendor_plan->is_active == '1')
                                <small>Active</small>
                            @else
                                <small>Deactive</small>
                            @endif
                        </div>
                    </div>
                </div>
                @else

                @endif
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <ul class="nav nav-pills theme-tabbing nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="lead-plans-tab" data-toggle="pill" href="#lead-plans" role="tab" aria-controls="lead-plans" aria-selected="false"><i class="fa fa-list"></i> Lead Plans</a>
                    </li>
                    
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="query-plans-tab" data-toggle="pill" href="#query-plans" role="tab" aria-controls="query-plans" aria-selected="true"><i class="weddingdir_request_quote"></i> Query Plans</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" id="location-plans-tab" data-toggle="pill" href="#location-plans" role="tab" aria-controls="location-plans" aria-selected="false"><i class="fa fa-map-marker" aria-hidden="true"></i> Location Plans</a>
                    </li>
                </ul>
                <div class="tab-content theme-tabbing" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="lead-plans" role="tabpanel" aria-labelledby="lead-plans-tab">
                        @if($plans->count() > 0 ) 
                        <div class="row">
                            @foreach($plans as $plan)
                            <!-- Pricing Plan Wrap -->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-13 py-3">
                                <div class="pricing-table-wrap premium">
                                    <h3>{{ ucwords($plan->name) }}</h3>
                                    <div class="vendor-img-gallery">
                                        <a href="{{asset('storage/upload/plans/'.$plan->image)}}" ><img src="{{asset('storage/upload/plans/'.$plan->image)}}" class="rounded" alt="{{ $plan->name }}"></a>               
                                    </div>
                                    
                                    <div class="plan-price">
                                        <sup>INR </sup>{{ $plan->price }}
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>Number of Leads : {{ $plan->leads }}</li>
                                        <li>Plan Type : {{ ucwords($plan->plan_type) }}</li>
                                        <li>Support : {{ $plan->support }}</li>
                                        <li>Validity : {{ $plan->days }} Days</li>
                                    </ul>
                                    <a href="javascript:" class="btn btn-primary btn-rounded">Buy</a>
                                </div>
                            </div>
                            <!-- Pricing Plan Wrap -->
                            @endforeach
                        </div>
                        @else
                            <div class="row my-5">
                                <div class="col-md-12 text-center">
                                    <h3>Plans Not Available!</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- <div class="tab-pane fade" id="query-plans" role="tabpanel" aria-labelledby="query-plans-tab">
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
                    </div> -->

                    <div class="tab-pane fade" id="location-plans" role="tabpanel" aria-labelledby="location-plans-tab">
                         @if($position_plans->count() > 0 ) 
                        <div class="row">
                            @foreach($position_plans as $plan)
                            <!-- Pricing Plan Wrap -->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-13 py-3">
                                <div class="pricing-table-wrap premium">
                                    <h3>{{ ucwords($plan->name) }}</h3>
                                    <div class="vendor-img-gallery">
                                        <a href="{{asset('storage/upload/plans/'.$plan->image)}}" ><img src="{{asset('storage/upload/plans/'.$plan->image)}}" class="rounded" alt="{{ $plan->name }}"></a>               
                                    </div>
                                    
                                    <div class="plan-price">
                                        <sup>INR </sup>{{ $plan->price }}
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>Position : {{ $plan->position }}</li>
                                        <li>Validity : {{ $plan->days }} Days</li>
                                        <li>Desc : {{ $plan->desc }}</li>
                                    </ul>
                                    <a href="javascript:" class="btn btn-primary btn-rounded">Buy</a>
                                </div>
                            </div>
                            <!-- Pricing Plan Wrap -->
                            @endforeach
                        </div>
                        @else
                            <div class="row my-5">
                                <div class="col-md-12 text-center">
                                    <h3>Plans Not Available!</h3>
                                </div>
                            </div>
                        @endif
                        <!-- <div class="card-shadow">
                            <div class="card-shadow-header">
                                <div class="head-simple">
                                    Location Plan
                                </div>                                            
                            </div>
                            <div class="card-shadow-body">
                                <form >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select class="form-light-select theme-combo" name="city" style="width:100%">
                                                    <option value='0'>Choose Location</option> 
                                                    @if($cities)   
                                                        @foreach($cities as $city)
                                                            
                                                            <option value="{{ $city->id }}">{{ $city->name }}</option>

                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <input type="submit" name="submit" class="btn btn-primary btn-rounded" value="Check City Positions">
                                        </div>
                                                
                                    </div>
                                </form>
                                                                            
                            </div> 
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        
        <!-- My Pricing Section -->  
    </div>
</div>

@endsection