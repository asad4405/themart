<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function checkout()
    {
        $countries = Country::all();
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.checkout', [
            'carts' => $carts,
            'countries' => $countries,
        ]);
    }

    function getcity(Request $request)
    {
        $str = '<option value="">Select City*</option>';
        $cities = City::where('country_id', $request->country_id)->get();

        foreach ($cities as $city) {
            $str .= '<option value=' . $city->id . '>' . $city->name . '</option>';
        }
        echo $str;
    }

    function order_store(Request $request)
    {
        if ($request->payment_method == 1) {
            $order_id = '#' . random_int(100000, 900000) . '-' . uniqid();

            Order::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'coupon' => session('S_coupon'),
                'sub_total' => $request->total + $request->discount,
                'total' => $request->total + $request->charge,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),
            ]);

            Billing::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'country_id' => $request->country,
                'city_id' => $request->city,
                'zip' => $request->zip,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'created_at' => Carbon::now(),
            ]);

            if ($request->ship_check == 1) {
                $request->validate([
                    //
                ]);

                Shipping::insert([
                    'order_id' => $order_id,
                    'ship_fname' => $request->ship_fname,
                    'ship_lname' => $request->ship_lname,
                    'ship_country_id' => $request->ship_country,
                    'ship_city_id' => $request->ship_city,
                    'ship_zip' => $request->ship_zip,
                    'ship_company' => $request->ship_company,
                    'ship_email' => $request->ship_email,
                    'ship_phone' => $request->ship_phone,
                    'ship_address' => $request->ship_address,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                Shipping::insert([
                    'order_id' => $order_id,
                    'ship_fname' => $request->fname,
                    'ship_lname' => $request->lname,
                    'ship_country_id' => $request->country,
                    'ship_city_id' => $request->city,
                    'ship_zip' => $request->zip,
                    'ship_company' => $request->company,
                    'ship_email' => $request->email,
                    'ship_phone' => $request->phone,
                    'ship_address' => $request->address,
                    'created_at' => Carbon::now(),
                ]);
            }

            $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'price' => $cart->product->after_discount,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);

                //  remove cart
                // Cart::find($cart->id)->delete();

                // decreament quantity with inventory
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }

            Mail::to($request->email)->send(new InvoiceMail($order_id));

            return redirect()->route('order.success')->with('success', $order_id);
        } elseif ($request->payment_method == 2) {
            // SSL
        } elseif ($request->payment_method == 3) {
            // Stripe
        }
    }

    function order_success()
    {
        return view('frontend.customer.order_success');
    }
}
