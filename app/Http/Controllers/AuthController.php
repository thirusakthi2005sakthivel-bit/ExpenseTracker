<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register Page
    public function register()
    {
        return view('auth.register');
    }

    // Register Store
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default role
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registration Successful. Please Login.');
    }

    // Login Page
    public function login()
    {
        return view('auth.login');
    }

    // Login Process
    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {

                return redirect()->route('dashboard');

            } elseif (Auth::user()->role == 'customer') {

                return redirect()->route('home');

            }

            Auth::logout();

            return redirect()
                ->route('login')
                ->with('error', 'Unauthorized Role');
        }

        return back()
            ->with('error', 'Invalid Email or Password')
            ->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}