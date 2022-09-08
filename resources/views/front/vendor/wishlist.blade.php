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

        <!-- My Invoice Section -->
        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Plan Name</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">View Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PREMIUM</td>
                                <td>PayPal</td>
                                <td>August 14, 2020	</td>
                                <td>$30</td>
                                <td><a href="vendor-dashboard-invoice-details.html" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>
                            <tr>
                                <td>STANDARD</td>
                                <td>Payfast</td>
                                <td>November 11, 2020</td>
                                <td>$10</td>
                                <td><a href="vendor-dashboard-invoice-details.html" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>
                            <tr>
                                <td>PREMIUM</td>
                                <td>Stripe</td>
                                <td>November 25, 2020</td>
                                <td>$20</td>
                                <td><a href="vendor-dashboard-invoice-details.html" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>
                            <tr>
                                <td>PREMIUM</td>
                                <td>PayPal</td>
                                <td>December 08, 2020</td>
                                <td>$30</td>
                                <td><a href="vendor-dashboard-invoice-details.html" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>
                            <tr>
                                <td>PREMIUM</td>
                                <td>PayPal</td>
                                <td>December 08, 2020</td>
                                <td>$30</td>
                                <td><a href="vendor-dashboard-invoice-details.html" class="action-links"><i class="fa fa-eye"></i></a> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- My Invoice Section -->  
    </div>
</div>
@endsection