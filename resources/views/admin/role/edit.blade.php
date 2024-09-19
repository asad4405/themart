@extends('layouts.admin')
@section('title')
    Role Manager
@endsection
@section('content')
    <div class="row">
        <div class="m-auto col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Role</h3>
                </div>
                <div class="card-body">
                    @if (session('role_success'))
                        <div class="alert alert-success">{{ session('role_success') }}</div>
                    @endif
                    <form action="{{ route('update.role', $role->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="role_name" value="{{ $role->name }}">
                        </div>
                        <div class="mb-3">
                            @foreach ($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <input {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox"
                                        class="form-check-input" id="per{{ $permission->id }}"
                                        value="{{ $permission->name }}" name="permission[]">
                                    <label for="per{{ $permission->id }}"
                                        class="ml-0 form-check-label">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
