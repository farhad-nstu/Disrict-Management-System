@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Union Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Union</li>
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
                <h3 class="card-title">Edit Union</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('union.update', $union->id) }}" method="post">
                @method('put')
                @csrf 

                <div class="card-body">

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Zilla</label>
                      <select onchange="get_upazill(this.value)" name="zilla_id" class="form-control">
                        @foreach($zillas as $zilla)
                          <option {{ ($union->zilla_id == $zilla->id) ? 'selected': '' }} value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-sm-6" id="upazilla_section">
                      <label for="exampleInputEmail1">Upazilla</label>
                      <select name="upazilla_id" class="form-control">
                        @foreach($upazillas as $upazilla)
                          <option {{ ($union->upazilla_id == $upazilla->id) ? 'selected' : '' }} value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Union Name</label>
                      <input type="text" name="name" value="{{ $union->name }}" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Union No</label>
                      <input type="text" name="union_no" value="{{ $union->union_no }}" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
                  <a href="{{ route('union.index') }}" class="btn btn-warning" >Cancel</a>
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
    function get_upazill(zilla_id) {

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type: "post",
          url : '{{url("uno/get-upazilla")}}',
          data: {
            zilla_id: zilla_id
          },
          success:function(data) {
              $('#upazilla_section').empty().html(data);
            }
          });
    }
  </script>

  @endsection 

