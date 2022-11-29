@extends('front.layouts.user_layout')

@section('title', 'Website')


@section('main-container')


<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-start">
                <h2>Wedding Websites</h2>
            </div>
            <div class="mt-3">
                @if(Session::has('message'))
                    <div class="alert {{session('class')}}">
                        <span>{{session('message')}}</sapn>
                    </div>
                @endif
            </div> 
        </div>
        <!-- Page Heading -->


        <div class="card-shadow">
            <div class="card-shadow-body">
                @if($active)
                <div class="row align-items-center">
                    <div class="mb-0 col-xl-3 col-lg-4 col-md-4 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Website Name</span>
                            <h3>{{ $active->name }}</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="pricing-plan">
                            <span class="sub-head">Activate Time</span>
                            <h3>{{ date('M d, Y', strtotime($active->created_at) ) }}</h3>
                        </div>
                    </div>

                    <div class="mb-0 col-xl-1 col-lg-4 col-sm-6 col-md-4  mx-auto">
                        <div class="pricing-plan p-0 text-xl-right text-md-left pl-md-3 text-center">
                            <div class="badge {{ ($active->status == '1')? 'badge-success': 'badge-danger' }}">&nbsp;</div> 
                            @if($active->status == '1')
                                <small>Active</small>
                            @else
                                <small>Deactive</small>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="row my-5">
                    <div class="col-md-12 text-center">
                        <h3>Websites Not Activated.</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(!empty($templates) )
        <div class="row">
            @foreach($templates as $tmp)
                <!-- Pricing Plan Wrap -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-13 py-3">
                    <div class="pricing-table-wrap premium">
                        <h3>{{ ucwords($tmp->name) }}</h3>
                        <div class="vendor-img-gallery">
                            <a href="{{asset('storage/upload/website/'.$tmp->image)}}" ><img src="{{asset('storage/upload/website/'.$tmp->image)}}" class="rounded" alt="{{ $tmp->name }}"></a>               
                        </div>
                        
                        <a href="{{ url('tools/wedding-website/'.$tmp->id) }}" class="btn btn-primary btn-rounded" target="_blank">Preview</a> 
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <h3>Websites Not Available!</h3>
            </div>
        </div>
        @endif

    </div>
</div>




@endsection