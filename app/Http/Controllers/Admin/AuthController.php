<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:2'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email,'password' => $request->password])) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Login!!!');
        }
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:2|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:2|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('auth.login')->with('success', 'Registered Successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to Register!!!');
        }
    }
}
