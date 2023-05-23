@extends('admin.layouts.app')

@section('title','Role')

@section("css")
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 d-flex justify-content-between">
          <h1>Role List</h1>
          <div>
            @can('role create')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-add"></i>
                    Create Roll
                </a>
            @endcan

          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%">SI</th>
                  <th style="width: 5%">Name</th>
                  <th style="max-width: 70%">Permission</th>
                  <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key=>$role)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $role->name ?? '' }}</td>
                        @foreach ($role->permissions as $permission)
                            <td style="display:flex; flex-direction:row; flex-wrap: wrap">{{ $permission->name ?? '' }}</td>
                        @endforeach
                        <td>
                            @can('role show')
                                <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('role edit')
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('role delete')
                                <button class="btn btn-danger btn-sm" onclick="confirm('are you sure to delete this role ?!') && document.getElementById('roleDelete-{{ $role->id }}').submit()">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="roleDelete-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="post" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan

                        </td>
                      </tr>
                    @endforeach

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection

@section("script")
  <!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/plugins/')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/jszip/jszip.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/plugins/')}}/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection

