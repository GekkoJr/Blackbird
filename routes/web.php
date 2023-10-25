<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', \App\Livewire\LoginAndSignup::class)
    ->name('login')
    ->middleware('loginCheck');

Route::get('/app', \App\Livewire\App::class)
    ->name('home')
    ->middleware('auth');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'loggedIn' => \Illuminate\Support\Facades\Auth::check(),
    ]);
});

// not needed but nice to have (should probably be in api)
Route::controller(AuthController::class)->group(function () {
    Route::post('/createUser', 'createUser')
        ->name('createUser');

    Route::post('/loginUser', 'login')
        ->name('loginUser');
});

Route::get('/test', function () {
    return Inertia::render('Test', [
        'name' => 'gekko',
        'frameworks' => ['vue', 'laravel', 'inertia']
    ]);
} );

Route::get('/login', function () {
    return Inertia::render('Login/Login');
})->middleware('loginCheck');

Route::get('/signup', function () {
   return Inertia::render('Login/Signup');
})->middleware('loginCheck');
