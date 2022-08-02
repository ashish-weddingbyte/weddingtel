@extends('front.layouts.user_layout')

@section('title', 'Checklist')

@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>My Checklist</h2>
                
                <a class="btn btn-default open-modal-check" href="javascript:void(0);" role="button" data-toggle="modal" data-target="#add_modal" ><i class="fa fa-plus"></i> Add New</a>
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
                            <div class="mr-3"> <strong><small>You have completed {{ $all_done_checklist_count }} out of {{ $all_checklist_count }} tasks</small></strong></div>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $checklist_done_perentage }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-md-end w-100">
                            <div class="todo-done">
                                <div class="badge badge-success">&nbsp;</div>
                                <div>{{ $all_done_checklist_count }}<span>Done</span>
                                </div> 
                            </div>
                            <div class="todo-done">
                                <div class="badge badge-warning">&nbsp;</div>
                                <div>{{ $all_checklist_count }}<span>Checklists</span>
                                </div> 
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($default))
            @foreach($default as $value)
                <div class="card-shadow">
                    <div class="todo-subhead mb-0">
                        <?php  
                            $date = $value[0]['added_date'];
                        ?>
                        <h3>{{ date('F', strtotime($date)) }} <span>{{ date('Y', strtotime($date)) }}</span></h3>
                    </div>
                    <div class="upcoming-task">
                        <ul class="list-unstyled mb-0">
                            @foreach($value as $v)
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="custom-control custom-checkbox form-dark">  
                                        <input type="checkbox" class="custom-control-input option-input" id="customCheck-{{ $v['id'] }}" data-id="{{ $v['id'] }}"  {{ $v['status'] == '0' ? 'checked': '' }} data-status="{{ $v['status'] }}" data-action="{{ url('tools/checklist/status/'.$v['id']) }}" >
                                        <label class="custom-control-label  {{ $v['status'] == '0' ? 'checked-label-text': '' }}"  for="customCheck-{{ $v['id'] }}">
                                            <span class="label-text">{{ $v['task'] }}</span>
                                            <small>{{ ucwords($v['type']) }}</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="info-listing align-items-center">
                                    <div class="badge-wrap">
                                        <div>Task Date</div>
                                        <span class="badge badge-primary">{{ date('F d Y', strtotime($v['added_date']) ) }}</span>
                                    </div>
                                    <div class="badge-wrap">
                                        <div>Status</div>
                                        <span class="badge {{ $v['status'] == '0' ? 'badge-success': 'badge-danger' }}">{{ $v['status'] == '0' ? 'Done': 'Pending' }}</span>
                                    </div>
                                    <div class="badge-wrap text-center">
                                        <span class="d-flex">
                                            <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#edit_modal-{{ $v['id'] }}" class="action-links edit mx-2 open-modal-check"><i class="fa fa-pencil"></i></a> 
                                            <a href="javascript:void(0);" role="button" data-toggle="modal" data-target="#delete_modal-{{ $v['id'] }}" class="action-links"><i class="fa fa-trash"></i></a> 
                                        </span>
                                    </div>
                                </div>
                            </li>



                            <!-- Modal for Edit Checklist -->
                            <div class="modal fade" id="edit_modal-{{ $v['id'] }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered register-tab">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                <h2 class="m-0" >Edit Checklist</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            

                                            <div class="card-shadow-body">
                                                <form data-action="{{ url('tools/checklist/edit/'.$v['id']) }}" class="submit">
                                                    <div class="row">
                                                        <div class="col-md-12 text-danger print-error-msg"></div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                            <div class="form-group">
                                                                <input id="title" name="title" type="text" placeholder="Write task here" class="form-control" value="{{ $v['task'] }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input id="date" name="date" type="text" placeholder="Task Date" class="form-control" data-toggle="datepicker" value="{{ $v['added_date'] }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="task_id" value="{{ $v['id'] }}">
                                                                <button type="submit" class="btn btn-default">Edit Checklist</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Delete Checklist -->
                            <div class="modal fade" id="delete_modal-{{ $v['id'] }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
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
                                                <form  data-action="{{ url('tools/checklist/delete/'.$v['id']) }}" class="submit">
                                                    <div class="row">
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <P class="text-danger">Are you sure, You want to delete this Checklist!</P>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="task_id" value="{{ $v['id'] }}">
                                                                <button type="submit" class="btn btn-default">Delete Checklist</button>

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
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif


    </div>
</div>






<!-- Modal for Add Checklist -->
<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered register-tab">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                    <h2 class="m-0" >Add Checklist</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>

                <div class="card-shadow-body">
                    <form data-action="{{ url('tools/checklist/add') }}" method="post" class="submit">
                        <div class="row">
                            <div class="col-md-12 text-danger print-error-msg"></div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="title" name="title" type="text" placeholder="Write task here" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input id="date" name="date" type="text" placeholder="Task Date" class="form-control" data-toggle="datepicker" >
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Add Checklist</button>
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

