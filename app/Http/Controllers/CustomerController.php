<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Models\Order;
use App\Notifications\EmailVerifyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

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

    function customer_email_verify($token)
    {
        if(CustomerEmailVerify::where('token',$token)->exists()){
            $verify_info = CustomerEmailVerify::where('token',$token)->first();

            Customer::find($verify_info->customer_id)->update([
                'email_verified_at' => Carbon::now(),
            ]);

            CustomerEmailVerify::where('token', $token)->delete();
        }else{
            abort('404');
        }

        return redirect()->route('customer.login')->with('verify_email','Email Verified Success!');
    }

    function resend_email_verify()
    {
        return view('frontend.customer.resend_email_verify');
    }

    function resend_link_send(Request $request)
    {
        if(Customer::where('email',$request->email)->exists()){
            $customer_info = Customer::where('email', $request->email)->first();
            CustomerEmailVerify::where('customer_id', $customer_info->id)->delete();
            $info = CustomerEmailVerify::create([
                'customer_id' => $customer_info->id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            Notification::send($customer_info, new EmailVerifyNotification($info));

            return back()->with('customer_success', 'We have sent you verification link, Please verify your Email!');
        }else{
            return back()->with('exists','Email does not Exists!');
        }
    }
}
