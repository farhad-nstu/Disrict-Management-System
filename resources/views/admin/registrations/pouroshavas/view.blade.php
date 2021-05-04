@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pouroshava Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pouroshava / View</li>
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
                  <h3 class="card-title">Pouroshava Admin</h3>
                </div>

                <div class="col-sm-7"></div>

                <div class="col-sm-2">
                  <a href="{{ route('pouroAdmin.edit', $pouroshava->id) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;&nbsp;
                  <a href="{{ route('pouroAdmin.index') }}" class="btn btn-sm btn-primary">Back</a>
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
                      <h6>{{ $pouroshava->zilla }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Name</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->name }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Designation</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->designation }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>NID</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->nid }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>User Free Active Date</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->free_active_date }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Charge Type</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->charge_type }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>Tax Payer Date</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->tax_payer_date }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <h6>First Time Online Registration Charge</h6>
                    </div>
                    <div class="col-sm-6">
                      <h6>{{ $pouroshava->first_online_charge }}</h6>
                    </div>
                  </div>

                </div>

                <div class="col-sm-6">

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Pouroshava</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->pouroshava }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Email</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->email }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Post Code</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->post_code }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Office Type</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->office_type }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Free Expire date</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->free_expire_date }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Online Charge</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->online_charge }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Tax Expire Date</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->tax_expire_date }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-5">
                      <h6>Renew Charge</h6>
                    </div>
                    <div class="col-sm-7">
                      <h6>{{ $pouroshava->renew_charge }}</h6>
                    </div>
                  </div>

                </div>

              </div>

              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                  <img src="{{ asset($pouroshava->user_picture) }}" style="width: 180px; height: 180px; border-radius: 50%;">
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

