@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Union</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Union</li>
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
              <form role="form" action="{{ route('unionParishads.update', $union->id) }}" method="post" enctype="multipart/form-data">
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
                        <select onchange="get_upazill(this.value)" name="zilla_id" class="form-control">
                          <option>Select Zilla</option>
                          @foreach($zillas as $zilla)
                            <option value="{{ $zilla->id }}" {{ ($union->zilla_id == $zilla->id) ? 'selected': '' }}>{{ $zilla->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group" id="union_section">
                        <label for="exampleInputEmail1">Union</label>
                        <select name="union_id" class="form-control">
                            @foreach($unions as $un)
                              <option {{ ($union->union_id == $un->id) ? 'selected':'' }}  value="{{ $un->id }}">{{ $un->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="designation" class="form-control" id="exampleInputEmail1" value="{{ $union->designation }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $union->email }}" disabled>
                      </div>

                      <div class="form-group">
                        <label class="">Free Active Date </label>
                          <input onchange="enable_free_expire_date()" class="form-control" name="free_active_date" id="free_active_date"
                            type="text" autocomplete="off" value="{{ $union->free_active_date }}">
                      </div>

                      <div class="form-group" id="charge_type">
                        <label for="exampleInputEmail1">Charge Type</label>
                        <select name="charge_type" class="form-control">
                          <option>Select Charge Type</option>
                          <option {{ ($union->charge_type == 'Monthly') ? 'selected':'' }} value="Monthly">Monthly</option>
                          <option {{ ($union->charge_type == 'Yearly') ? 'selected':'' }} value="Yearly">Yearly</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tax Payer Date </label>
                          <input onchange="enable_tax_payer_date()" class="form-control" name="tax_payer_date" id="tax_payer_date"
                            type="text" autocomplete="off" value="{{ $union->tax_payer_date }}">
                      </div>

                      <div class="form-group">
                        <label for="first_online_charge">First Online Charge</label>
                        <input type="text" name="first_online_charge" class="form-control" id="first_online_charge" value="{{ $union->first_online_charge }}">
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
                              <option {{ ($union->upazilla_id == $upazilla->id) ? 'selected':'' }}  value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
                            @endforeach 
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $union->name }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone no" value="{{ $union->phone }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">NID</label>
                        <input type="text" name="nid" class="form-control" id="exampleInputEmail1" placeholder="Enter NID no" value="{{ $union->nid }}">
                      </div>

                      <div class="form-group">
                        <label class="ol-form-label">Free Expire Date</label>
                          <input class="form-control" name="free_expire_date" id="free_expire_date" type="text" autocomplete="off" placeholder="YY-MM-DD" readonly value="{{ $union->free_expire_date }}">
                      </div>

                      <div class="form-group">
                        <label for="online_charge">Online Charge</label>
                        <input type="text" name="online_charge" class="form-control" id="online_charge" placeholder="Enter Online Charge" value="{{ $union->online_charge }}">
                      </div>

                      <div class="form-group">
                        <label class="">Tax Expire Date</label>
                          <input class="form-control" name="tax_expire_date" id="tax_expire_date" type="text" autocomplete="off" placeholder="YY-MM-DD" readonly value="{{ $union->tax_expire_date }}">
                      </div>

                      <div class="form-group">
                        <label for="renew_charge">Renew Charge</label>
                        <input type="text" name="renew_charge" class="form-control" id="renew_charge" placeholder="Enter Renew Charge" value="{{ $union->renew_charge }}">
                      </div>
                    </div>

                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                  <a href="{{ route('unionParishads.index') }}" class="btn btn-warning" >Cancel</a>
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
    function get_upazill(zilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{route("unionParishads.zilla.upazilla")}}',
        data: {
          zilla_id: zilla_id
        },
        success:function(data) {
            $('#upazilla_section').empty().html(data);
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

    function get_union(upazilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{route("unionParishads.zilla.upazilla.union")}}',
        data: {
          upazilla_id: upazilla_id
        },
        success:function(data) {
            $('#union_section').empty().html(data);
          }
        });
    }

    $('#free_active_date').datepicker({    
      format: "yyyy-mm-dd",
      autoclose: true,
      orientation: "bottom",
      endDate: "today"
    });

    function enable_free_expire_date(){
      $("#free_expire_date").prop( "readonly", false);

      $('#free_expire_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "bottom",
        startDate: $('#free_active_date').val(),
        endDate: "today"
      });
    }

    $('#tax_payer_date').datepicker({   
      format: "yyyy-mm-dd",
      autoclose: true,
      orientation: "bottom",
      endDate: "today"
    });

    function enable_tax_payer_date(){
      $("#tax_expire_date").prop( "readonly", false);

      $('#tax_expire_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "bottom",
        startDate: $('#tax_payer_date').val(),
        endDate: "today"
      });
    }

  </script>
  @endsection 

