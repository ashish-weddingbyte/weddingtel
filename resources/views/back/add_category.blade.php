
@extends('back.layouts.admin_layout')

@section('title', 'Add Category')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/category/') }}">Category</a></li>             
              <li class="breadcrumb-item active">Add Category</li>
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
                        <h3 class="card-title">Add Category</h3>
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
                    <form class="form-horizontal" method="post" action="{{ url('/byte/category/save_category') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="icon" class="col-sm-2 col-form-label">Category Icon</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="icon" id="icon" placeholder="<i class='fa fa-user'></i>" value="{{ old('icon') }}">
                                <span class="text-danger">Plase Use <a href="https://fontawesome.com/v4/icons/" target="_blank">fontasesome 4.7</a> icons</span>
                                @error('icon')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept=".jpeg, .jpg, .png" name="category_image" id="category_image">
                                        <label class="custom-file-label" for="image">Choose Category Image</label>
                                    </div>
                                    @error('category_image')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="Add Category" class="btn btn-primary">
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