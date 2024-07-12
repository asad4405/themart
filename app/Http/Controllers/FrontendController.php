<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Offer_one;
use App\Models\Offer_two;
use App\Models\Product;
use App\Models\ProductGrallery;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        $offer_ones = Offer_one::all();
        $offer_twos = Offer_two::all();
        $products = Product::latest()->take(8)->get();
        $trending_products = Product::all();
        $recent_products = Product::latest()->take(3)->get();
        return view('index', [
            'banners' => $banners,
            'categories' => $categories,
            'offer_ones' => $offer_ones,
            'offer_twos' => $offer_twos,
            'products' => $products,
            'trending_products' => $trending_products,
            'recent_products' => $recent_products,
        ]);
    }

    function subscribe_store(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        Subscribe::insert([
            'customer_id' => 1,
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function product_details ($slug)
    {
        $product_id = Product::where('slug',$slug)->first()->id;
        $product = Product::find($product_id);
        $galleries = ProductGrallery::where('product_id',$product->id)->get();
        return view('frontend.product_details',[
            'product' => $product,
            'galleries' => $galleries,
        ]);
    }
}
