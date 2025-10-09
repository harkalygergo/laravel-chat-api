<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/auth', function () {
    return view('auth');
})->name('login');

// Show notice after registration
Route::get('/email/verify', function () {
    return 'Please check your email to verify.';
})->middleware('auth')->name('verification.notice');

// Email verification callback
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('loginHandle');


// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('auth')->get('/friends', [FriendController::class, 'list'])->name('friends');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [FriendController::class, 'index']);
    Route::post('/friends/add/{user}', [FriendController::class, 'add']);

    Route::post('/message/{recipient}', [MessageController::class, 'send']);
    Route::get('/messages/{user}', [MessageController::class, 'conversation']);
    // Chat UI page
    Route::view('/chat', 'messages.index')->name('chat');
});

// Logout route for web UI
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
