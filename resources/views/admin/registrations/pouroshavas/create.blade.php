@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pouroshava Admin Registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pouroshava</li>
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
                <h3 class="card-title">Pouroshava Admin Registration</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('pouroAdmin.store') }}" method="post" enctype="multipart/form-data">
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
                            <option {{ (old('zilla_id') == $zilla->id) ? 'selected':'' }} value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                          @endforeach
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
                        <label class="">Free Active Date </label>
                          <input onchange="enable_free_expire_date()" class="form-control" name="free_active_date" id="free_active_date"
                            type="text" autocomplete="off" placeholder="YY-MM-DD" value="{{ old('free_active_date') }}">
                      </div>

                      <div class="form-group" id="charge_type">
                        <label for="exampleInputEmail1">Charge Type</label>
                        <select name="charge_type" class="form-control">
                          <option>Select Charge Type</option>
                          <option {{ (old('charge_type') == 'Monthly') ? 'selected':'' }} value="Monthly">Monthly</option>
                          <option {{ (old('charge_type') == 'Yearly') ? 'selected':'' }} value="Yearly">Yearly</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tax Payer Date </label>
                          <input onchange="enable_tax_payer_date()" class="form-control" name="tax_payer_date" id="tax_payer_date"
                            type="text" autocomplete="off" placeholder="YY-MM-DD" value="{{ old('tax_payer_date') }}">
                      </div>

                      <div class="form-group">
                        <label for="first_online_charge">First Online Charge</label>
                        <input type="text" name="first_online_charge" class="form-control" id="first_online_charge" placeholder="Enter First Online Charge" value="{{ old('first_online_charge') }}">
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
                      <div class="form-group" id="pouroshava_section">
                        <label for="exampleInputEmail1">Pouroshava</label>
                        <select name="pouroshava_id" class="form-control">
                          @if(! empty(old('pouro_id')))
                            @foreach($pouroshavas as $pouroshava)
                              <option {{ (old('pouro_id') == $pouroshava->id) ? 'selected':'' }}  value="{{ $pouroshava->id }}">{{ $pouroshava->name }}</option>
                            @endforeach 
                          @else 
                            <option>Select Pouroshava</option>
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

                      <div class="form-group">
                        <label class="ol-form-label">Free Expire Date</label>
                          <input class="form-control" name="free_expire_date" id="free_expire_date" type="text" autocomplete="off" placeholder="YY-MM-DD" readonly value="{{ old('free_expire_date') }}">
                      </div>

                      <div class="form-group">
                        <label for="online_charge">Online Charge</label>
                        <input type="text" name="online_charge" class="form-control" id="online_charge" placeholder="Enter Online Charge" value="{{ old('online_charge') }}">
                      </div>

                      <div class="form-group">
                        <label class="">Tax Expire Date</label>
                          <input class="form-control" name="tax_expire_date" id="tax_expire_date" type="text" autocomplete="off" placeholder="YY-MM-DD" readonly value="{{ old('tax_expire_date') }}">
                      </div>

                      <div class="form-group">
                        <label for="renew_charge">Renew Charge</label>
                        <input type="text" name="renew_charge" class="form-control" id="renew_charge" placeholder="Enter Renew Charge" value="{{ old('renew_charge') }}">
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
    function get_pouroshava(zilla_id) {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: "post",
        url : '{{route("pouroAdmin.zilla.pouroshava")}}',
        data: {
          zilla_id: zilla_id
        },
        success:function(data) {
            $('#pouroshava_section').empty().html(data);
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

