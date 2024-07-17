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
                        <li class="py-3 list-group-item bg-light"><a href="{{ route('my.orders') }}" class="text-dark">My
                                Order</a></li>
                        <li class="py-3 list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
                        <li class="py-3 list-group-item bg-light"><a href="{{ route('customer.logout') }}"
                                class="text-dark">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>My Order Lists</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($my_orders as $my_order)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $my_order->order_id }}</td>
                                    <td>{{ $my_order->total }}</td>
                                    <td>{{ $my_order->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($my_order->status == 0)
                                            <span class="badge bg-secondary">Placed</span>
                                        @elseif ($my_order->status == 1)
                                            <span class="badge bg-primary">Processing</span>
                                        @elseif ($my_order->status == 2)
                                            <span class="badge bg-warning">Shipping</span>
                                        @elseif ($my_order->status == 3)
                                            <span class="badge bg-info">Ready For Deliver</span>
                                        @elseif ($my_order->status == 4)
                                            <span class="badge bg-success">Received</span>
                                        @elseif ($my_order->status == 5)
                                            <span class="badge bg-danger">Cancel</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('download.invoice',$my_order->id) }}" class="btn btn-info">
                                            Download Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="" class="text-center text-danger">No Orders Found!</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
