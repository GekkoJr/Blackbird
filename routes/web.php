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

Route::get('/', function () {
    return view('test');
});
Route::get('/login', \App\Livewire\Login::class)->name('login');

Route::post('chat', [ChatController::class, 'chat'])->name('sendMessage');

Route::controller(AuthController::class)->group(function () {
    Route::post('/createUser', 'createUser')->name('createUser');
    Route::post('/loginUser', 'loginUser')->name('loginUser');
});

