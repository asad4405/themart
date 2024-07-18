@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Orders</h3>
                </div>
                <div class="card-header">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-secondary">Placed</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge bg-primary">Processing</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge bg-warning">Shipping</span>
                                    @elseif ($order->status == 3)
                                        <span class="badge bg-info">Ready For Deliver</span>
                                    @elseif ($order->status == 4)
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($order->status == 5)
                                        <span class="badge bg-danger">Cancel</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('order.status.update', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                                aria-expanded="false">
                                                Change Status </button>
                                            <div class="dropdown-menu">
                                                <button name="status" value="0"
                                                    style="background: #{{ $order->status == 0 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Placed</button>
                                                <button name="status" value="1"
                                                    style="background: #{{ $order->status == 1 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Processing</button>
                                                <button name="status" value="2"
                                                    style="background: #{{ $order->status == 2 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Shipping</button>
                                                <button name="status" value="3"
                                                    style="background: #{{ $order->status == 3 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Ready For Deliver</button>
                                                <button name="status" value="4"
                                                    style="background: #{{ $order->status == 4 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Delivered</button>
                                                <button name="status" value="5"
                                                    style="background: #{{ $order->status == 5 ? 'ddd' : '' }}"
                                                    class="dropdown-item">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
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
@endsection
