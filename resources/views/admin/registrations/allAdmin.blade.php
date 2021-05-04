@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Union Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Union</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Filter For Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('allAdmin.registration') }}" method="get">

                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Admin</label>
                        <select name="admin" class="form-control">
                          <option>Select Admin</option>
                          @foreach($admins as $admin)
                            <option value="{{ $admin->name }}">{{ $admin->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                </div>
              </form>
            </div>

          </div>

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

  @section('js')

  @endsection 

