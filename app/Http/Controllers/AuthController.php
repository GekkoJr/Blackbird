<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // this controller handles auth
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|alpha_num|between:3,50',
            'password' => 'required',
            'verify_password' => 'required',
        ]);

        if($validated['verify_password'] !== $validated['password']) {
            return back()->withErrors([
                'error' => 'The passwords do not match',
            ]);
        }

        // creates a new user and saves it to the database
        $user = new User;
        $user->username = $validated['username'];
        $user->password = Hash::make($validated['password']);
        $user->email = $validated['email'];
        $user->save();

        if(Auth::attempt([
            'email' => $user->email,
            'password' => $validated['password']
        ])) {
            return to_route('home');
        }

        return back()->withErrors([
            'error' => 'something went wrong'
            ]);
    }

    // validates a user
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            return to_route('home');
        }

        return back()->withErrors([
            'error' => 'your email or password is incorecct',
        ]);
    }
}
