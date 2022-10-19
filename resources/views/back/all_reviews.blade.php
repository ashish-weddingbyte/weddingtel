
@extends('back.layouts.admin_layout')

@section('title', 'All Reviews')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Reviews</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/users/') }}">Users</a></li>
              <li class="breadcrumb-item active">All Reviews</li>
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
                <h3 class="card-title">All Reviews</h3>
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
                                    <th>User Details <small>(from)</small></th>
                                    <th>Vendor Details <small>(to)</small></th>
                                    <th>Rating & Review Details</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_review as $review)
                                <?php
                                    $vendor = admin_helper::vendor_details($review->vendor_id);
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $review->id }}"></td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($review->name) }}</span> <br />
                                        <span class="text-muted">{{ $review->email }}</span><br />
                                        <span class="font-weight-bold">{{ ucwords($review->user_type) }}</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">{{ ucwords($vendor->name) }}</span> ( <span class="text-success">{{ $vendor->brandname }}</span> ) <br />
                                        <span class="text-info">{{ $vendor->mobile }}</span> @if($vendor->is_mobile_verified == '1') <i class="fas fa-check"></i>@endif <br />
                                        <span class="font-weight-bold">{{ ucwords($vendor->city_name) }}</span>
                                    </td>
                                    <td>
                                        <p>Time : <span class="text-success">{{ date('M d, Y', strtotime($review->created_at) ) }}</span></p>
                                        <p>
                                            <span class="stars">
                                                {!! str_repeat(' <i class="fa fa-star"></i> ', $review->rating ) !!}                                  
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <p>{{ ucwords($review->comment) }}</p>
                                    </td>
                                    
                                    <td>
                                        <p>Is Active : 
                                            @if($review->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($review->status == '0')
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
                    
                    <input type="button" data-action-type="activate_review" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-info submit" value="Activate Review" >

                    <input type="button" data-action-type="deactivate_review" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-danger submit" value="De-Activate Review" >

                    <input type="button" data-action-type="delete_review" data-action="{{ url('byte/users/action') }}" class="btn btn-outline-danger submit" value="Delete" >

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