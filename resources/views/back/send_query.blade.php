
@extends('back.layouts.admin_layout')

@section('title', 'Send Message Query')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Message Query</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/query/') }}">Query</a></li>
              <li class="breadcrumb-item active">Send Message Query</li>
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
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Send Message Query</h3>
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
                                    <th>Vendor Details</th>
                                    <th>User Type</th>
                                    <th>User Details</th>
                                    <th>Other Details</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queries as $query)
                                <?php
                                    $vendor = admin_helper::vendor_details($query->vendor_id);
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $query->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $vendor->brandname }}</span> ) <br />
                                        <span class="text-info">{{ $vendor->mobile }}</span> @if($vendor->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                        <span class="text-muted">{{ $vendor->category_name }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($vendor->city_name) }}</span>
                                    </td>
                                    <td>{{ ucwords( $query->user_type ) }}</td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($query->name) }}</span> <br />
                                        <span class="text-info">{{ $query->mobile }}</span> @if($query->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                    </td>
                                    <td>
                                        <p>Budget : <span class="font-weight-bold">{{ $query->budget }}</span></p>
                                        <p>Event Date : <span class="text-success">{{ date('M d, Y', strtotime($query->event_date) ) }}</span></p>
                                    </td>
                                    <td>{{ $query->details }}</td>
                                    <td><span class="text-success">{{ date('M d, Y h:i A ', strtotime($query->created_at) ) }}</span></td>
                                    <td>
                                        <p>Is Active : 
                                            @if($query->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($query->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    
                    <input type="button" data-action-type="activate" data-action="{{ url('byte/query/action') }}" class="btn btn-outline-info submit" value="Activate Query" >

                    <input type="button" data-action-type="deactivate" data-action="{{ url('byte/query/action') }}" class="btn btn-outline-danger submit" value="De-Activate Query" >

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