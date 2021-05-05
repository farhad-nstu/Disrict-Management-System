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

          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ward Information</h3>
              <a href="{{ route('unionWard.create') }}" class="btn btn-sm btn-primary float-right">Add New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Ward</th>
                  <th>Union</th>
                  <th>Upazilla</th>
                  <th>Zilla</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($wards as $ward)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $ward->name }}</td>
                  <td>{{ $ward->union }}</td>
                  <td>{{ $ward->upazilla }}</td>
                  <td>{{ $ward->zilla }}</td>
                  <td class="text-center">

                    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_modal{{ $ward->id }}"><i class="fas fa-eye"></i></a>

                    <a href="{{ route('unionWard.edit', $ward->id) }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                    <a data-toggle="modal" data-target="#delete_modal{{ $ward->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> 

                  </td>
                </tr>

                <!-- View modal -->
                <div class="modal fade" id="view_modal{{ $ward->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ward Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <label class="col-sm-4">Ward Name</label>
                          <p class="col-sm-8">{{ $ward->name }}</p>
                        </div>
                        <div class="row">
                          <label class="col-sm-4">Ward No</label>
                          <p class="col-sm-8">{{ $ward->ward_no }}</p>
                        </div>
                        <div class="row">
                          <label class="col-sm-4">Union</label>
                          <p class="col-sm-8">{{ $ward->union }}</p>
                        </div>
                        <div class="row">
                          <label class="col-sm-4">Upazilla</label>   
                          <p class="col-sm-8">{{ $ward->upazilla }}</p>          
                        </div>
                        <div class="row">
                          <label class="col-sm-4">Zilla</label>
                          <p class="col-sm-8">{{ $ward->zilla }}</p>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <div class="col-sm-10"></div>
                        <button type="button" class="btn btn-default col-sm-2" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- view modal end -->

                <!-- Delete Modal -->
                <div class="modal fade" id="delete_modal{{ $ward->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      
                      <div class="modal-body">
                        <div class="row pt-2">
                          <h6 class="col-sm-12 font-weight-bold text-danger">Are you sure want to delete {{ $ward->name }} ?</h6>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-1">
                          <a href="{{ route('unionWard.delete', $ward->id) }}" type="button" class="btn btn-danger btn-sm">Delete</a>
                        </div>

                        <div class="col-sm-1">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>

                        <div class="col-sm-2"></div>
                        
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- Delete Modal end -->

                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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

    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
    
    @if(Session::has('message')) 
        toastr.success("{{ Session::get('message') }}");
    @endif

  </script>

  @endsection 

