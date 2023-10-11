<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

// not needed but nice to have (should probably be in api)
Route::controller(AuthController::class)->group(function () {
    Route::post('/createUser', 'createUser')
        ->name('createUser');

    Route::post('/loginUser', 'loginUser')
        ->name('loginUser');
});

