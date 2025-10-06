<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/users', [FriendController::class, 'index']);
    Route::post('/friend/{user}', [FriendController::class, 'add']);

    Route::post('/message/{recipient}', [MessageController::class, 'send']);
    Route::get('/messages/{user}', [MessageController::class, 'conversation']);
});
