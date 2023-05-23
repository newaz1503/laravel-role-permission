@extends('admin.layouts.app')

@section('title','User')

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
          <h1>User List</h1>
          <div>
            @can('user create')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-add"></i>
                    Create User
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
                  <th style="width: 5%">Role</th>
                  <th style="width: 5%">Name</th>
                  <th style="width: 5%">Email</th>

                  <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        @foreach ($user->roles as $role)
                            <td>{{ $role->name ?? '' }}</td>
                        @endforeach

                        <td>{{ $user->name ?? '' }}</td>
                        <td>{{ $user->email ?? '' }}</td>

                        <td>
                            @can('user show')
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('user edit')
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('user delete')
                                <button class="btn btn-danger btn-sm" onclick="confirm('are you sure to delete this user ?!') && document.getElementById('userDelete-{{ $user->id }}').submit()">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="userDelete-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-none">
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

