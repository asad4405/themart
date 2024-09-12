@extends('frontend.master')
@section('title')
    Cancel Order
@endsection
@section('content')
    <div class="py-5 row">
        <div class="m-auto col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Order Cancel Request</h3>
                    <h4 class="text-white bg-info d-inline-block">Order ID: {{ $order->order_id }}</h4>
                </div>
                <div class="card-body">
                    @if (session('req'))
                        <div class="alert alert-success">{{ session('req') }}</div>
                    @endif
                    <form action="{{ route('cancel.order.request', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Cancel Reason</label>
                            <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn-primary">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
