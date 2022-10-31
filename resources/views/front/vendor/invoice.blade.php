@extends('front.layouts.user_layout')

@section('title', 'Invoice')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Payment History</h2>
        </div>
        <!-- Page Heading -->

        <!-- My Invoice Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Plan Type</th>
                                <th scope="col">Plan Name</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">View Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $pay)
                            <tr>
                                <td>{{ $pay->plan_type }}</td>
                                <td>PREMIUM</td>
                                <td>{{ $pay->payment_mode }}</td>
                                <td>{{ date('M d, Y', strtotime($pay->created_at) ) }}</td>
                                <td>INR {{ $pay->price }}</td>
                                <td><a href="#" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- My Invoice Section -->  
    </div>
</div>
@endsection