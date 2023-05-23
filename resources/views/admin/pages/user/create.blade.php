@extends('admin.layouts.app')

@section('title','User')

@section("css")

@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create New User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
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
            <form method="post" action="{{ route('admin.users.store') }}">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter User Name">
                  @if($errors->has('name'))
                     <div class="error text-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">User Role</label>
                    <select class="form-control" name="role">
                        <option value="" selected disabled style="display:none">Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{ $role->name }}</option>
                        @endforeach

                    </select>
                    @if($errors->has('role'))
                       <div class="error text-danger">{{ $errors->first('role') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">User Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter User Email">
                    @if($errors->has('email'))
                       <div class="error text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">User Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter User Password">
                    @if($errors->has('password'))
                       <div class="error text-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password ">
                    @if($errors->has('password_confirmation'))
                       <div class="error text-danger">{{ $errors->first('password_confirmation') }}</div>
                    @endif
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

@endsection

