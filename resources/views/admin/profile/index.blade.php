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

            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3 class="card-title">User Profile</h3>
                  </div>
                  <div class="col-sm-6 text-right">
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>&nbsp;&nbsp;
                    <a href="{{ route(Auth::user()->role.'.dashboard') }}" class="btn btn-sm btn-primary">Back</a>
                  </div>
                </div>              
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                  <div class="col-md-7">

                    <div class="row">
                      <label class="col-sm-6">Name</label>
                      <h6 class="col-sm-6">{{ $user->name }}</h6>
                    </div>

                    <div class="row">
                      <label class="col-sm-6">Designation</label>
                      <h6 class="col-sm-6">{{ $user->designation }}</h6>
                    </div>

                    <div class="row">
                      <label class="col-sm-6">Phone</label>
                      <h6 class="col-sm-6">{{ $user->phone }}</h6>
                    </div>

                    <div class="row">
                      <label class="col-sm-6">Email</label>
                      <h6 class="col-sm-6">{{ $user->email }}</h6>
                    </div>

                    <div class="row">
                      <label class="col-sm-6">NID</label>
                      <h6 class="col-sm-6">{{ $user->nid }}</h6>
                    </div>

                    @if(! empty($user->zilla_id))
                    <div class="row">
                      <label class="col-sm-6">Zilla</label>
                      <h6 class="col-sm-6">
                        @foreach($zillas as $zilla)
                          @if($zilla->id == $user->zilla_id)
                            {{ $zilla->name }}
                          @endif 
                        @endforeach
                      </h6>
                    </div>
                    @endif 

                    @if(! empty($user->upazilla_id))
                    <div class="row">
                      <label class="col-sm-6">Upazilla</label>
                      <h6 class="col-sm-6">
                        @foreach($upazillas as $upazilla)
                          @if($upazilla->id == $user->upazilla_id)
                            {{ $upazilla->name }}
                          @endif 
                        @endforeach
                      </h6>
                    </div>
                    @endif 

                    @if(! empty($user->pouroshava_id))
                    <div class="row">
                      <label class="col-sm-6">Upazilla</label>
                      <h6 class="col-sm-6">
                        @foreach($pouroshavas as $pouroshava)
                          @if($pouroshava->id == $user->pouroshava_id)
                            {{ $pouroshava->name }}
                          @endif 
                        @endforeach
                      </h6>
                    </div>
                    @endif 

                    @if(! empty($user->free_active_date))
                      <div class="row">
                        <label class="col-sm-6">Activity Date(free)</label>
                        <h6 class="col-sm-6">{{ $user->free_active_date }}</h6>
                      </div>
                    @endif 

                    @if(! empty($user->charge_type))
                      <div class="row">
                        <label class="col-sm-6">Charge Type</label>
                        <h6 class="col-sm-6">{{ $user->charge_type }}</h6>
                      </div>
                    @endif 

                    @if(! empty($user->tax_payer_date))
                      <div class="row">
                        <label class="col-sm-6">Tax Payer Date</label>
                        <h6 class="col-sm-6">{{ $user->tax_payer_date }}</h6>
                      </div>
                    @endif

                    @if(! empty($user->first_online_charge))
                      <div class="row">
                        <label class="col-sm-6">First Online Charge</label>
                        <h6 class="col-sm-6">{{ $user->first_online_charge }}</h6>
                      </div>
                    @endif

                    @if(! empty($user->office_logo))
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
                    @endif 

                  </div>

                  <div class="col-md-5">

                    <div class="row">
                      <div class="col-sm-6">
                      </div>
                      <div class="form-group col-sm-6">
                        <img width="120px" height="110px" src="{{ asset($user->user_picture) }}">
                      </div>
                    </div>

                    @if(! empty($user->office_type))
                      <div class="row">
                        <label class="col-sm-6">Office Type</label>
                        <h6 class="col-sm-6">{{ $user->office_type }}</h6>
                      </div>
                    @endif 

                    @if(! empty($user->post_code))
                      <div class="row">
                        <label class="col-sm-6">Post Code</label>
                        <h6 class="col-sm-6">{{ $user->post_code }}</h6>
                      </div>
                    @endif 

                    @if(! empty($user->union_id))
                    <div class="row">
                      <label class="col-sm-6">Union</label>
                      <h6 class="col-sm-6">
                        @foreach($unions as $union)
                          @if($union->id == $user->union_id)
                            {{ $union->name }}
                          @endif 
                        @endforeach
                      </h6>
                    </div>
                    @endif

                    @if(! empty($user->free_expire_date))
                      <div class="row">
                        <label class="col-sm-6">Activity Expire Date</label>
                        <h6 class="col-sm-6">{{ $user->free_expire_date }}</h6>
                      </div>
                    @endif 

                    @if(! empty($user->online_charge))
                      <div class="row">
                        <label class="col-sm-6">Online Charge</label>
                        <h6 class="col-sm-6">{{ $user->online_charge }}</h6>
                      </div>
                    @endif

                    @if(! empty($user->tax_expire_date))
                      <div class="row">
                        <label class="col-sm-6">Tax Expire Date</label>
                        <h6 class="col-sm-6">{{ $user->tax_expire_date }}</h6>
                      </div>
                    @endif

                    @if(! empty($user->renew_charge))
                      <div class="row">
                        <label class="col-sm-6">Renew Charge</label>
                        <h6 class="col-sm-6">{{ $user->renew_charge }}</h6>
                      </div>
                    @endif

                  </div>
                </div>                
              </div>
            </div>

            <!-- Password Change -->
            <div class="row">
              <div class="col-sm-6">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                  </div>

                  <form role="form" action="{{ route('profile.password.update', $user->id) }}" method="post" enctype="multipart/form-data">
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
              </div>
              <div class="col-sm-6"></div>
            </div>
            
              <!-- Password change end -->
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