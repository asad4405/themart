<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('index'));
});

// Home > Product Details
Breadcrumbs::for('product_details', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Product Details', route('product_details', ''));
});

// Home > Shop
Breadcrumbs::for('shop', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Shop', route('shop'));
});

// Home > Cart
Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Cart', route('cart'));
});

// Home > Checkout
Breadcrumbs::for('checkout', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Checkout', route('checkout'));
});

// Home > Checkout
Breadcrumbs::for('recent.view', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Recent Viewed', route('recent.view'));
});

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });
