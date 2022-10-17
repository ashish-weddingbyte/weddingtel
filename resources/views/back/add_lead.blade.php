
@extends('back.layouts.admin_layout')

@section('title', 'Add Leads')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/leads/') }}">Leads</a></li>             
              <li class="breadcrumb-item active">Add Leads</li>
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
                        <h3 class="card-title">Add Lead</h3>
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
                    <form class="form-horizontal" method="post" action="{{ url('/byte/leads/save_lead') }}">
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
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}">
                            @error('mobile')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="budget" class="col-sm-2 col-form-label">Budget</label>
                            <div class="col-sm-10">
                                <select name="budget" id="budget" class="form-control">
                                    <option value="0">Select Budget</option>
                                    <option value="1000-5000">1000-5000 INR</option>
                                    <option value="5000-10000">5000-10000 INR</option>
                                    <option value="10000-20000">10000-20000 INR</option>
                                    <option value="20000-30000">20000-30000 INR</option>
                                    <option value="30000-40000">30000-40000 INR</option>
                                    <option value="40000-50000">40000-50000 INR</option>
                                    <option value="50000-60000">50000-60000 INR</option>
                                    <option value="60000-70000">60000-70000 INR</option>
                                    <option value="70000-80000">70000-80000 INR</option>
                                    <option value="80000-90000">80000-90000 INR</option>
                                    <option value="90000-100000">90000-100000 INR</option>
                                </select>
                                @error('budget')
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
                            <label for="event_date" class="col-sm-2 col-form-label">Event Date</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" name="event_date" id="event_date" placeholder="Event Date" value="{{ old('event_date') }}">
                            @error('event_date')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city" placeholder="City Name" value="{{ old('city') }}">
                            @error('city')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="Add Lead" class="btn btn-primary">
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
                            <h3 class="card-title">Bulk Upload Lead</h3>
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
                    
                        <form class="form-horizontal" method="post" action="{{ url('/byte/leads/upload_leads') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Excel File</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept=".xlsx, .csv, .xls" name="excel" id="excel">
                                            <label class="custom-file-label" for="excel">Choose Excel File</label>
                                        </div>
                                        @error('excel')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="submit" value="Upload" class="btn btn-primary">
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