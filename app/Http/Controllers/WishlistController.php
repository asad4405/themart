<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    function wishlist()
    {
        $wishlists = Wishlist::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.wishlist', compact('wishlists'));
    }

    function add_wishlist(Request $request)
    {
        if (Wishlist::where([
            'customer_id' => Auth::guard('customer')->id(),
            'product_id' => $request->product_id,
        ])->exists()) {
            return redirect()->route('wishlist')->with('exists', 'Already Wishlist Product Added!');
        } else {
            Wishlist::insert([
                'customer_id' => Auth::guard('customer')->id(),
                'product_id' => $request->product_id,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('wishlist');
        };
    }

    function delete_wishlist($id)
    {
        Wishlist::where('id', $id)->delete();
        return back();
    }
}
