
@extends('back.layouts.admin_layout')

@section('title', 'Add Plan')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/plans/') }}">Plans</a></li>             
              <li class="breadcrumb-item active">Add Plan</li>
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
                        <h3 class="card-title">Add Lead Plan</h3>
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
                    <form class="form-horizontal" method="post" action="{{ url('/byte/plans/save_lead_plan') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <select name="type" id="type" class="form-control">
                                    <option value="0">Select Type</option>
                                    <option value="normal">Normal (Lead for all.)</option>
                                    <option value="exclusive">Exclusive (Lead for one.)</option>
                                </select>
                                @error('type')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" id="price" placeholder="Plan Price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="leads" class="col-sm-2 col-form-label">Leads</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="leads" id="leads" placeholder="Total Leads" value="{{ old('leads') }}">
                            @error('leads')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="days" class="col-sm-2 col-form-label">Days</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="days" id="days" placeholder="Total Days" value="{{ old('days') }}">
                            @error('days')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-sm-2 col-form-label">Details</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name="details" id="details" rows="3" placeholder="Enter Details">{{ old('details') }}</textarea>
                            @error('details')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category" id="category" class="form-control">
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Plan Image</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept=".jpeg, .jpg, .png" name="plan_image" id="plan_image">
                                    <label class="custom-file-label" for="image">Choose Plan Image</label>
                                </div>
                                @error('plan_image')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Support</label>
                            <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="24/7" name="support" value="24/7" {{ ( old('support') == '24/7' )? 'checked': '' }}>
                                <label for="24/7" class="custom-control-label">24/7</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="NA" name="support" value="NA" {{ ( old('support') == 'NA' )? 'checked': '' }}>
                                <label for="NA" class="custom-control-label">NA</label>
                            </div>
                            @error('support')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="Add Plan" class="btn btn-primary">
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

            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Add Position Plan</h3>
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
                    
                        <form class="form-horizontal" method="post" action="{{ url('/byte/plans/save_position_plan') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="plan_name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="plan_name" id="plan_name" placeholder="Name" value="{{ old('plan_name') }}">
                                    @error('plan_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Position</label>
                                    <div class="col-sm-5">
                                    <input type="number" class="form-control" name="from" id="from" placeholder="Position From" value="{{ old('from') }}">
                                    @error('from')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-5">
                                    <input type="number" class="form-control" name="to" id="to" placeholder="Position to" value="{{ old('to') }}">
                                    @error('to')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" name="plan_price" id="plan_price" placeholder="Plan Price" value="{{ old('plan_price') }}">
                                    @error('plan_price')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="days" class="col-sm-2 col-form-label">Days</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" name="plan_days" id="plan_days" placeholder="Total Days" value="{{ old('plan_days') }}">
                                    @error('plan_days')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="details" class="col-sm-2 col-form-label">Details</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" name="details" id="details" rows="3" placeholder="Enter Details">{{ old('details') }}</textarea>
                                    @error('details')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Plan Image</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept=".jpeg, .jpg, .png" name="position_plan_image" id="position_plan_image">
                                            <label class="custom-file-label" for="image">Choose Plan Image</label>
                                        </div>
                                        @error('position_plan_image')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="submit" value="Add Plan" class="btn btn-primary">
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