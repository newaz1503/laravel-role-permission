@extends('admin.layouts.app')

@section('title','Role')

@section("css")

@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create New Role</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Role</li>
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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('admin.roles.store') }}">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Role Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name">
                  @if($errors->has('name'))
                     <div class="error text-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Permission</label>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="AllPermission">
                        <label class="form-check-label" for="AllPermission">SelectAll</label>
                    </div>
                    <hr>

                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="checkPermission{{ $permission->id }}">
                            <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>


              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section("script")
    <script>
        $('#AllPermission').on('click', function(){
            if($(this).is(':checked')){
                $('input[type=checkbox]').prop('checked', true)
            }else{
                $('input[type=checkbox]').prop('checked', false)
            }
        });
    </script>
@endsection

