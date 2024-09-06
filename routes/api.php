<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::resource('/series', SeriesController::class);
    Route::get(
        '/series/{series}/seasons',
        [SeasonsController::class, 'index']
    );

    Route::get(
        '/series/{series}/seasons/{id}',
        [SeasonsController::class, 'show']
    );


    Route::get(
        '/series/{series}/episodes',
        [EpisodesController::class, 'index']
    );

    Route::get(
        '/series/{series}/episodes/{id}',
        [EpisodesController::class, 'show']
    );
});



Route::post('/login', [LoginController::class, 'authenticate']);

// Route::post('/login', function (Request $request) {
//     try {
//         $data = $request->except(['_token']);
//         // var_dump($data);
//         $data['password'] = Hash::make($data['password']);

//         $user = User::create($data);
//         Auth::login($user);
//         return $user;
//     } catch (Exception $e) {
//         return $e;
//     }
// });
