@extends('admin.superadmin.master')
  <!-- /.navbar -->
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Union Admin Information</h1>
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

          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Union Admin Information</h3>
              <a href="{{ route('unionParishads.create') }}" class="btn btn-sm btn-primary float-right">Register New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Union</th>
                  <th>Upazilla</th>
                  <th>Zilla</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th class="text-center"  width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($unions as $union)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $union->name }}</td>
                  <td>{{ $union->union }}</td>
                  <td>{{ $union->upazilla }}</td>
                  <td>{{ $union->zilla }}</td>
                  <td>{{ $union->phone }}</td>
                  <td>{{ $union->email }}</td>
                  <td width="15%">

                    <a  href="{{ route('unionParishads.show', $union->id) }}" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                    <a href="{{ route('unionParishads.edit', $union->id) }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                    <a data-toggle="modal" data-target="#delete_modal{{ $union->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> 

                  </td>
                </tr>

                <!-- Delete Modal -->
                <div class="modal fade" id="delete_modal{{ $union->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      
                      <div class="modal-body">
                        <div class="row pt-2">
                          <h6 class="col-sm-12 font-weight-bold text-danger">Are you sure want to delete {{ $union->name }} ?</h6>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-1">
                          <a href="{{ route('unionParishads.delete', $union->id) }}" type="button" class="btn btn-danger btn-sm">Delete</a>
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

