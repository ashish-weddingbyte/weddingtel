@extends('front.layouts.user_layout')

@section('title', 'Wishlist')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Wishlist</h2>
        </div>
        <!-- Page Heading -->

        <!-- My wishlist Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Date</th>
                                <th scope="col">Contact Number</th>
                                <!-- <th scope="col">View More Details</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_vendors as $vendor)
                            <tr>
                                <td>{{ ucwords($vendor->name) }}</td>
                                <td>{{ $vendor->city_name }}</td>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($vendor->created_at) ) }}</span></td>
                                <!--<td><a class="action-links" href="tel:{{ $vendor->mobile }}">{{ $vendor->mobile }}</a></td>-->
                                <td>**********</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- My wishlist Section -->  
    </div>
</div>
@endsection