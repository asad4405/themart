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
                            <li><a href="index.html">Home</a></li>
                            <li><a href="product.html">Product Page</a></li>
                            <li>Cart</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- cart-area-s2 start -->
    <div class="cart-area-s2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Cart</h2>
                        <p>There are {{ $carts->count() }} products in this list</p>
                    </div>
                </div>
            </div>
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <div class="cart-item">
                                <table class="table-responsive cart-wrap">
                                    <thead>
                                        <tr>
                                            <th class="images images-b">Product</th>
                                            <th class="ptice">Price</th>
                                            <th class="stock">Quantity</th>
                                            <th class="ptice total">Subtotal</th>
                                            <th class="remove remove-b">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sub_total = 0;
                                        @endphp
                                        @forelse ($carts as $cart)
                                            <tr class="wishlist-item">
                                                <td class="product-item-wish">
                                                    <div class="check-box"><input type="checkbox"
                                                            class="myproject-checkbox">
                                                    </div>
                                                    <div class="images">
                                                        <span>
                                                            <img src="{{ asset('uploads/product') }}/{{ $cart->product->preview }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <div class="product">
                                                        <ul>
                                                            <li class="first-cart">{{ $cart->product->product_name }}</li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <span>130</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="ptice cartabc">{{ $cart->product->after_discount }} Taka</td>
                                                <td class="td-quantity cartabc">
                                                    <div class="quantity">
                                                        <input class="text-value quan" type="text"
                                                            value="{{ $cart->quantity }}"
                                                            name="quantity[{{ $cart->id }}]">
                                                        <div data-price="{{ $cart->product->after_discount }}" class="dec qtybutton">-</div>
                                                        <div data-price="{{ $cart->product->after_discount }}"
                                                            class="inc qtybutton">+</div>
                                                    </div>
                                                </td>
                                                <td class="ptice cartabc">
                                                    {{ $cart->product->after_discount * $cart->quantity }}
                                                    Taka</td>
                                                <td class="action">
                                                    <ul>
                                                        <li class="w-btn"><a href="{{ route('cart.remove', $cart->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-html="true" title=""
                                                                href="" data-bs-original-title="Remove from Cart"
                                                                aria-label="Remove from Cart"><i
                                                                    class="fi ti-trash"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @php
                                                $sub_total += $cart->product->after_discount * $cart->quantity;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="alert alert-info">
                                                        <h4 class="text-center">Cart is Empty!</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $sub_total += $cart->product->after_discount * $cart->quantity;
                                            @endphp
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            <div class="cart-action">
                                <button type="submit" class="border-0 theme-btn-s2"><i class="fi flaticon-refresh"></i>
                                    Update
                                    Cart</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="mb-4 apply-area">
                            <input type="text" class="form-control" placeholder="Enter your coupon">
                            <button class="theme-btn-s2" type="submit">Apply</button>
                        </div>
                        <div class="cart-total-wrap">
                            <h3>Cart Totals</h3>
                            <div class="sub-total">
                                <h4>Subtotal</h4>
                                <span>{{ $sub_total }} Taka</span>
                            </div>
                            <div class="my-3 sub-total">
                                <h4>Discount</h4>
                                <span>00.00</span>
                            </div>
                            <div class="mb-3 total">
                                <h4>Total</h4>
                                <span>$300.00</span>
                            </div>
                            <a class="theme-btn-s2" href="checkout.html">Proceed To CheckOut</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-prodact">
                <h2>You May be Interested in…</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/1.png" alt="">
                                <div class="tag new">New</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Wireless Headphones</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>130</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$120.00</span>
                                    <del class="old-price">$200.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/2.png" alt="">
                                <div class="tag sale">Sale</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Blue Bag with Lock</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>120</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$160.00</span>
                                    <del class="old-price">$190.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/3.png" alt="">
                                <div class="tag new">New</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Stylish Pink Top</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>150</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$150.00</span>
                                    <del class="old-price">$200.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/4.png" alt="">
                                <div class="tag sale">Sale</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Brown Com Boots</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>120</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$120.00</span>
                                    <del class="old-price">$150.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection

@section('footer_script')
    <script>
        $('.inc').click(function() {
            var td = document.getElementsByClassName('cartabc');
            var array = Array.from(td);
            array.map((item) => {
                item.addEventListener('click', function(e) {
                    if (e.target.className == 'inc qtybutton') {
                        var price = e.target.dataset.price;
                        var quantity = e.target.parentElement.firstElementChild.value;
                        var sub = price * quantity;
                        var sub_total = item.nextElementSibling.innerHTML = sub + ' Taka';
                    }
                    if (e.target.className == 'dec qtybutton') {
                        var price = e.target.dataset.price;
                        var quantity = e.target.parentElement.firstElementChild.value;
                        var sub = price * quantity;
                        var sub_total = item.nextElementSibling.innerHTML = sub + ' Taka';
                    }
                })
            });
        });
    </script>
@endsection
