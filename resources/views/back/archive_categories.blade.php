
@extends('back.layouts.admin_layout')

@section('title', 'Archive Categories')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Archive Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/category/') }}">Categories</a></li>
              <li class="breadcrumb-item active">Archive Categories</li>
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
                <h3 class="card-title">Archive Categories</h3>
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
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)

                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $category->id }}"></td>
                                    <td>{{  $category->category_name }}</td>
                                    
                                    <td>
                                        <img src="{{ asset('storage/upload/category/'.$category->image)}}" width="200px" alt="{{ $category->image }}">
                                    </td>
                                    <td>
                                        <p>Is Active : 
                                            @if($category->status == '1')
                                                <span class="text-success font-weight-bold">Yes</span>
                                            @endif
                                            @if($category->status == '0')
                                                <span class="text-danger font-weight-bold">No</span>
                                            @endif
                                        </p>

                                    </td>
                                    <td>
                                        <a href="{{ url('/byte/category/all_categories/edit/'.$category->id) }}" class="btn btn-block btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <hr />
                    
                    <input type="button" data-action-type="restore" data-action="{{ url('byte/category/action') }}" class="btn btn-outline-success submit" value="Restore Category" >

                    <input type="button" data-action-type="force_delete" data-action="{{ url('byte/category/action') }}" class="btn btn-outline-danger submit" value="Hard Delete Category" >
                    

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
