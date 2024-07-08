@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Profile</h6>
                    @if (session('user_update'))
                        <div class="alert alert-success">{{ session('user_update') }}</div>
                    @endif
                    <form class="forms-sample" action="{{ route('user.update.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Update Password</h6>

                    @if (session('password_update'))
                        <div class="alert alert-success">{{ session('password_update') }}</div>
                    @endif

                    <form class="forms-sample" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" class="form-control" name="current_password">

                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @if (session('password_wrong'))
                                <div class="text-danger">{{ session('password_wrong') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" name="password">

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">

                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Update Photo</h6>

                    @if (session('photo_update'))
                        <div class="alert alert-success">{{ session('photo_update') }}</div>
                    @endif

                    <form class="forms-sample" action="{{ route('photo.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" class="form-control" name="photo">

                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
