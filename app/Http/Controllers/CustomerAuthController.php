<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    function customer_login()
    {
        return view('frontend.customer.login');
    }

    function customer_register()
    {
        return view('frontend.customer.register');
    }

    function customer_store(CustomerRequest $request)
    {

        $customer_info = Customer::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        CustomerEmailVerify::where('customer_id', $customer_info->id)->delete();
        $info = CustomerEmailVerify::create([
            'customer_id' => $customer_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($customer_info, new EmailVerifyNotification($info));

        return back()->with('customer_success', 'Customer Restered Successfully, Please Verify your Email!');
    }

    function customer_logged(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Customer::where('email', $request->email)->exists()) {
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::guard('customer')->user()->email_verified_at == null) {
                    return redirect()->route('customer.login')->with('verify', 'Please Verify your Account!');
                } else {
                    return redirect()->route('customer.profile');
                }
            } else {
                return back()->with('wrong', 'Wrong Credential!');
            }
        } else {
            return back()->with('exists', 'Email Does not exists!');
        }
    }
}
