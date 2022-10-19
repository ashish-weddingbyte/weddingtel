
@extends('back.layouts.admin_layout')

@section('title', 'All Users')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/users/') }}">Users</a></li>
              <li class="breadcrumb-item active">All Users</li>
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
                <h3 class="card-title">All Bride/Groom</h3>
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
                                    <th>Partner Details</th>
                                    <th>Wedding Details</th>
                                    <th>Is Tools Use</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_users as $user)
                                <?php
                                    $tools = admin_helper::tools_status($user->id);
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $user->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($user->name) }}</span> <br />
                                        <span class="text-info">{{ $user->mobile }}</span> @if($user->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                        <span class="text-muted">{{ $user->email }}</span> @if($user->is_email_verified == '1') <i class="fas fa-check"></i>@endif  <br />
                                        <span class="font-weight-bold">{{ ucwords($user->city_name) }}</span>
                                    </td>
                                    <td>
                                        <p>Event Date : <span class="text-success">{{ date('M d, Y ', strtotime($user->event) ) }}</span></p>
                                        <p>Profile Photo : 
                                            @if(!empty($user->profile))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                        <p>User Type : <span class="font-weight-bold">{{ ucwords($user->type) }}</span></p>
                                    </td>
                                    <td>
                                        <p>Name : 
                                            @if(!empty($user->partner_name))
                                                <span class="text-success font-weight-bold">{{ ucwords($user->partner_name) }}</span>
                                            @else
                                                <span class="text-danger font-weight-bold">Empty</span>
                                            @endif
                                        </p>

                                        <p>Photo : 
                                            @if(!empty($user->partner_profile))
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @else
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>Address : 
                                            @if(!empty($user->wedding_address))
                                                <span class="text-success font-weight-bold">{{ ucwords($user->wedding_address) }}</span>
                                            @else
                                                <span class="text-danger font-weight-bold">Empty</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p>Wishlist : 
                                            <span class="font-weight-bold">{{ $tools['wishlist'] }}</span>
                                        </p>
                                        <p>Checklist : 
                                            <span class="font-weight-bold">{{ $tools['checklist'] }}</span>
                                        </p>
                                        <p>Guestlist : 
                                            <span class="font-weight-bold">{{ $tools['guestlist'] }}</span>
                                        </p>
                                        <p>Budget : 
                                            <span class="font-weight-bold">{{ $tools['budget'] }}</span>
                                        </p>
                                        <p>Realwedding : 
                                            <span class="font-weight-bold">{{ $tools['realwedding'] }}</span>
                                        </p>
                                        <p>Review : 
                                            <span class="font-weight-bold">{{ $tools['review'] }}</span>
                                        </p>
                                    </td>
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
                    
                    <input type="button" data-action-type="activate" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-info submit" value="Activate User" >

                    <input type="button" data-action-type="deactivate" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-danger submit" value="De-Activate User" >

                    <input type="button" data-action-type="delete" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-danger submit" value="Soft Delete" >

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