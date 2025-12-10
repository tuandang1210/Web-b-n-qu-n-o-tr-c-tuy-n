<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect('/')->with('success', 'Đăng ký thành công!');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();


        if (!$user) {
        return back()->with('error', 'Sai username hoặc password!');
        }

        if (!password_get_info($user->password)['algo']) {
            return back()->with('error', 'Sai username hoặc password!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Sai username hoặc password!');
        }
     
        Session::put('user', $user);

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect(route('customer.homepage'));
    }

    public function logout()
    {
        Session::flush(); 
        return redirect('/');
    }
}
