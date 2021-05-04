@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DC Registration</h1>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">DC Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('dcAdmin.registration') }}" method="post" enctype="multipart/form-data">
                @csrf 

                <div class="card-body">

                  @if(! empty($errors))
                    @foreach ($errors->all() as $error)
                      <ul>
                        <li class="text-danger font-weight-bold">{{ $error }}</li>
                      </ul>
                    @endforeach 
                  @endif 

                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Zilla</label>
                        <select name="zilla_id" class="form-control">
                          <option>Select Zilla</option>
                          @foreach($zillas as $zilla)
                            <option value="{{ $zilla->id }}" {{ (old('zilla_id') == $zilla->id) ? 'selected': '' }}>{{ $zilla->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ old('name') }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="designation" class="form-control" id="exampleInputEmail1" placeholder="Enter designation" value="{{ old('designation') }}">
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

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no" value="{{ old('phone') }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">NID</label>
                        <input type="text" name="nid" class="form-control" id="exampleInputEmail1" placeholder="Enter NID no" value="{{ old('nid') }}">
                      </div>
                    </div>

                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

  <script>
    @if(Session::has('message')) 
        toastr.success("{{ Session::get('message') }}");
    @endif
  </script>

  @endsection 

