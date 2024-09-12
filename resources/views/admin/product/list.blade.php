@extends('layouts.admin')
@section('title')
    Product List
@endsection
@section('content')
    @can('product_access')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Product List</h3>
                        <a href="{{ route('add.product') }}" class="btn btn-primary"><i data-feather="plus"></i>Add New Product</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>After Discount</th>
                                <th>Preview</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($products as $sl=> $product)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>{{ $product->after_discount }}</td>
                                    <td><img src="{{ asset('uploads/product') }}/{{ $product->preview }}" alt=""
                                            width="50"></td>
                                    <td></td>
                                    <td>
                                        @can('product_inventory')
                                            <a href="{{ route('add.inventory', $product->id) }}" class="btn btn-info btn-icon">
                                                <i data-feather="layers"></i>
                                            </a>
                                        @endcan
                                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-icon">
                                            <i data-feather="eye"></i>
                                        </a>
                                        @can('product_delete')
                                            <a href="" class="btn btn-danger btn-icon">
                                                <i data-feather="trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
