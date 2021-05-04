@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ward Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ward</li>
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
                <h3 class="card-title">Add New</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('ward.store') }}" method="post">
                @csrf 

                <div class="card-body">

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Zilla</label>
                      <select onchange="get_pouroshava(this.value)" name="zilla_id" class="form-control">
                        <option>Select Zilla</option>
                        @foreach($zillas as $zilla)
                          <option value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-sm-6" id="pouroshava_section">
                      <label for="exampleInputEmail1">Pouroshava</label>
                      <select name="pouroshava_id" class="form-control">
                        <option>Select Pouroshava</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Ward Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Ward name">
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1">Ward No</label>
                      <input type="text" name="ward_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Ward No">
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
                  <a href="{{ route('ward.index') }}" class="btn btn-warning" >Cancel</a>
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
    function get_pouroshava(zilla_id) {

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); 

        $.ajax({
          type: "post",
          url : '{{ url("mayor/get-pouroshava") }}',
          data: {
            zilla_id: zilla_id
          },
          success:function(data) {
            console.log(data);
              $('#pouroshava_section').empty().html(data);
            }
          });
    }
  </script>

  @endsection 

