@extends('front.layouts.user_layout')

@section('title', 'Website')


@section('main-container')


<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-start">
                <h2> Wedding Website comming soon</h2>
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

        

        
    </div>
</div>




@endsection