<?php

namespace App\Http\Controllers;

use App\Models\Stripe as ModelsStripe;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $data = session('data');
        $check = '';
        if (empty($data['ship_check'])) {
            $check = 0;
        } else {
            $check = 1;
        }

        $coupon = '';
        if (empty($data['coupon'])) {
            $coupon = 'NA';
        } else {
            $coupon = $data['coupon'];
        }

        $total = $data['total'] + $data['charge'];

        $stripe_id = ModelsStripe::insertGetId([
            'fname' => $data['fname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'total' => $data['total'],
            'address' => $data['address'],
            'lname' => $data['lname'],
            'country' => $data['country'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'company' => $data['company'],
            'notes' => $data['notes'],
            'ship_fname' => $data['ship_fname'],
            'ship_lname' => $data['ship_lname'],
            'ship_country' => $data['ship_country'],
            'ship_city' => $data['ship_city'],
            'ship_zip' => $data['ship_zip'],
            'ship_company' => $data['ship_company'],
            'ship_email' => $data['ship_email'],
            'ship_phone' => $data['ship_phone'],
            'ship_address' => $data['ship_address'],
            'charge' => $data['charge'],
            'payment_method' => $data['payment_method'],
            'coupon' => $coupon,
            'discount' => $data['discount'],
            'sub_total' => $data['sub_total'],
            'ship_check' => $check,
            'customer_id' => $data['customer_id'],
        ]);

        return view('stripe', [
            'stripe_id' => $stripe_id,
            'total' => $total,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $data = ModelsStripe::find($request->stripe_id);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * $data->total,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $order_id = '#' . random_int(100000, 900000) . '-' . uniqid();

        Order::insert([
            'order_id' => $order_id,
            'customer_id' => $data->customer_id,
            'coupon' => $data->coupon,
            'sub_total' => $data->sub_total,
            'total' => $data->sub_total + $data->charge - $data->discount,
            'discount' => $data->discount,
            'charge' => $data->charge,
            'payment_method' => $data->payment_method,
            'created_at' => Carbon::now(),
        ]);

        Billing::insert([
            'order_id' => $order_id,
            'customer_id' => Auth::guard('customer')->id(),
            'fname' => $data->fname,
            'lname' => $data->lname,
            'country_id' => $data->country,
            'city_id' => $data->city,
            'zip' => $data->zip,
            'company' => $data->company,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'notes' => $data->notes,
            'created_at' => Carbon::now(),
        ]);

        if ($data->ship_check == 1) {

            Shipping::insert([
                'order_id' => $order_id,
                'ship_fname' => $data->ship_fname,
                'ship_lname' => $data->ship_lname,
                'ship_country_id' => $data->ship_country,
                'ship_city_id' => $data->ship_city,
                'ship_zip' => $data->ship_zip,
                'ship_company' => $data->ship_company,
                'ship_email' => $data->ship_email,
                'ship_phone' => $data->ship_phone,
                'ship_address' => $data->ship_address,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Shipping::insert([
                'order_id' => $order_id,
                'ship_fname' => $data->fname,
                'ship_lname' => $data->lname,
                'ship_country_id' => $data->country,
                'ship_city_id' => $data->city,
                'ship_zip' => $data->zip,
                'ship_company' => $data->company,
                'ship_email' => $data->email,
                'ship_phone' => $data->phone,
                'ship_address' => $data->address,
                'created_at' => Carbon::now(),
            ]);
        }

        $carts = Cart::where('customer_id', $data->customer_id)->get();

        foreach ($carts as $cart) {
            OrderProduct::insert([
                'order_id' => $order_id,
                'customer_id' => $data->customer_id,
                'product_id' => $cart->product_id,
                'price' => $cart->product->after_discount,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);

            //  remove cart
            Cart::find($cart->id)->delete();

            // decreament quantity with inventory
            Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
        }
        // decrement coupon limit
        if (Coupon::where('coupon', $data->coupon)->exists()) {
            Coupon::where('coupon', $data->coupon)->decrement('limit');
        }

        Mail::to($data->email)->send(new InvoiceMail($order_id));

        return redirect()->route('order.success')->with('success', $order_id);
    }
}
