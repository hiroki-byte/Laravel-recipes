<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function(){
    return view('layouts/app');
});

Route::get('/show_all', [RecipesController::class, 'showAll']);
Route::resource('recipes', RecipesController::class);

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class,'showLogin'])->name('login.show');
    Route::post('/login',[AuthController::class, 'Login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function() {
        return view('home');
    })->name('home');

    Route::post('logout',[AuthController::class, 'logout'])->name('logout');
});


