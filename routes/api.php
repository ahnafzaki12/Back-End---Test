<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

Route::middleware('auth:sanctum')->group(function () {
    // protected routes
});