
@extends('back.layouts.admin_layout')

@section('title', 'Vendor List')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendor List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/leads/') }}">Leads</a></li>             
              <li class="breadcrumb-item active">Vendor List</li>
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
            <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Vendor List</h3>
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
                <div class="my-2">
                    <div class="position-relative p-3 bg-gray">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-warning">{{ ucwords( $lead->type ) }}</div>
                        </div>
                        <h3>{{ $lead->name }}</h3>
                        <span>{{ $lead->mobile }}</span> | 
                        <span>{{ $lead->budget }}</span> | 
                        <span>{{ $lead->city }}</span> | 
                        <span>{{ $lead->view_count }}</span>
                    </div>
                </div>
                <hr>
                <form action="" method="post">
                    <div class="table-responsive">
                        <table  class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Vendor Details</th>
                                    <th>Date</th>
                                    <th>City</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($vendors)
                                    @foreach($vendors as $vendor)
                                    <?php
                                        $details = admin_helper::vendor_details($vendor->user_id);
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $details->brandname }}</span> ) <br />
                                                <span class="text-info">{{ $vendor->mobile }}</span> @if($details->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                                <span class="text-muted">{{ $vendor->email }}</span> @if($details->is_email_verified == '1') <i class="fas fa-check"></i>@endif  <br />
                                                
                                            </td>
                                            <td><span class="text-success">{{ date('M d, Y', strtotime($vendor->created_at) ) }}</span></td>
                                            <td>
                                                <span class="font-weight-bold">{{ ucwords($details->city_name) }}</span>
                                            </td>
                                            <td>{{ $details->category_name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        
                        </table>
                    </div>
                    
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