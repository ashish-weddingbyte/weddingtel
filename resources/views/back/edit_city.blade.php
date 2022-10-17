
@extends('back.layouts.admin_layout')

@section('title', 'Edit City')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit City</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/City/') }}">City</a></li>             
              <li class="breadcrumb-item active">Edit City</li>
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
                        <h3 class="card-title">Edit City</h3>
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
                    @if($city)
                    <form class="form-horizontal" method="post" action="{{ url('/byte/city/update') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="city_name" class="col-sm-2 col-form-label">City Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="city_name" id="city_name" placeholder="City Name" value="{{ old('city_name',$city->name) }}">
                                @error('city_name')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state_name" class="col-sm-2 col-form-label">State Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="state_name" id="state_name" placeholder="State Number" value="{{ old('state_name',$city->state) }}">
                                @error('state_name')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="Update City" class="btn btn-primary">
                            <input type="hidden" name="city_id" value="{{ $city->id }}" />
                            <input type="reset" value="Cancel" class="btn btn-secondary float-right" />
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    @endif
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