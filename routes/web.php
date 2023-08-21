<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function(){
    return view('layouts/app');
});

Route::get('/show_all', [RecipesController::class, 'showAll']);
Route::resource('recipes', RecipesController::class);
Route::get('/', [AuthController::class,'showLogin'])->name('showLogin');
Route::post('/login',[AuthController::class, 'login'])->name('login');