@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Users Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" data-toggle="modal" data-target="#newuser-modal"> Create New User</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Permissions</th>
                <th>Action</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @foreach($user->roles as $role)
                        <td>{{$role->name}}</td>
                    @endforeach

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                permissions
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                @foreach($user->roles as $roles_with_permissions)
                                    @foreach($roles_with_permissions->permissions as $permissions)
                                        <li><a href="#">{{$permissions->name}}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info" href="">Show</a>
                        <a class="btn btn-primary" href="">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
        @include('admin.new-user-modal')
    </div>
@endsection
