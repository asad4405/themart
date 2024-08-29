@extends('frontend.master')
@section('title')
    Wishlist
@endsection
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            {{ Breadcrumbs::render('wishlist') }}
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- cart-area start -->
    <div class="cart-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Wishlist</h2>
                        <p>There are {{ $wishlists->count() }} products in this list</p>
                    </div>
                </div>
            </div>
            @if (session('exists'))
                <div class="alert alert-danger">{{ session('exists') }}</div>
            @endif
            <div class="form">
                <div class="cart-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <form action="https://wpocean.com/html/tf/themart/cart">
                                <table class="table-responsive cart-wrap">
                                    <thead>
                                        <tr>
                                            <th class="images images-b">Product</th>
                                            <th class="ptice">Price</th>
                                            <th class="stock">Stock Status</th>
                                            <th class="remove remove-b">Action</th>
                                            <th class="remove remove-b">Remove</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($wishlists as $wishlist)
                                            <tr class="wishlist-item">
                                                <td class="product-item-wish">
                                                    <div class="check-box"><input type="checkbox"
                                                            class="myproject-checkbox">
                                                    </div>
                                                    <div class="images">
                                                        <span>
                                                            <img src="{{ asset('uploads/product') }}/{{ $wishlist->product->preview }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <div class="product">
                                                        <ul>
                                                            <li class="first-cart">{{ $wishlist->product->product_name }}
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    @php
                                                                        $reviews = App\Models\OrderProduct::where(
                                                                            'product_id',
                                                                            $wishlist->product->id,
                                                                        )
                                                                            ->whereNotNull('review')
                                                                            ->get();
                                                                    @endphp
                                                                    @if ($reviews->count())
                                                                        @for ($i = 1; $i <= $reviews->average('star'); $i++)
                                                                            <i class="fi flaticon-star"></i>
                                                                        @endfor
                                                                        @for ($i = 1; $i <= 5 - $reviews->average('star'); $i++)
                                                                            <i class="fa fa-star-o"></i>
                                                                        @endfor
                                                                        <span>{{ $reviews->count() }}</span>
                                                                    @else
                                                                        <p>No reviews</p>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="ptice">{{ $wishlist->product->after_discount }} Taka</td>
                                                <td class="stock"><span class="in-stock">-</span></td>
                                                {{-- <td class="stock"><span class="in-stock out-stock">-</span></td> --}}
                                                <td class="add-wish">
                                                    <a class="theme-btn-s2"
                                                        href="{{ route('product_details', $wishlist->product->slug) }}">Shop
                                                        Now</a>
                                                </td>
                                                <td class="action">
                                                    <ul>
                                                        <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                                title=""
                                                                href="{{ route('delete.wishlist', $wishlist->id) }}"
                                                                data-bs-original-title="Remove" aria-label="Remove"><i
                                                                    class="fi flaticon-remove"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">No Wishlist Products
                                                    Available!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
