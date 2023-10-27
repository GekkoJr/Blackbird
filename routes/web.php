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
Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/login', function () {
    return Inertia::render('Login/Login');
})->middleware('loginCheck')->name('login');

Route::get('/signup', function () {
   return Inertia::render('Login/Signup');
})->middleware('loginCheck');

Route::get('/app', function () {
    return Inertia::render('App', [
        'chatting' => false,
        // this is a temporary fix
        'messages' => \App\Models\Message::latest()->where('channel', 'global')->take(1)->get()->toJson()
    ]);
})->name('home')->middleware('auth');

Route::get('/app/global', function () {
   return Inertia::render('App', [
       'chatting' => true,
       'channel'  => 'global',
       'messages' => \App\Models\Message::latest()->where('channel', 'global')->paginate(30)->toJson()
    ]);
});

// Routes related to Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/createUser', 'createUser')
        ->name('createUser');

    Route::post('/loginUser', 'login')
        ->name('loginUser');
});

// Routes for chatting
Route::controller(\App\Http\Controllers\ChatController::class)->group(function () {
    Route::post('/message/send', 'sendMessage');
});

// routes for friendships / groups
Route::controller('App\Http\Controllers\FriendshipController')->group(function () {
   Route::get('/user/friends', 'allFriends');
   Route::get('/user/pending', 'getPending');
   Route::post('/user/add', 'addFriend');
});

Route::get('/user/info', function () {
    return \Illuminate\Support\Facades\Auth::user()->toJson();
});
