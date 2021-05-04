@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>District Admin Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DC</li>
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
              <h3 class="card-title">District Admin Information</h3>
              <a href="{{ route('dcs.edit', $dc->id) }}" class="btn btn-sm btn-info float-right">Edit</a>&nbsp;&nbsp;&nbsp;
              <a href="{{ route('dcs.index') }}" class="btn btn-sm btn-primary float-right">back</a>
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
                      <h6>{{ $dc->name }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Designation</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $dc->designation }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>NID</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $dc->nid }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-4">

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Email</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $dc->email }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Zilla</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $dc->zilla }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <h6>Post Code</h6>
                    </div>
                    <div class="col-sm-8">
                      <h6>{{ $dc->post_code }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-3">
                  <img src="{{ asset($dc->user_picture) }}" style="width: 180px; height: 180px; border-radius: 50%;">
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

