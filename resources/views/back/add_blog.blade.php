
@extends('back.layouts.admin_layout')

@section('title', 'Add blog')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li> 
              <li class="breadcrumb-item"><a href="{{ url('byte/blog/') }}">Blog</a></li>             
              <li class="breadcrumb-item active">Add Blog</li>
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
                        <h3 class="card-title">Add Blog</h3>
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
                    <form class="form-horizontal" method="post" action="{{ url('/byte/blog/save_blog') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Feature Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" accept=".png,.jpeg,.jpg" name="image" id="image" >
                                @error('image')
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
                            <label for="short_desc" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-10">
                                <textarea name="short_desc" id="short_desc" class="form-control" cols="20" rows="5" placeholder="Blog Short Description">{{ old('short_desc') }}</textarea>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="desc" id="desc" class="form-control" cols="20" rows="5" placeholder="Blog Description">{{ old('desc') }}</textarea>
                                @error('desc')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="Add Blog" class="btn btn-primary">
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

            
        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->

  @endsection