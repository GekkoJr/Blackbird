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

        if ($validated['verify_password'] !== $validated['password']) {
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

        if (Auth::attempt([
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

    public function logout()
    {
        Auth::logout();
        session()->regenerate();
        return to_route("login");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'verify_password' => 'required'
        ]);
        // checks if the passwords match
        if ($request->password == $request->verify_password) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            session()->regenerate();
            // yes it is bad, but in my defense it is really late
            return back()->withErrors([
                'error' => 'Password updated!'
            ]);
        }

        return back()->withErrors([
            'error' => 'Passwords do not match'
        ]);
    }

    public function updateEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();
        session()->regenerate();

        return back()->withErrors([
            'success' => 'Email Updated'
        ]);
    }
}
