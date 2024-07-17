@extends('frontend.master')
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="">Customer Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
    <div class="container">
        <div class="py-5 row">
            <div class="col-lg-3">
                <div class="pt-2 text-center card">
                    @if (Auth::guard('customer')->user()->photo == null)
                        <img class="m-auto" width="70"
                            src="{{ Avatar::create(Auth::guard('customer')->user()->fname . ' ' . Auth::guard('customer')->user()->lname)->toBase64() }}" />
                    @else
                        <img class="m-auto" width="70"
                            src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}"
                            class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ Auth::guard('customer')->user()->fname . ' ' . Auth::guard('customer')->user()->lname }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="py-3 list-group-item bg-light"><a href="" class="text-dark">Profile</a></li>
                        <li class="py-3 list-group-item bg-light"><a href="{{ route('my.orders') }}" class="text-dark">My Order</a></li>
                        <li class="py-3 list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
                        <li class="py-3 list-group-item bg-light"><a href="{{ route('customer.logout') }}"
                                class="text-dark">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Customer Information</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="fname" value="{{ Auth::guard('customer')->user()->fname }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="lname" value="{{ Auth::guard('customer')->user()->lname }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="text" class="form-control" disabled value="{{ Auth::guard('customer')->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ Auth::guard('customer')->user()->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Zip</label>
                                        <input type="number" class="form-control" name="zip" value="{{ Auth::guard('customer')->user()->zip }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ Auth::guard('customer')->user()->address }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Photo</label>
                                        <input type="file" class="form-control" name="photo">
                                        <img src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" width="50">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <button type="submit" class="text-center btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
