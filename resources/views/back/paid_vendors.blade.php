
@extends('back.layouts.admin_layout')

@section('title', 'All Paid Vendors')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Paid Vendors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendors</a></li>
              <li class="breadcrumb-item active">All Paid Vendors</li>
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
                <h3 class="card-title">Leads Plan Vendors</h3>
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
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Is Photo Uploaded</th>
                                    <th>Plan Details</th>
                                    <th>Lead Details</th>
                                    <th>Addon Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads_paid_vendor as $vendor)
                                <?php

                                    $gallery = admin_helper::is_gallery($vendor->user_id);
                                    $expiry_days = admin_helper::expiry_days($vendor->user_id);
                                    $used_leads = admin_helper::used_leads_details($vendor->id);
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $vendor->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $vendor->brandname }}</span> ) <br />
                                        <span class="text-info">{{ $vendor->mobile }}</span> @if($vendor->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                        <span class="text-muted">{{ $vendor->email }}</span> @if($vendor->is_email_verified == '1') <i class="fas fa-check"></i>@endif  <br />
                                        <span class="font-weight-bold">{{ ucwords($vendor->city_name) }}</span>
                                    </td>
                                    <td>{{ $vendor->category_name }}</td>
                                    <td>
                                        <p>Is Active : 
                                            @if($vendor->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($vendor->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        <p>Is Top : 
                                            @if($vendor->is_top == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($vendor->is_top == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>

                                        <p>Is Featured : 
                                            @if($vendor->is_featured == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($vendor->is_featured == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        
                                    </td>
                                    <td>
                                        <p>Profile Photo :
                                            @if(!empty( $vendor->featured_image))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        <p>Gallery Photo : 
                                            @if($gallery == true)
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>Plan : <span class="text-success">{{ $vendor->plan_name }}</span></p>
                                        <p>Start : <span class="text-success">{{ date('M d, Y', strtotime($vendor->start_at) ) }}</span></p>
                                        <p>End : <span class="text-danger">{{ date('M d, Y', strtotime($vendor->end_at) ) }}</span></p>
                                        <p>Expiry Days : <span class="font-weight-bold">{{ $expiry_days }}</span></p>
                                    </td>
                                    <td>
                                        <p>Total Leads : <span class="text-success font-weight-bold">{{ $vendor->total_lead }}</span></p>
                                        <p>Available Leads : <span class="text-success font-weight-bold">{{ $vendor->available_leads }}</span></p>
                                        <p>Used Leads: <span class="text-success font-weight-bold">{{ ucwords($used_leads) }}</span></p>
                                    </td>
                                    <td>
                                        <p>Is Addon : <span class="text-success font-weight-bold">{{ ucwords($vendor->is_addon) }}</span></p>
                                    </td>
                                    <td>
                                        <a href="{{ url('/byte/vendors/paid_vendors/leads/'.$vendor->user_id) }}" class="btn btn-block btn-warning btn-sm">Open Leads</a>
                                        <a href="{{ url('/byte/vendors/paid_vendors/addon/'.$vendor->user_id) }}" class="btn btn-block btn-info btn-sm">Add Addon</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />

                    <input type="button" data-action-type="expired_lead_plan" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-warning submit" value="Expire Plan" >

                    <input type="button" data-action-type="add_top" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-info submit" value="Add Top Vendor" >

                    <input type="button" data-action-type="add_featured" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-secondary submit" value="Add Featured Vendor" >

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
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Position Plan Vendors </h3>
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
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Is Photo Uploaded</th>
                                    <th>Plan Details</th>
                                    <th>Position Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($position_paid_vendor as $vendor)
                                <?php
                                    $gallery = admin_helper::is_gallery($vendor->id);
                                    $expiry_days_position = admin_helper::expiry_days_position($vendor->id);
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $vendor->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $vendor->brandname }}</span> ) <br />
                                        <span class="text-info">{{ $vendor->mobile }}</span> @if($vendor->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                        <span class="text-muted">{{ $vendor->email }}</span> @if($vendor->is_email_verified == '1') <i class="fas fa-check"></i>@endif  <br />
                                        <span class="font-weight-bold">{{ ucwords($vendor->city_name) }}</span>
                                    </td>
                                    <td>{{ $vendor->category_name }}</td>
                                    <td>
                                        <p>Is Active : 
                                            @if($vendor->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($vendor->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        
                                    </td>
                                    <td>
                                        <p>Profile Photo :
                                            @if(!empty( $vendor->featured_image))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        <p>Gallery Photo : 
                                            @if($gallery == true)
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>Plan : <span class="text-success">{{ $vendor->plan_name }}</span></p>
                                        <p>Start : <span class="text-success">{{ date('M d, Y', strtotime($vendor->start_at) ) }}</span></p>
                                        <p>End : <span class="text-danger">{{ date('M d, Y', strtotime($vendor->end_at) ) }}</span></p>
                                        <p>Expiry Days : <span class="font-weight-bold">{{ $expiry_days_position }}</span></p>
                                    </td>
                                    <td>
                                        <p>Plan : <span class="text-success">{{ $vendor->city_name }}</span></p>
                                        <p>Position : 
                                            @if($vendor->listing_order != NULL)
                                                <span class="text-success font-weight-bold">{{ $vendor->listing_order }}</span>
                                            @else
                                                <span class="text-danger font-weight-bold">NA</span></p>
                                            @endif
                                    </td>
                                    
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="expired_position_plan" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-warning submit" value="Expire Plan" >

                    <input type="button" data-action-type="add_top" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-info submit" value="Add Top Vendor" >

                    <input type="button" data-action-type="add_featured" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-secondary submit" value="Add Featured Vendor" >

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