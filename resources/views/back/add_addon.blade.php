
@extends('back.layouts.admin_layout')

@section('title', 'Add Addon Leads')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Addon Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendors</a></li>             
              <li class="breadcrumb-item active">Add Addon Leads</li>
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
                    <h3 class="card-title">Add Addon</h3>
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

                    <div class="my-2">
                        <div class="position-relative p-3 bg-gray">
                            <div class="ribbon-wrapper">
                                <div class="ribbon bg-warning">Lead Plan</div>
                            </div>
                            @if(!empty($paid_plan))
                            <h3>{{ $paid_plan->plan_name }}</h3>
                            <span>Available Leads => {{ $paid_plan->available_leads }}</span>|
                            <span>Start Date => {{ date('M d, Y', strtotime($paid_plan->start_at) ) }}  </span> |
                            <span>End Date => {{ date('M d, Y', strtotime($paid_plan->end_at) ) }}  </span>
                            @else
                              <h3>No Plan Found.</h3>
                            @endif
                        </div>
                    </div>
                    <hr>

                    <form class="form-horizontal" method="post" action="{{ url('/byte/leads/save_addon') }}">
                        @csrf
                        <div class="card-body">
                          <div class="form-group row">
                              <label for="leads" class="col-sm-2 col-form-label">Leads</label>
                              <div class="col-sm-10">
                              <input type="number" class="form-control" name="leads" id="leads" placeholder="Leads" value="{{ old('leads') }}">
                              @error('leads')
                                  <span class="text text-danger">{{ $message }}</span>
                              @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="number" class="col-sm-2 col-form-label">Days</label>
                              <div class="col-sm-10">
                              <input type="number" class="form-control" name="days" id="days" placeholder="Days" value="{{ old('days') }}">
                              @error('days')
                                  <span class="text text-danger">{{ $message }}</span>
                              @enderror
                              </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                            <input type="submit" value="Add Addon" class="btn btn-primary">
                            <input type="reset" value="Cancel" class="btn btn-secondary float-right" />
                        </div>
                        <!-- /.card-footer -->
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
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection