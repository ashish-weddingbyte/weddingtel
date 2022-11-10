
@extends('back.layouts.admin_layout')

@section('title', 'All Addons')


@section('main-container')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Addons</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('byte/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('byte/vendors/') }}">Vendos</a></li>
              <li class="breadcrumb-item active">All Addons</li>
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
                <h3 class="card-title">All Addons</h3>
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
                                    <th>Vendor</th>
                                    <th>Days</th>
                                    <th>Leads</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addons as $addon)

                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{ $addon->id }}"></td>
                                    <td><span>{{  $addon->name }}</span><br><span>{{  $addon->mobile }}</span></td>
                                    <td>{{  $addon->days }}</td>
                                    <td>{{ $addon->leads }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>

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