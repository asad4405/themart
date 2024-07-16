<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        Customer::insert([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('customer_success', 'Customer Restered Successfully!');
    }

    function customer_logged(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Customer::where('email', $request->email)->exists()) {
            if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('customer.profile');
            }else{
                return back()->with('wrong', 'Wrong Credential!');
            }
        } else {
            return back()->with('exists', 'Email Does not exists!');
        }
    }

}
