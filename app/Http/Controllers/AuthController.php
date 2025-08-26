<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index()
    {
        if(!empty(Auth::check()))
        {
            return redirect('dashboard');
        }

        // dd(Hash::make('golden123'));
         
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response("INVALID LOGIN DETAILS!|error");
            }

            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();

                return response("LOGIN WAS SUCCESSFUL|success");
            } else {
                return response("Invalid login details|error");
            }
        }

        // If not AJAX, return the login view
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        $notification = array(
            'message' => 'You have Successfully Logout of the system',
            'alert-type' => 'info'
        );

        return redirect(url('login'))->with($notification);


    }
}
