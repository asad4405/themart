@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Show Product ({{ $product->product_name }})</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Header</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <td>Product Price</td>
                            <td>{{ $product->product_price }}</td>
                        </tr>
                        <tr>
                            <td>Product Discount (%)</td>
                            <td>{{ $product->discount }}%</td>
                        </tr>
                        <tr>
                            <td>After Discount</td>
                            <td>{{ $product->after_discount }}</td>
                        </tr>
                        <tr>
                            <td>Tags</td>
                            <td>{{ $product->tags }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{!!$product->short_desp!!}</td>
                        </tr>
                        <tr>
                            <td>Long Description</td>
                            <td>{!!$product->long_desp!!}</td>
                        </tr>
                        <tr>
                            <td>Additional Information</td>
                            <td>{!!$product->addi_info!!}</td>
                        </tr>
                        <tr>
                            <td>Preview</td>
                            <td><img src="{{ asset('uploads/product') }}/{{ $product->preview }}" alt=""
                                    width="250"></td>
                            <td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
