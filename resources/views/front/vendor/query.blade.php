@extends('front.layouts.user_layout')

@section('title', 'Request Quote')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Request List</h2>
        </div>
        <!-- Page Heading -->

        <!-- My Pricing Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Enquiry By</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Is Verified</th>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($query as $qry)
                            <tr>
                                <td>{{ ucwords($qry->name) }}</td>
                                @if($qry->query_type == 'send_message')
                                    <th>Enquiry</th>
                                @endif

                                @if($qry->query_type == 'view_contact')
                                    <th>View Contact</th>
                                @endif
                                <td><span class="text-success">{{ date('M d, Y', strtotime($qry->created_at) ) }}</span></td>
                                <td>{{ ucwords($qry->user_type) }}</td>
                                <td><span class="{{ ($qry->is_mobile_verified == '1') ? 'text-success' : 'text-danger' }}">{{ ($qry->is_mobile_verified == '1') ? 'Verified' : 'Not Verified' }}</span></td>
                                
                                <td><button class="btn btn-default btn-rounded btn-sm view-button" data-id="{{ $qry->id }}" data-action="{{ url('/vendor/query/view/'.$qry->id) }}">View</button></td>
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