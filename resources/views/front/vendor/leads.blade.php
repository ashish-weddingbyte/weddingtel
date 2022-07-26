@extends('front.layouts.user_layout')

@section('title', 'Leads')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Leads</h2>
                <a href="{{ url('/vendor/leads/unlock-leads') }}" class="btn btn-default"><i class="fa fa-money" aria-hidden="true"></i> Unlock Leads</a>
            </div>
        </div>
        <div class=" mt-3">
            @if(Session::has('message'))
                <div class="alert {{session('class')}}">
                    <span>{{session('message')}}</sapn>
                </div>
            @endif
        </div>
        <div class="my-3">
            <div class="print-error-msg">
                
            </div>
        </div>
        <!-- Page Heading -->

        <!-- My Pricing Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Event Date</th>
                                <th scope="col">City</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Details</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <th>{{ ucwords($lead->name) }}</th>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($lead->created_at) ) }}</span></td>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($lead->event_date) ) }}</span></td>
                                <td>{{ ucwords($lead->city) }}</td>
                                <td><span class="btn-link-primary">{{ $lead->budget }}</span></td>
                                <td>{{ $lead->details }}</td>
                                <td><span class="{{ ($lead->status == '1') ? 'text-success' : 'text-danger' }}">{{ ($lead->status == '1') ? 'Active' : 'Deactive' }}</span></td>
                                <td>
                                    @if($lead->status == '0')
                                        <button disabled class="btn btn-default btn-rounded btn-sm">View</button>
                                    @else
                                        <?php
                                            $user_id = Session::get('user_id');
                                            $view_status = vendor_helper::view_lead_status($lead->id);
                                        ?>

                                        @if($view_status == true)
                                            <a class="btn btn-default btn-rounded btn-sm " href="{{ url('vendor/leads/view/details/'.$lead->id) }}" >Opened</a>
                                        @else
                                            <button class="btn btn-default btn-rounded btn-sm view-button" id="id_{{$lead->id}}" data-id="{{ $lead->id }}" data-action="{{ url('/vendor/leads/view/'.$lead->id) }}">View</button>
                                        @endif

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-4 text-center">
                    <div class="theme-pagination">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- My Pricing Section -->  
    </div>
</div>
@endsection