@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Union Assesor Registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Union Assesor</li>
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
                <h3 class="card-title">Union Assesor Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('union_assesors.store') }}" method="post" enctype="multipart/form-data">
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
                        <select onchange="get_upazilla(this.value)" name="zilla_id" class="form-control">
                          <option>Select Zilla</option>
                          @foreach($zillas as $zilla)
                            <option {{ (old('zilla_id') == $zilla->id) ? 'selected':'' }} value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group" id="union_section">
                        <label for="exampleInputEmail1">Union</label>
                        <select onchange="get_ward(this.value)" name="union_id" class="form-control">
                          @if(! empty(old('union_id')))
                            @foreach($unions as $union)
                              <option {{ (old('union_id') == $union->id) ? 'selected':'' }}  value="{{ $union->id }}">{{ $union->name }}</option>
                            @endforeach 
                          @else 
                            <option>Select Union</option>
                          @endif 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="designation" class="form-control" id="exampleInputEmail1" placeholder="Enter designation" value="{{ old('designation') }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') }}">
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

                      <div class="form-group" id="upazilla_section">
                        <label for="exampleInputEmail1">Upazilla</label>
                        <select onchange="get_union(this.value)" name="upazilla_id" class="form-control">
                          @if(! empty(old('upazilla_id')))
                            @foreach($upazillas as $upazilla)
                              <option {{ (old('upazilla_id') == $upazilla->id) ? 'selected':'' }}  value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
                            @endforeach 
                          @else 
                            <option>Select Upazilla</option>
                          @endif 
                        </select>
                      </div>

                      <div class="form-group" id="ward_section">
                        <label for="exampleInputEmail1">Ward</label>
                        <select name="union_ward_id" class="form-control">
                          @if(! empty(old('union_ward_id')))
                            @foreach($wards as $ward)
                              <option {{ (old('union_ward_id') == $ward->id) ? 'selected':'' }}  value="{{ $ward->id }}">{{ $ward->name }}</option>
                            @endforeach 
                          @else 
                            <option>Select Ward</option>
                          @endif 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ old('name') }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no" value="{{ old('phone') }}">
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
    function get_upazilla(zilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{ url("chairman/union-assesor/upazilla") }}',
        data: {
          zilla_id: zilla_id
        },
        success:function(data) {
            $('#upazilla_section').empty().html(data);
          }
        });
    }

    function get_union(upazilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{ url("chairman/union-assesor/union") }}',
        data: {
          upazilla_id: upazilla_id
        },
        success:function(data) {
            $('#union_section').empty().html(data);
          }
        });
    }

    function get_ward(union_id) {
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{ url("chairman/union-assesor/ward") }}',
        data: {
          union_id: union_id
        },
        success:function(data) {
            $('#ward_section').empty().html(data);
          }
        });
    }

  </script>

  @endsection 

