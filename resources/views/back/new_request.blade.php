
@extends('back.layouts.admin_layout')

@section('title', 'New User Requests')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">New Users</li>
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
                <h3 class="card-title">New Users</h3>
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
                                    <th>User Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_users as $user)
                                
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $user->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($user->name) }}</span> <br />
                                        <span class="text-info">{{ $user->mobile }}</span> <br />
                                        <span class="text-muted">{{ $user->email }}</span>  <br />
                                    </td>
                                    <td>{{ ucwords($user->user_type) }}</td>
                                    <td>
                                        <p>Is Active : 
                                            @if($user->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($user->status == '0')
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
                    <input type="button" data-action-type="activate" data-action="{{ url('byte/new_request/action') }}" class="btn btn-outline-info submit" value="Activate Vendor" >

                    <input type="button" data-action-type="deactivate" data-action="{{ url('byte/new_request/action') }}" class="btn btn-outline-danger submit" value="De-Activate Vendor" >

                    <input type="button" data-action-type="delete" data-action="{{ url('byte/new_request/action') }}" class="btn btn-outline-danger submit" value="Soft Delete Vendor" >

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