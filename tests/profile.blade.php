@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('superadmin.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf 

                @if(Session::has('message'))
                  <h5 class="text-center text-info font-weight-bold">{{ Session::get('message') }}</h5>
                @endif 

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input type="text" name="designation" value="{{ $user->designation }}" class="form-control" id="exampleInputEmail1" placeholder="Enter designation">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="user_picture" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Company Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="office_logo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">User Profile</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Profile Picture</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img width="100px" height="100px" src="{{ asset($user->user_picture) }}">
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{ $user->name }}</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Designation</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{ $user->designation }}</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{ $user->phone }}</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{ $user->email }}</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Company Logo</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <img width="100px" height="100px" style="border-radius: 50%" src="{{ asset($user->office_logo) }}">
                      </div>
                    </div>
                  </div>
                
              </div>

              
              <!-- /.card-body -->
            </div>

            <!-- Password Change -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Password</h3>
              </div>

              <form role="form" action="{{ route('superadmin.password.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf 

                @if(Session::has('pass_message'))
                  <h5 class="text-center text-info font-weight-bold">{{ Session::get('pass_message') }}</h5>
                @endif 

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter password">

                    @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
              <!-- Password change end -->

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection