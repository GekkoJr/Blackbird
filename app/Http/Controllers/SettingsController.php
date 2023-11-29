<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    // this thing manages user settings and updating of Account info
    public function index()
    {
        return Inertia::render("Settings");
    }
}
