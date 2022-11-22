
@extends('back.layouts.admin_layout')

@section('title', 'View Contact Enquiry')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Contact Enquiry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/contact/') }}">Enquiry</a></li>
              <li class="breadcrumb-item active">View Contact Enquiry</li>
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
            <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">View Contact Enquiry</h3>
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
                                    <th>User Details</th>
                                    <th>Other Details</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queries as $query)
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $query->id }}"></td>
                                    
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($query->name) }}</span> <br />
                                        <span class="text-info">{{ $query->mobile }}</span> 
                                    </td>
                                    <td>
                                        @if(!empty($query->event))
                                            <p>Date : 
                                                <span class="text-success font-weight-bold">{{ date('M d, Y ', strtotime($query->event_date) ) }}</span>
                                            </p>
                                        @endif
                                        <p>City: 
                                            <span class="font-weight-bold">{{ $query->city }}</span>
                                        </p>
                                    </td>
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
                    
                    <input type="button" data-action-type="delete_contact_enquiry" data-action="{{ url('byte/contact/action') }}" class="btn btn-outline-danger submit" value="Delete Enquiry" >

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