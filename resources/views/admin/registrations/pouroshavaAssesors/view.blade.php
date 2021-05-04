@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pouroshava Assesor Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pouroshava Assesor / View</li>
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
              <div class="row">

                <div class="col-sm-3">
                  <h3 class="card-title">Pouroshava Assesor Admin</h3>
                </div>

                <div class="col-sm-7"></div>

                <div class="col-sm-2">
                  <a href="{{ route('pouro_assesors.edit', $pouroAssesor->id) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;&nbsp;
                  <a href="{{ route('pouro_assesors.index') }}" class="btn btn-sm btn-primary">Back</a>
                </div>
                
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">

                <div class="col-sm-6">

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Zilla</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroAssesor->zilla }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Ward</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroAssesor->ward }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Name</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroAssesor->name }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Designation</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroAssesor->designation }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>NID</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroAssesor->nid }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-6">

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Pouroshava</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroAssesor->pouroshava }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Email</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroAssesor->email }}</h6>
                    </div>
                  </div>

                </div>

              </div>

              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                  <img src="{{ asset($pouroAssesor->user_picture) }}" style="width: 180px; height: 180px; border-radius: 50%;">
                </div>
                <div class="col-sm-4"></div>
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

