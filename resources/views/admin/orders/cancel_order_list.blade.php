@extends('layouts.admin')
@section('title')
    Order Cancel List
@endsection
@section('content')
    @can('order_cancel_list')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Order Cancel List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Order ID</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($order_cancel_lists as $sl=> $order_cancel_list)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ App\Models\Order::find($order_cancel_list->order_id)->order_id }}</td>
                                    <td>
                                        <a href="{{ route('order.cancel.details', $order_cancel_list->id) }}"
                                            class="text-white btn btn-info">
                                            View </a>
                                        <a href="{{ route('order.cancel.accept', $order_cancel_list->id) }}"
                                            class="text-white btn btn-success">
                                            Accept </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No Order Cancel Lists Found!</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
