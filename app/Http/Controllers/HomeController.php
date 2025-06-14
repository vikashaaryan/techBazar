<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home()
    {
        return view('homepage');
    }

    public function register()
    {
        return view('register');
    }

    public function Usreregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'required|string|max:10|unique:users',
            'role' => 'required|in:staff,admin',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('home')->with('success', 'User registered successfully!');
    }

    public function Userlogin(Request $request)
    {
        {
            if ($request->isMethod("post")) {
                $data = $request->validate([
                    "email" => "required|email",
                    "password" => "required",
                ]);
                if (Auth::attempt($data)) {
                    if (Auth::user()->role === 'admin') {
                        return redirect()->route("admin.dashboard");
                    }
                    return redirect()->route("manager.dashboard");
                } else {
                    return redirect()->back();
                }
            }
            return view("homepage");
        }
        

    }
    public function Userlogout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
