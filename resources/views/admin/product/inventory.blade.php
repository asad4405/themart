@extends('layouts.admin')
@section('title')
    Inventory
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory for, <strong>{{ $product->product_name }}</strong></h3>
                </div>
                <div class="card-body">
                    @if (session('inventory_delete'))
                        <div class="alert alert-success">{{ session('inventory_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($inventories as $sl=> $inventory)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $inventory->color->color_name }}</td>
                                <td>{{ $inventory->size->size_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    <a href="{{ route('inventory.delete', $inventory->id) }}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-danger text-center">No Inventory Found!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Inventory</h3>
                </div>
                <div class="card-body">
                    @if (session('invetory_success'))
                        <div class="alert alert-success">{{ session('inventory_success') }}</div>
                    @endif
                    <form action="{{ route('inventory.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" class="form-control" value="{{ $product->product_name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Color</label>
                            <select name="color_id" id="" class="form-select">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Size</label>
                            <select name="size_id" id="" class="form-select">
                                <option value="">Select Size</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
