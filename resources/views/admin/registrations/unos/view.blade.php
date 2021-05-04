@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>UNO Admin Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">UNO</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">UNO Admin Information</h3>
              <a href="{{ route('unos.edit', $uno->id) }}" class="btn btn-sm btn-info float-right">Edit</a>&nbsp;&nbsp;&nbsp;
              <a href="{{ route('unos.index') }}" class="btn btn-sm btn-primary float-right">back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">

                <div class="col-sm-5">

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Name</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->name }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Designation</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->designation }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>NID</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->nid }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-4">

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Email</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->email }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Upazilla</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->upazilla }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Post Code</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $uno->post_code }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-3">
                  <img src="{{ asset($uno->user_picture) }}" style="width: 180px; height: 180px; border-radius: 50%;">
                </div>

              </div>
            </div>
            <!-- /.card-body -->
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

  <script>

  </script>

  @endsection 

