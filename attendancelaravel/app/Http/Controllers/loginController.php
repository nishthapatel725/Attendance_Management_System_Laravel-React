<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    // Handle the login form submission
    // public function postlogin(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Retrieve only email and password from the request
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         return redirect()->route('dashboard')->with('success', 'Login successful!');
    //     }

    //     return redirect()->intended(route('login'))->with('error', 'Login details are not valid!');
    // }
    public function postlogin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {

            $user = Auth::user(); // Get the authenticated user

            if ($user->u_type == 1) {
                return redirect()->route('dashboard')->with('success', 'Login successful!');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Access denied! You are not authorized to enter the dashboard.');
            }
        }

        return redirect()->route('login')->with('error', 'Login details are not valid!');
    }


    // // Handle user logout
    // // public function logout()
    // // {
    // //     Auth::logout();
    // //     return redirect()->route('login')->with('success', 'You have been logged out.');
    // // }

    // public function showLoginForm()
    // {
    //     return view('auth.login'); // Your login view
    // }

    // // Handle login
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Attempt to authenticate the user
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         // Check if user type is 1
    //         if (Auth::user()->u_type === 1) {
    //             // Authentication passed and user type is 1
    //             return redirect()->intended('dashboard'); // Redirect to intended route after login
    //         } else {
    //             // Logout user if u_type is not 1
    //             Auth::logout();
    //             return back()->withErrors([
    //                 'email' => 'You are not authorized to access this system.',
    //             ]);
    //         }
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    // // Handle logout
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     return redirect('/'); // Redirect to the home page after logout
    // }
}


