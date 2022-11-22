@extends('front.layouts.user_layout')

@section('title', 'Guestlist')


@section('main-container')

    <div class="main-contaner">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="section-title">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <h2>My Guest Manager</h2>
                    <a class="btn btn-default open-modal-check" href="javascript:void(0);" role="button" data-toggle="modal" data-target="#add_modal" ><i class="fa fa-plus"></i> Add New Guest</a>
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
                    <div class="couple-info p-0">
                        <div class="row row-cols-2 row-cols-md-4 row-cols-sm-2">
                            <div class="col">
                                <div class="couple-status-item">
                                    <div class="counter">{{ $total_guest }}</div>
                                    <div class="text">
                                        <strong>Guests</strong>
                                        <small>From Total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="couple-status-item">
                                    <div class="counter">{{ $confirm_guest }}</div>
                                    <div class="text">
                                        <strong>Confirm</strong>
                                        <small>From Total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="couple-status-item">
                                    <div class="counter">{{ $pending_guest }}</div>
                                    <div class="text">
                                        <strong>Pending</strong>
                                        <small>From Total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="couple-status-item">
                                    <div class="counter">{{ $cancel_guest }}</div>
                                    <div class="text">
                                        <strong>Cancel</strong>
                                        <small>From Total</small>
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
                                <th scope="col">Guest Name</th>
                                <th scope="col">Group</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col" class="text-nowrap">No. of Guest</th>
                                <th scope="col">Invitation Status</th>
                                <th scope="col">Address</th>
                                <th scope="col">Commnet</th>
                                <th scope="col">Action</th>                                        
                            </tr>
                        </thead>
                        @if(isset($guestlist))
                        <tbody>
                            @foreach($guestlist as $key => $value)
                            <tr>
                                <!-- <td class="text-right pr-0 pl-4">
                                    <div class="custom-control custom-checkbox form-dark">
                                        <input type="checkbox" class="custom-control-input" id="1">
                                        <label class="custom-control-label pl-0" for="1">&nbsp;</label>
                                    </div>
                                </td> -->
                                <td class="text-nowrap">{{ ucwords($value->name) }}</td>
                                <td class="text-nowrap">Groom Friend</td>
                                <td class="text-nowrap">{{ $value->mobile }}</td>
                                <td>{{ $value->no_of_guest }}</td>
                                <td>
                                    <select class="select_bordered" name="status" style="width: 100%;">
                                        <option value="confirm" {{ ($value->status == 'confirm')?'selected':'' }}>Confirmed</option>
                                        <option value="pending" {{ ($value->status == 'pending')?'selected':'' }}>Pending</option>
                                        <option value="cancel" {{ ($value->status == 'cancel')?'selected':'' }}>Cancel</option>
                                    </select>
                                </td>
                                
                                <td><span class="text-truncate table-truncate d-inline-block">{{ $value->address }}</span></td>
                                <td><span  class="text-truncate table-truncate d-inline-block">{{ $value->comment }}</span></td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#edit_modal-{{ $value->id }}" class="action-links edit open-modal-check"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#delete_modal-{{ $value->id }}" class="action-links"><i class="fa fa-trash"></i></a> </td>
                            </tr>


                            <!-- Modal for Edit Guest -->
                            <div class="modal fade" id="edit_modal-{{ $value->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered register-tab">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                <h2 class="m-0" >Edit Guest</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            

                                            <div class="card-shadow-body">
                                                <form  data-action="{{ url('tools/guestlist/edit/'.$value['id']) }}" class="submit">
                                                    <div class="row">
                                                        <div class="col-md-12 text-danger print-error-msg"></div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <input id="name" name="name" type="text" value="{{ $value->name }}"  class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <?php  
                                                                    $group = App\Models\RelationGroup::all();
                                                                ?>
                                                                <select name="group" id="group" class="form-control">
                                                                    <option value="">Select Group</option>
                                                                    @foreach($group as $g)
                                                                        @if($value->group_id == $g->id)
                                                                            <option value="{{$g->id}}" selected>{{ $g->name }}</option>
                                                                        @else
                                                                            <option value="{{$g->id}}">{{ $g->name }}</option>
                                                                        @endif
                                                                        
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <input id="mobile" name="mobile" type="number" value="{{ $value->mobile }}" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <input id="no_of_guest" name="no_of_guest" type="number" value="{{ $value->no_of_guest }}" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <textarea name="comment" placeholder="Comment" class="form-control" id="comment" cols="5" rows="2">{{ $value->comment }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <textarea name="address" placeholder="Address" class="form-control" id="address" cols="5" rows="2">{{ $value->address }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="">Select Invitation Status</option>
                                                                    <option value="pending" {{ ($value->status == 'pending')?'selected':'' }} >Pending</option>
                                                                    <option value="confirm" {{ ($value->status == 'confirm')?'selected':'' }}>Confirm</option>
                                                                    <option value="cancel" {{ ($value->status == 'cancel')?'selected':'' }}>Cancel</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="guest_id" value="{{ $value['id'] }}">
                                                                <button type="submit" class="btn btn-default">Edit Guest</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal for Delete guets -->
                            <div class="modal fade" id="delete_modal-{{ $value->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
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
                                                <form data-action="{{ url('tools/guestlist/delete/'.$value['id']) }}" class="submit">
                                                    <div class="row">
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <P class="text-danger">Are you sure, You want to delete this Guest!</P>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="guest_id" value="{{ $value['id'] }}">
                                                                <button type="submit" class="btn btn-default">Delete Guest</button>

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
            <div class="mt-4">
                <div class="theme-pagination">
                    {{ $guestlist->links() }}
                </div>
            </div>
            
        </div>
    </div>

    
<!-- Modal for Add Checklist -->
<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered register-tab">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                    <h2 class="m-0" >Add Guest</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>

                <div class="card-shadow-body">
                    <form data-action="{{ url('tools/guestlist/add') }}" method="post" class="submit">
                        <div class="row">
                            <div class="col-md-12 text-danger print-error-msg"></div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="name" name="name" type="text" placeholder="Guest Name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <?php  
                                        $group = App\Models\RelationGroup::all();
                                    ?>
                                    <select name="group" id="group" class="form-control">
                                        <option value="">Select Group</option>
                                        @foreach($group as $g)
                                            <option value="{{$g->id}}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="mobile" name="mobile" type="number" placeholder="Guest Mobile Number" class="form-control" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="no_of_guest" name="no_of_guest" type="number" placeholder="Number Of Guest" class="form-control" />
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" placeholder="Comment" id="comment" cols="5" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="Address" id="address" cols="5" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Invitation Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="confirm">Confirm</option>
                                        <option value="cancel">Cancel</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Add Guest</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection