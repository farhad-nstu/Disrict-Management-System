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
      <!-- left column -->
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Update Profile</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
          @csrf 

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

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
            <a href="{{ route('profile') }}" class="btn btn-warning">Cancel</a>
          </div>
        </form>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection