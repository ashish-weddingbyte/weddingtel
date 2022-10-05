
@extends('back.layouts.admin_layout')

@section('title', 'All Vendors')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Vendors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendors</a></li>
              <li class="breadcrumb-item active">All Vendors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">All Vendor List</h3>
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
                        <table id="dataTable" class="table table-bordered table-striped">
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
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $vendor->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $vendor->brandname }}</span> ) <br />
                                        <span class="text-info">{{ $vendor->mobile }}</span> <br />
                                        <span class="text-muted">{{ $vendor->email }}</span> <br />
                                        <span class="font-weight-bold">{{ ucwords($vendor->city_name) }}</span>
                                    </td>
                                    <td>{{ $vendor->category_name }}</td>
                                    <td>
                                        <p>Is Active : <span class="text-success font-weight-bold">Yes</span></p>
                                        <p>Is Mobile Verified : <span class="text-danger font-weight-bold">No</span></p>
                                        <p>Is Email Verified : <span class="text-danger font-weight-bold">No</span></p>
                                    </td>
                                    <td>
                                        <p>Profile Photo : <span class="text-success font-weight-bold">Yes</span></p>
                                        <p>Gallery Photo : <span class="text-danger font-weight-bold">No</span></p>
                                    </td>
                                    <td>
                                        <p>Is Lead Plan : <span class="text-success font-weight-bold">Yes</span></p>
                                        <p>Is Query : <span class="text-danger font-weight-bold">No</span></p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="activate" data-action="{{ url('byte/vendors/all-vendors/action') }}" class="btn btn-outline-info submit" value="Activate Vendor" >

                    <input type="button" data-action-type="deactivate" data-action="{{ url('byte/vendors/all-vendors/action') }}" class="btn btn-outline-danger submit" value="De-Activate Vendor" >

                    <input type="button" data-action-type="delete" data-action="{{ url('byte/vendors/all-vendors/action') }}" class="btn btn-outline-danger submit" value="Delete Vendor" >

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