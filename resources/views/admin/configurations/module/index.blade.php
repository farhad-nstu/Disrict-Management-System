@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Module Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Module</li>
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
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('module.store') }}" method="post">
                @csrf 

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter module name">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements disabled -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Module Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Module</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($modules as $module)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $module->name }}</td>
                  <td class="text-center">
                    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_modal{{ $module->id }}"><i class="fas fa-eye"></i></a>
                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_modal{{ $module->id }}"><i class="fas fa-edit"></i></a>
                    <a data-toggle="modal" data-target="#delete_modal{{ $module->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>                    
                  </td>
                </tr>

                <!-- Edit form start -->
                <div class="modal fade" id="edit_modal{{ $module->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Module</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form action="{{ route('module.update', $module->id) }}" method="post">
                          @method('put')
                          @csrf 

                          <div class="row">
                            <label class="col-sm-4">Name</label>
                            <input type="text" class="col-sm-8 form-control" id="{{ $module->name }}" name="name" value="{{ $module->name }}">
                          </div>

                          <div class="row p-2">
                            <div class="col-md-8"></div>

                            <div class="col-sm-2">                              
                              <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>

                            <div class="col-sm-2">                              
                              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                            </div>                          
                          </div>

                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- Edit form end -->

                <!-- View modal -->
                <div class="modal fade" id="view_modal{{ $module->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Module Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <label class="col-sm-4">Name</label>
                          <p class="col-sm-8">{{ $module->name }}</p>
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
                <div class="modal fade" id="delete_modal{{ $module->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      
                      <div class="modal-body">
                        <div class="row pt-2">
                          <h6 class="col-sm-12 font-weight-bold text-danger">Are you sure want to delete {{ $module->name }} ?</h6>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-1">
                          <a href="{{ route('module.delete', $module->id) }}" type="button" class="btn btn-danger btn-sm">Delete</a>
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