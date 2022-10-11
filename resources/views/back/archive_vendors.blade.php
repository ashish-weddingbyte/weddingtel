
@extends('back.layouts.admin_layout')

@section('title', 'All Archive Vendors')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Archive Vendors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendors</a></li>
              <li class="breadcrumb-item active">All Archive Vendors</li>
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
                <h3 class="card-title">All Archive Vendors</h3>
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
                                    <th>Is Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_vendors as $vendor)
                                <?php
                                    $gallery = admin_helper::is_gallery($vendor->id);
                                    $lead = admin_helper::is_lead_plan_active($vendor->id);
                                    $position = admin_helper::is_position_plan_active($vendor->id);
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
                                        <p>Lead Plan: 
                                            @if($lead == true)
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif
                                        </p>
                                        <p>Position Plan: 
                                            @if($position == true)
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span></p>
                                            @endif</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    
                    <input type="button" data-action-type="restore" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-success submit" value="Restore Vendor" >

                    <input type="button" data-action-type="force_delete" data-action="{{ url('byte/vendors/action') }}" class="btn btn-outline-danger submit" value="Hard Delete Vendor" >

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