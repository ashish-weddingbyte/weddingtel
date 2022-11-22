
@extends('back.layouts.admin_layout')

@section('title', 'Lead List')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lead List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/leads/') }}">Leads</a></li>             
              <li class="breadcrumb-item active">Lead List</li>
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
                    <h3 class="card-title">Lead List</h3>
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
                                <div class="ribbon bg-warning">Vendor</div>
                            </div>
                            <h3>{{ $vendor->name }}</h3>
                            <span>{{ $vendor->brandname }}</span> |
                            <span>{{ $vendor->mobile }}</span> | 
                            <span>{{ $vendor->city_name }}</span>
                        </div>
                    </div>
                    <hr>
                    <form action="" method="post">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Lead Details</th>
                                        <th>Other Details</th>
                                        <th>Lead Open Date</th>
                                        <th>City</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($leads)
                                        @foreach($leads as $lead)
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">{{ ucwords($lead->name) }}</span> <br />
                                                    <span class="font-weight-bold">{{ ucwords($lead->mobile) }}</span> <br />
                                                </td>
                                                <td>
                                                    <p>Event Date : <span class="text-success">{{ date('M d, Y', strtotime($lead->event_date) ) }}</span></p>
                                                    
                                                    <p>Lead Type : 
                                                        @if($lead->type == 'new')
                                                            <span class="text-success font-weight-bold">New</span>
                                                        @endif
                                                        @if($lead->type == 'used')
                                                            <span class="text-danger font-weight-bold">Relaunch</span>
                                                        @endif
                                                    </p>
                                                    <p>Budget : <span class="font-weight-bold">{{ $lead->budget }}</span></p>
                                                </td>
                                                <td>
                                                    <p><span class="text-success">{{ date('M d, Y ', strtotime($lead->created_at) ) }}</span></p>
                                                </td>
                                                <td>
                                                    <span class="text-weight-bold">{{ $lead->city }}</span>
                                                </td>
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