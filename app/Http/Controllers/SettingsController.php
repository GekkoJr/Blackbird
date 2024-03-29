<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SettingsController extends Controller
{
    // this thing manages user settings and updating of Account info
    public function index()
    {
        if (!Auth::check()) {
            return redirect(route("login"));
        }

        return Inertia::render("Settings", ["user" => Auth::user()]);
    }
}
