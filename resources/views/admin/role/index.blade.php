@extends('layouts.admin')
@section('title')
    Role Manager
@endsection
@section('content')
    @can('role_access')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Role List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('delete_role'))
                            <div class="alert alert-success">{{ session('delete_role') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-wrap">
                                        @foreach ($role->getPermissionNames() as $permission)
                                            <span class="my-2 badge badge-primary">{{ $permission }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.role', $role->id) }}" class="btn btn-info btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a href="{{ route('delete.role', $role->id) }}" class="btn btn-danger btn-icon">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-header">
                        <h3>User List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('delete_role'))
                            <div class="alert alert-success">{{ session('delete_role') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-wrap">
                                        @forelse ($user->getRoleNames() as $role)
                                            <span class="my-2 badge badge-primary">{{ $role }}</span>
                                        @empty
                                            <span class="my-2 badge badge-secondary">
                                                <p>Not Assigned</p>
                                            </span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <a href="{{ route('remove.role', $user->id) }}" class="btn btn-danger">
                                            Remove Role
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add New Permission</h3>
                    </div>
                    <div class="card-body">
                        @if (session('permission_success'))
                            <div class="alert alert-success">{{ session('permission_success') }}</div>
                        @endif
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Permission Name</label>
                                <input type="text" class="form-control" name="permission_name">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add Permission</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 card">
                    <div class="card-header">
                        <h3>Assign Role</h3>
                    </div>
                    <div class="card-body">
                        @if (session('assign_role'))
                            <div class="alert alert-success">{{ session('assign_role') }}</div>
                        @endif
                        <form action="{{ route('assign.role') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <select name="user_id" class="form-select">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="role" class="form-select">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Assign Role</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 card">
                    <div class="card-header">
                        <h3>Add New Role</h3>
                    </div>
                    <div class="card-body">
                        @if (session('role_success'))
                            <div class="alert alert-success">{{ session('role_success') }}</div>
                        @endif
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role_name">
                            </div>
                            <div class="mb-3">
                                @foreach ($permissions as $permission)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="per{{ $permission->id }}"
                                            value="{{ $permission->name }}" name="permission[]">
                                        <label for="per{{ $permission->id }}"
                                            class="ml-0 form-check-label">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
