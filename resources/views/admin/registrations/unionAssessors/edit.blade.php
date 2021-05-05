@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Union Assesor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Union Assesor</li>
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
                <h3 class="card-title">Edit Union Assesor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('union_assesors.update', $unionAssesor->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
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
                            <option value="{{ $zilla->id }}" {{ ($unionAssesor->zilla_id == $zilla->id) ? 'selected': '' }}>{{ $zilla->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group" id="union_section">
                        <label for="exampleInputEmail1">Union</label>
                        <select name="union_id" class="form-control">
                            @foreach($unions as $union)
                              <option {{ ($unionAssesor->union_id == $union->id) ? 'selected':'' }}  value="{{ $union->id }}">{{ $union->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="designation" class="form-control" id="exampleInputEmail1" value="{{ $unionAssesor->designation }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $unionAssesor->email }}" disabled>
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
                        <div class="form-check">
                          <input class="form-check-input" name="is_check" onclick="check(this.value)" type="checkbox" id="is_check" style="width: 20px; height: 20px;">
                          <label class="form-check-label font-weight-bold pl-2 pt-1">Do yuo want to change Email or Password?</label>
                        </div>
                      </div>

                    </div>

                    <div class="col-sm-6">

                      <div class="form-group" id="upazilla_section">
                        <label for="exampleInputEmail1">Upazilla</label>
                        <select onchange="get_union(this.value)" name="upazilla_id" class="form-control">
                            @foreach($upazillas as $upazilla)
                              <option {{ ($unionAssesor->upazilla_id == $upazilla->id) ? 'selected':'' }}  value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group" id="ward_section">
                        <label for="exampleInputEmail1">Ward</label>
                        <select name="union_ward_id" class="form-control">
                            @foreach($wards as $ward)
                              <option {{ ($unionAssesor->union_ward_id == $ward->id) ? 'selected':'' }}  value="{{ $ward->id }}">{{ $ward->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $unionAssesor->name }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no" value="{{ $unionAssesor->phone }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">NID</label>
                        <input type="text" name="nid" class="form-control" id="exampleInputEmail1" placeholder="Enter NID no" value="{{ $unionAssesor->nid }}">
                      </div>

                    </div>

                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                  <a href="{{ route('union_assesors.index') }}" class="btn btn-warning" >Cancel</a>
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
  <script type="text/javascript">
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

    function check(data) {
      if(data == "on") {
        $("#email").prop('disabled', false);
        $("#is_check").val('off');
        // document.getElementById("email").style.disable = false;
      } else {
        $("#email").prop('disabled', true);
        $("#is_check").val('on');
      }
    }

  </script>
  @endsection 

