
@extends('back.layouts.admin_layout')

@section('title', 'Edit Leads')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/leads/') }}">Leads</a></li>             
              <li class="breadcrumb-item active">Edit Leads</li>
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
                    <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit Lead</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @if($lead)
                    <!-- /.card-header -->
                    <form class="form-horizontal" method="post" action="{{ url('/byte/leads/update') }}">
                        @csrf
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name',$lead->name) }}">
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{{ old('mobile',$lead->mobile) }}">
                            @error('mobile')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="budget" class="col-sm-2 col-form-label">Budget</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="budget" id="budget" placeholder="Budget" value="{{ old('budget',$lead->budget) }}">
                                @error('budget')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="details" class="col-sm-2 col-form-label">Details</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name="details" id="details" rows="3" placeholder="Enter Details">{{ old('details',$lead->details) }}</textarea>
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
                                        @if($lead->category_id === $category->id)
                                            <option value="{{$category->id}}" selected>{{ $category->category_name }}</option>
                                        @else
                                            <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                        @endif
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
                            <input type="date" class="form-control" name="event_date" id="event_date" placeholder="Event Date" value="{{ old('event_date',$lead->event_date) }}">
                            @error('event_date')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city" placeholder="City Name" value="{{ old('city',$lead->city) }}">
                            @error('city')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="lead_id" value="{{ $lead->id }}" />
                            <input type="submit" value="Update Lead" class="btn btn-warning">
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

           
        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->

  @endsection