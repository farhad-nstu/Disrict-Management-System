@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pouroshava Information</h1>
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
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('pouroshava.store') }}" method="post">
                @csrf 

                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Zilla</label>
                    <select name="zilla_id" class="form-control">
                      <option>Select Zilla</option>
                      @foreach($zillas as $zilla)
                        <option value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
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
              <h3 class="card-title">Pouroshava Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Zilla</th>
                  <th>Pouroshava</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($pouroshavas as $pouroshava)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>
                    @foreach($zillas as $zilla)
                      @if($zilla->id == $pouroshava->zilla_id)
                        {{ $zilla->name }}
                      @endif 
                    @endforeach
                  </td>
                  <td>{{ $pouroshava->name }}</td>
                  <td class="text-center">

                    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_modal{{ $pouroshava->id }}"><i class="fas fa-eye"></i></a>

                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_modal{{ $pouroshava->id }}"><i class="fas fa-edit"></i></a>

                    <a data-toggle="modal" data-target="#delete_modal{{ $pouroshava->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> 

                  </td>
                </tr>

                <!-- Edit form start -->
                <div class="modal fade" id="edit_modal{{ $pouroshava->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Pouroshava</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form action="{{ route('pouroshava.update', $pouroshava->id) }}" method="post">
                          @method('put')
                          @csrf 

                          <div class="row pb-2">
                            <label class="col-sm-4">Zilla</label>
                            <select name="zilla_id" class="col-sm-8 form-control" id="{{ $pouroshava->zilla_id }}">
                              <option>Select Zilla</option>
                              @foreach($zillas as $zilla)
                                <option {{ ($zilla->id == $pouroshava->zilla_id) ? 'selected':'' }} value="{{ $zilla->id }}">{{ $zilla->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="row">
                            <label class="col-sm-4">Name</label>
                            <input type="text" class="col-sm-8 form-control" id="{{ $pouroshava->name }}" name="name" value="{{ $pouroshava->name }}">
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
                <div class="modal fade" id="view_modal{{ $pouroshava->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Pouroshava Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <label class="col-sm-4">Name</label>
                          <p class="col-sm-8">{{ $pouroshava->name }}</p>
                        </div>
                        <div class="row">
                          <label class="col-sm-4">Zilla</label>
                          <p class="col-sm-8">
                            @foreach($zillas as $zilla)
                              @if($zilla->id == $pouroshava->zilla_id)
                                {{ $zilla->name }}
                              @endif
                            @endforeach
                          </p>
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
                <div class="modal fade" id="delete_modal{{ $pouroshava->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      
                      <div class="modal-body">
                        <div class="row pt-2">
                          <h6 class="col-sm-12 font-weight-bold text-danger">Are you sure want to delete {{ $pouroshava->name }} ?</h6>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-1">
                          <a href="{{ route('pouroshava.delete', $pouroshava->id) }}" type="button" class="btn btn-danger btn-sm">Delete</a>
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

