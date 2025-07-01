<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [MovieController::class, 'index']);
Route::post('/', [MovieController::class, 'createMovie']);
