<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    function customer_profile()
    {
        return view('frontend.customer.profile');
    }

    function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('success', 'Logged Out Successfully!');
    }

    function customer_profile_update(Request $request)
    {
        if ($request->password == '') {
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                ]);
                return back();
            } else {
                if (Auth::guard('customer')->user()->photo != null) {
                    $current = public_path('uploads/customer/' . Auth::guard('customer')->user()->photo);
                    unlink($current);
                }

                $photo = $request->photo;
                $extension = $photo->extension();
                $file_name = Auth::guard('customer')->id() . '.' . $extension;
                Image::make($photo)->save(public_path('uploads/customer/' . $file_name));

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $file_name
                ]);
                return back();
            }
        } else {
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                ]);
                return back();
            } else {

                if (Auth::guard('customer')->user()->photo != null) {
                    $current = public_path('uploads/customer/' . Auth::guard('customer')->user()->photo);
                    unlink($current);
                }

                $photo = $request->photo;
                $extension = $photo->extension();
                $file_name = Auth::guard('customer')->id() . '.' . $extension;
                Image::make($photo)->save(public_path('uploads/customer/' . $file_name));

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $file_name
                ]);
                return back();
            }
        }
    }

    function my_orders()
    {
        $my_orders = Order::where('customer_id', Auth::guard('customer')->id())->latest()->get();
        return view('frontend.customer.my_orders', compact('my_orders'));
    }

    function download_invoice($id)
    {
        $order_id  = Order::find($id)->order_id;
        $pdf = Pdf::loadView('frontend.customer.pdf.order_invoice', compact('order_id'));
        return $pdf->download('invoice.pdf');
    }
}
