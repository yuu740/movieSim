<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [MovieController::class, 'index']);
Route::post('/create-movie', [MovieController::class, 'createMovie']);
Route::put('/update-movie', [MovieController::class, 'updateMovie']);
Route::delete('/delete-movie/{id}', [MovieController::class, 'deleteMovie']);

Route::post('/create-episode', [EpisodeController::class, 'createEpisode']);
