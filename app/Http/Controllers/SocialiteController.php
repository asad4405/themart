<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    function google_callback()
    {
        $user = Socialite::driver('google')->user();

        if (Customer::where('email', $user->getEmail())->exists()) {
            Auth::guard('customer')->login(Customer::where('email', $user->getEmail())->first());

            return redirect()->route('customer.profile');
        } else {
            $random_password = Str::upper(Str::random(8));
            Customer::create([
                'fname' => $user->getName(),
                'lname' => '',
                'email' => $user->getEmail(),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($random_password),
                'created_at' => Carbon::now(),
            ]);
            if (Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => $random_password])) {
                return redirect()->route('customer.profile');
            } else {
                return "Something Wrong!!";
            }
        }
    }

    function github_redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    function github_callback()
    {
        $user = Socialite::driver('github')->user();

        if(Customer::where('email', $user->getEmail())->exists()){
            Auth::guard('customer')->login(Customer::where('email', $user->getEmail())->first());
            return redirect()->route('customer.profile');
        }else{
            $random_password = Str::upper(Str::random(8));
            Customer::create([
                'fname' => $user->getName(),
                'lname' => '',
                'email' => $user->getEmail(),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($random_password),
                'created_at' => Carbon::now(),
            ]);

            if(Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => $random_password])){
                return redirect()->route('customer.profile');
            }else{
                return 'Something Wrong!';
            }
        }
    }
}
