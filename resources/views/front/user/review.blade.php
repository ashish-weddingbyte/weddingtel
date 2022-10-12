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


                            <!-- Modal for Edit rating -->
                            <div class="modal fade" id="edit_modal-{{ $rating->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered register-tab">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                <h2 class="m-0" >Edit Review & Rating</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="card-shadow-body">
                                                <form  data-action="{{ url('tools/review/edit/') }}" class="submit">
                                                    <div class="row">
                                                        <div class="col-md-12 text-danger print-error-msg"></div>
                                                        
                                                    
                                                        <div class="from-group ml-2">
                                                            <input class="star star-5" id="star-5" type="radio" name="star" value="5" {{ ($rating->rating == 5) ? 'checked' : ''  }} />
                                                            <label class="star star-5" for="star-5"></label>
                                                            <input class="star star-4" id="star-4" type="radio" name="star" value="4" {{ ($rating->rating == 4) ? 'checked' : ''  }} />
                                                            <label class="star star-4" for="star-4"></label>
                                                            <input class="star star-3" id="star-3" type="radio" name="star" value="3" {{ ($rating->rating == 3) ? 'checked' : ''  }} />
                                                            <label class="star star-3" for="star-3"></label>
                                                            <input class="star star-2" id="star-2" type="radio" name="star" value="2" {{ ($rating->rating == 2) ? 'checked' : ''  }} />
                                                            <label class="star star-2" for="star-2"></label>
                                                            <input class="star star-1" id="star-1" type="radio" name="star" value="1" {{ ($rating->rating == 1) ? 'checked' : ''  }} />
                                                            <label class="star star-1" for="star-1"></label>
                                                            @error('star')
                                                                <div class="text-danger ml-2">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <textarea name="comment" placeholder="Comment" class="form-control" id="comment" cols="5" rows="2">{{ $rating->comment }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="review_id" value="{{ $rating->id }}">
                                                                <button type="submit" class="btn btn-default">Edit Review & Rating</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Delete rating -->
                            <div class="modal fade" id="delete_modal-{{ $rating->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered register-tab">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                <h2 class="m-0" >Confirmation</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="card-shadow-body">
                                                <form data-action="{{ url('tools/review/remove/') }}" class="submit">
                                                    <div class="row">
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <P class="text-danger">Are you sure, You want to delete this Rating & Review!</P>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="review_id" value="{{ $rating->id }}">
                                                                <button type="submit" class="btn btn-default">Delete Review & Rating</button>

                                                                <button type="close" data-dismiss="modal" class="btn btn-secondary ">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        
    </div>
</div>


@endsection

