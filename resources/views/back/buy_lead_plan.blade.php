
@extends('back.layouts.admin_layout')

@section('title', 'Buy Lead Plan')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Buy Lead Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendor</a></li>             
              <li class="breadcrumb-item active">Buy Lead Plan</li>
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
                        <h3 class="card-title">Buy Lead Plan</h3>
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
                    <form class="form-horizontal" method="post" action="{{ url('byte/vendors/save_lead_plan') }}">
                        @csrf
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
                            <div class="form-group row">
                                <label for="plan" class="col-sm-2 col-form-label">Plan</label>
                                <div class="col-sm-10">
                                    <select name="plan" id="plan" class="form-control">
                                        <option value="0">Select Plan</option>
                                        @foreach($plans as $plan)
                                            <option value="{{$plan->id}}">{{ $plan->name }} | {{ ucwords($plan->plan_type) }} | {{ $plan->price }} INR | {{ $plan->leads }} Leads | {{ $plan->days }} Days</option>
                                        @endforeach
                                    </select>
                                    @error('plan')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="remark" class="col-sm-2 col-form-label">Payment Remark</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="remark" id="remark" rows="3" placeholder="Payment Remark">{{ old('remark') }}</textarea>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                            <input type="submit" value="Make Payment" class="btn btn-primary">
                            <input type="reset" value="Cancel" class="btn btn-secondary float-right" />
                        </div>
                        <!-- /.card-footer -->
                    </form>
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