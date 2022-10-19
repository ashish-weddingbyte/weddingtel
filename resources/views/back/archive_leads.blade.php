
@extends('back.layouts.admin_layout')

@section('title', 'All Archive Leads')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Archive Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/leads/') }}">Leads</a></li>             
              <li class="breadcrumb-item active">All Archive Leads</li>
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
                <h3 class="card-title">All Archive Leads</h3>
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
                                    <th>Lead Details</th>
                                    <th>Category</th>
                                    <th>Budget</th>
                                    <th>Event Date</th>
                                    <th>Status</th>
                                    <th>Tags Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_leads as $lead)
                                
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $lead->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($lead->name) }}</span> <br />
                                        <span class="text-info">{{ $lead->mobile }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($lead->city) }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($lead->type) }}</span>

                                    </td>
                                    <td>{{ $lead->category_name }}</td>
                                    <td><span class="font-weight-bold">{{ $lead->budget }}</span></td>
                                    <td><span class="text-success">{{ date('M d, Y', strtotime($lead->event_date) ) }}</td>
                                    <td>
                                        <p>Is Active : 
                                            @if($lead->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($lead->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        
                                        <p>Booking Status : 
                                            @if($lead->booking_status == 'open')
                                                <span class="text-success font-weight-bold">Open</span>
                                            @endif
                                            @if($lead->booking_status == 'booked')
                                                <span class="text-danger font-weight-bold">Booked</span>
                                            @endif
                                            @if($lead->booking_status == NULL)
                                                <span class="text-danger font-weight-bold">NA</span>
                                            @endif
                                        </p>
                                        <p>View Count :
                                            <span class="font-weight-bold">{{ $lead->view_count }}</span>
                                        </p>

                                        <p>Is Approved : 
                                            @if($lead->approved_status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($lead->approved_status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>Applied Tag :
                                            @if($lead->apply_tags == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($lead->apply_tags == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>

                                        @if($lead->apply_tags == '1')
                                            <p>Tag :<span class="text-success font-weight-bold">{{ ucwords($lead->tags) }}</span></p>
                                        @endif
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    
                    <input type="button" data-action-type="restore" data-action="{{ url('byte/leads/action') }}" class="btn btn-outline-success submit" value="Restore Leads" >

                    <input type="button" data-action-type="force_delete" data-action="{{ url('byte/leads/action') }}" class="btn btn-outline-danger submit" value="Hard Delete Leads" >

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