@extends('admin.layouts.app')

@section('title','Role')

@section("css")
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
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
            <form method="post" action="{{ route('admin.roles.update', $role->id) }}">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Role Name</label>
                  <input type="text" name="name" value="{{ $role->name ?? '' }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name">
                  @if($errors->has('name'))
                     <div class="error text-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div>
                    <label for="exampleInputEmail1">Permission</label>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="AllPermission" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                        <label class="form-check-label" for="AllPermission">SelectAll</label>
                    </div>
                    <hr>
                    @php $i = 1; @endphp
                    @foreach ($groupNames as $groupName)
                        <div class="row">
                            @php
                                $permissions = App\Models\User::getPermissionByGroupName($groupName->name);
                                $j = 1;
                             @endphp
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $i }}management" onclick="checkPermissionByGroup('rolewise-{{ $i }}-permission', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $i }}management">{{ $groupName->name }}</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-9 rolewise-{{ $i }}-permission">

                                 @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} class="form-check-input" id="checkPermission{{ $permission->id }}">
                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @php $j++ @endphp

                                @endforeach
                                <br>
                            </div>

                        </div>
                        @php $i++ @endphp
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

        function checkPermissionByGroup(classname, element){
            const groupIdName = $("#"+element.id);
            const groupNameWisePermissionInput = $('.'+classname+' input');
            if(groupIdName.is(':checked')){
                groupNameWisePermissionInput.prop('checked', true)
            }else{
                groupNameWisePermissionInput.prop('checked', false)
            }

        }
    </script>
@endsection

