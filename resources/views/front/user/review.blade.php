@extends('front.layouts.user_layout')

@section('title', 'Review & Ratings')

@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>My Review & Ratings</h2>
                
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
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="todo-status">
                            <div class="mr-3">
                                <span class="stars">
                                    {!! str_repeat(' <i class="fa fa-star"></i> ', 5 ) !!}        
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-md-end w-100">
                            <div class="todo-done">
                                <div class="badge badge-success">&nbsp;</div>
                                <div>{{ $total_ratings }}<span>Ratings</span>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-shadow">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th scope="col">&nbsp;</th> -->
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Review Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>                                        
                            </tr>
                        </thead>
                        @if(isset($all_ratings))
                        <tbody>
                            @foreach($all_ratings as $rating)
                            <tr>
                                <td class="text-nowrap">{{ ucwords($rating->name) }}</td>
                                <td class="text-nowrap">
                                    <span class="stars">
                                        {!! str_repeat(' <i class="fa fa-star"></i> ', $rating->rating ) !!}
                                        {!! str_repeat(' <i class="fa fa-star-o"></i> ', 5 -  $rating->rating ) !!}                                   
                                    </span>
                                </td>
                                <td>{{ $rating->comment }}</td>
                                
                                <td><span>{{ ($rating->status == '1') ? 'Approved' : 'Un-Approved' ; }}</span></td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#edit_modal-{{ $rating->id }}" class="action-links edit open-modal-check"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#delete_modal-{{ $rating->id }}" class="action-links"><i class="fa fa-trash"></i></a> </td>
                            </tr>

                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        
    </div>
</div>


@endsection

