
@extends('back.layouts.admin_layout')

@section('title', 'Archive Plans')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Archive Plans</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/plans/') }}">Plans</a></li>
              <li class="breadcrumb-item active">Archive Plans</li>
            </ol>
          </div>
        </div>
        <div class="mt-3">
            @if(Session::has('message'))
                <div class="alert {{session('class')}}">
                    <span>{{session('message')}}</sapn>
                </div>
            @endif
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">All Leads Plans</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                                    <th>Plan Details</th>
                                    <th>Other Details</th>
                                    <th>Description</th>
                                    <th>Leads & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $lead)
                                
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $lead->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($lead->name) }}</span> <br />
                                        <span>{{ $lead->category_name }}</span> <br />
                                        <span class="text-success">{{ ucwords($lead->plan_type) }}</span>
                                    </td>
                                    <td>
                                        <p>Is Price : 
                                            <span class="text-success font-weight-bold">{{ $lead->price }}</span> INR
                                        </p>
                                        <p>Is Active : 
                                            @if($lead->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($lead->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        <p>Is Photo :
                                            @if(!empty( $lead->image))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        </p>
                                        
                                    </td>
                                    <td>{{ ucwords($lead->desc) }}</td>
                                    <td>
                                        <p>Leads : <span class=" font-weight-bold text-success">{{ $lead->leads }}</span></p>
                                        <p>Days : <span class=" font-weight-bold text-success">{{ $lead->days }} Days</span></p>
                                        <p>Support : <span class=" font-weight-bold text-success">{{ $lead->support }}</span></p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="restore_lead_paln" data-action="{{ url('byte/plans/action') }}" class="btn btn-outline-success submit" value="Restore Plan" >

                    <input type="button" data-action-type="force_delete_lead_plan" data-action="{{ url('byte/plans/action') }}" class="btn btn-outline-danger submit" value="Hard Delete Plan" >

                </form>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
        <div class="col-12">
            <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">All Position Plan List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                                    <th>Plan Details</th>
                                    <th>Other Details</th>
                                    <th>Description</th>
                                    <th>Positions & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $plan)
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $plan->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($plan->name) }}</span> <br />
                                        <span>{{ $plan->category_name }}</span> <br />
                                        <span class="text-success">{{ ucwords($plan->plan_type) }}</span>
                                    </td>
                                    <td>
                                        <p>Is Price : 
                                            <span class="text-success font-weight-bold">{{ $plan->price }}</span> INR
                                        </p>
                                        <p>Is Active : 
                                            @if($plan->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($plan->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        <p>Is Photo :
                                            @if(!empty( $plan->image))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        </p>
                                        
                                    </td>
                                    <td>{{ ucwords($plan->desc) }}</td>
                                    <td>
                                        <p>Leads : <span class=" font-weight-bold text-success">{{ $plan->position }}</span></p>
                                        <p>Days : <span class=" font-weight-bold text-success">{{ $plan->days }} Days</span></p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="restore_position_paln" data-action="{{ url('byte/plans/action') }}" class="btn btn-outline-success submit" value="Restore Plan" >

                    <input type="button" data-action-type="force_delete_position_plan" data-action="{{ url('byte/plans/action') }}" class="btn btn-outline-danger submit" value="Hard Delete Plan" >

                </form>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection