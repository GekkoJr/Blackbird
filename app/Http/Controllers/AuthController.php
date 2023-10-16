<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // this controller can handle auth if needed
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:user|email',
            'username' => 'required|unique:user|alpha_num|between:3,50',
            'password' => 'required',
            'display_name' => 'required',
        ]);

        $user = new User;
        $user->username = $validated['username'];
        $user->password = Hash::make($validated['password']);
        $user->email = $validated['email'];
        $user->display_name = $validated['display_name'];
        $user->save();

    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            return redirect(route('home'));
        }

        return back()->withErrors([
            'email' => 'your email or password is incorecct',
        ]);
    }
}
