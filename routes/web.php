<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return empty page response
    return response()->noContent();
});
