
@extends('back.layouts.admin_layout')

@section('title', 'Archive Cities')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Archive Cities</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/city/') }}">Cities</a></li>
              <li class="breadcrumb-item active">Archive Cities</li>
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
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">All Cities</h3>
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
                                    <th>City Name</th>
                                    <th>State Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)

                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $city->id }}"></td>
                                    <td>{{  $city->name }}</td>
                                    <td>{{  $city->state }}</td>
                                    
                                    <td>
                                        <p>Is Active : 
                                            @if($city->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($city->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>

                                        <p>Is Top : 
                                            @if($city->is_top == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($city->is_top == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                            @if($city->is_top == 'NULL')
                                                <span class="text-danger font-weight-bold">Empty</span>
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <hr />
                    <input type="button" data-action-type="restore" data-action="{{ url('byte/city/action') }}" class="btn btn-outline-success submit" value="Restore City" >

                    <input type="button" data-action-type="force_delete" data-action="{{ url('byte/city/action') }}" class="btn btn-outline-danger submit" value="Hard Delete City" >
                    

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