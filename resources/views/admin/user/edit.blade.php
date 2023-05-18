@extends('layouts.adminbase')

@section('title', 'Edit User: {{$data->name}}')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User: {{$data->name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.user.update',['id'=>$data->id])}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" name="name" value={{$data->name}} required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value={{$data->email}}>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Manage User Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Roles">Roles</label>
                            @foreach ($data->roles as $role)
                                <li>{{$role->name}}
                                <a href="{{route('admin.user.destroyrole',['uid'=>$data->id,'rid'=>$role->id ])}}"
                                   onclick="return confirm('Deleting !! Are you sure ?')">[x]</a>
                                </li>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="AddRoleToUser">Add Role to User</label>
                            <form role="form" action="{{route('admin.user.addrole',['id'=>$data->id])}}" method="post" >
                                @csrf
                                <select name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>

                                    @endforeach
                                </select>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.password.update',['id'=>$data->id])}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password">
                                <x-input-error for="current_password" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="password">New Password</label>
                                <input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password">
                                <x-input-error for="password" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password">
                                <x-input-error for="password_confirmation" class="mt-2" />
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


