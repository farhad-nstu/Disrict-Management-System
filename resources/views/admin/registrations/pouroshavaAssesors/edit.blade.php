@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Pouroshava Assesor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Pouroshava Assesor</li>
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
                <h3 class="card-title">Edit Pouroshava Assesor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('pouro_assesors.update', $pouroAssesor->id) }}" method="post" enctype="multipart/form-data">
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
                        <select onchange="get_pouroshava(this.value)" name="zilla_id" class="form-control">
                          <option>Select Zilla</option>
                          @foreach($zillas as $zilla)
                            <option value="{{ $zilla->id }}" {{ ($pouroAssesor->zilla_id == $zilla->id) ? 'selected': '' }}>{{ $zilla->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group" id="ward_section">
                        <label for="exampleInputEmail1">Ward</label>
                        <select name="ward_id" class="form-control">
                            @foreach($wards as $ward)
                              <option {{ ($pouroAssesor->ward_id == $ward->id) ? 'selected':'' }}  value="{{ $ward->id }}">{{ $ward->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="designation" class="form-control" id="exampleInputEmail1" value="{{ $pouroAssesor->designation }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $pouroAssesor->email }}" disabled>
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
                      <div class="form-group" id="pouro_section">
                        <label for="exampleInputEmail1">Pouroshava</label>
                        <select onchange="get_ward(this.value)" name="pouroshava_id" class="form-control">
                            @foreach($pouroshavas as $pouroshava)
                              <option {{ ($pouroAssesor->pouroshava_id == $pouroshava->id) ? 'selected':'' }}  value="{{ $pouroshava->id }}">{{ $pouroshava->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $pouroAssesor->name }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no" value="{{ $pouroAssesor->phone }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">NID</label>
                        <input type="text" name="nid" class="form-control" id="exampleInputEmail1" placeholder="Enter NID no" value="{{ $pouroAssesor->nid }}">
                      </div>

                    </div>

                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                  <a href="{{ route('pouro_assesors.index') }}" class="btn btn-warning" >Cancel</a>
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
    function get_pouroshava(zilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{route("pouro_assesors.zilla.pouroshava")}}',
        data: {
          zilla_id: zilla_id
        },
        success:function(data) {
            $('#pouro_section').empty().html(data);
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

    function get_ward(pouroshava_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{route("pouro_assesors.zilla.pouroshava.ward")}}',
        data: {
          pouroshava_id: pouroshava_id
        },
        success:function(data) {
            $('#ward_section').empty().html(data);
          }
        });
    }

  </script>
  @endsection 

