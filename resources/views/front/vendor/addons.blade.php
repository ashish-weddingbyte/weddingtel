@extends('front.layouts.user_layout')

@section('title', 'Addons')


@section('main-container')
<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Addons</h2>
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
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Addon Leads</th>
                                <th scope="col">Addon Days</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addons as $addon)
                            <tr>
                                <th>{{ ucwords($addon->leads) }} Leads</th>
                                <th>{{ ucwords($addon->days) }} Days</th>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($addon->created_at) ) }}</span></td>
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