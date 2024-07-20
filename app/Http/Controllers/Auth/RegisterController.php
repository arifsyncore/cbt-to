<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $email = User::where('email', $request->email)->get();
        if (count($email)) {
            return redirect()->back()->with('email', 'Email sudah terdaftar');
        }
        $username = User::where('username', $request->username)->get();
        if (count($username)) {
            return redirect()->back()->with('username', 'Username sudah terdaftar');
        }
        $user = User::create([
            'role_id' => 2,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard');
    }
}
