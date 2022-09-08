@extends('front.layouts.user_layout')

@section('title', 'Unlock Leads')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Unlock Leads</h2>
            </div>
        </div>
        <div class=" mt-3">
            @if(Session::has('message'))
                <div class="alert {{session('class')}}">
                    <span>{{session('message')}}</sapn>
                </div>
            @endif
        </div>
        <!-- Page Heading -->

        <!-- My Pricing Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Event Date</th>
                                <th scope="col">City</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Details</th>
                                <th scope="col">Status</th>
                                <th scope="col">Open Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <th>{{ ucwords($lead->name) }}</th>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($lead->event_date) ) }}</span></td>
                                <td>{{ ucwords($lead->city) }}</td>
                                <td><span class="btn-link-primary">{{ $lead->budget }}</span></td>
                                <td>{{ $lead->details }}</td>
                                <td><span class="{{ ($lead->status == '1') ? 'text-success' : 'text-danger' }}">{{ ($lead->status == '1') ? 'Active' : 'Deactive' }}</span></td>
                                <td><span>{{ date('M d, Y', strtotime($lead->created_at) ) }}</span></td>
                                <td>
                                    <a class="btn btn-default btn-rounded btn-sm view-lead-button" href="{{ url('vendor/leads/view/details/'.$lead->id) }}" >View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- My Pricing Section -->  
    </div>
</div>
@endsection