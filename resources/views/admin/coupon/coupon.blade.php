@extends('layouts.admin')
@section('title')
    Coupon
@endsection
@section('content')
    @can('coupon_access')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Coupon List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('coupon_delete'))
                            <div class="alert-success">{{ session('coupon_delete') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Coupon</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Validity</th>
                                <th>Limit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $coupon->coupon }}</td>
                                    <td>{{ $coupon->type == 1 ? 'Percentage' : 'Solid' }}</td>
                                    @if ($coupon->type == 1)
                                        <td>{{ $coupon->amount }}%</td>
                                    @else
                                        <td>{{ $coupon->amount }} Taka</td>
                                    @endif
                                    <td>{{ $coupon->validity }} </td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>
                                        @can('coupon_status')
                                            <a href="{{ route('coupon.status', $coupon->id) }}"
                                                class="btn btn-{{ $coupon->status == 1 ? 'success' : 'secondary' }}">{{ $coupon->status == 1 ? 'Active' : 'Deactive' }}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('coupon_delete')
                                            <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-danger">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">No Coupons Found!</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>

            @can('coupon_add')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Coupon</h3>
                        </div>
                        <div class="card-body">
                            @if (session('coupon_success'))
                                <div class="alert alert-success">{{ session('coupon_success') }}</div>
                            @endif
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Coupon</label>
                                    <input type="text" class="form-control" name="coupon">
                                    @error('coupon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Type</label>
                                    <select name="type" class="form-type">
                                        <option value="">Select Type</option>
                                        <option value="1">Percentage</option>
                                        <option value="2">Solid</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Amount</label>
                                    <input type="text" class="form-control" name="amount">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Validity</label>
                                    <input type="date" class="form-control" name="validity">
                                    @error('validity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Limit</label>
                                    <input type="number" class="form-control" name="limit">
                                    @error('limit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    @endcan
@endsection
