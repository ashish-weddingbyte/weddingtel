
@extends('back.layouts.admin_layout')

@section('title', 'All Premium Leads')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Premium Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/premium_leads/') }}">Premium Leads</a></li>             
              <li class="breadcrumb-item active">All Premium Lead</li>
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
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">All Premium Leads</h3>
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
                                    <th>Other Details</th>
                                    <th>Category</th>
                                    <th>Budget</th>
                                    <th>Event Date</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $lead)
                                
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $lead->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($lead->name) }}</span> <br />
                                        <span class="text-info">{{ $lead->mobile }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($lead->city) }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($lead->type) }}</span>

                                    </td>
                                    <td>{{ ucwords($lead->details) }}</td>
                                    <td>{{ $lead->category_name }}</td>
                                    <td><span class="font-weight-bold">{{ $lead->budget }}</span></td>
                                    <td>
                                        <p>Event Date : <span class="text-success">{{ date('M d, Y', strtotime($lead->event_date) ) }}</span></p>

                                    </td>
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
                                    </td>
                                    <!-- <td>
                                        <a href="{{ url('/byte/leads/approved/edit/'.$lead->id) }}" class="btn btn-block btn-warning btn-sm">Edit</a>

                                        <a href="{{ url('/byte/leads/approved/vendors/'.$lead->id) }}" class="btn btn-block btn-info btn-sm">View Vendors</a>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="activate_premium_lead" data-action="{{ url('byte/premium_leads/action') }}" class="btn btn-outline-info submit" value="Activate Leads" >

                    <input type="button" data-action-type="deactivate_premium_lead" data-action="{{ url('byte/premium_leads/action') }}" class="btn btn-outline-danger submit" value="De-Activate Leads" >

                    <!-- <input type="button" data-action-type="delete" data-action="{{ url('byte/premium_leads/action') }}" class="btn btn-outline-danger submit" value="Soft Delete Leads" > -->

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