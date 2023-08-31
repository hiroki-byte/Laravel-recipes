<?php
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function(){
    return view('layouts/app');
});

Route::get('/show_all', [RecipesController::class, 'showAll']);
Route::resource('recipes', RecipesController::class);
Route::get('/signupform', [AuthController::class,'showSignup'])->name('login.showsignup');
Route::post('/signup', [AuthController::class,'Signup'])->name('login.signup');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class,'showLogin'])->name('login.show');
    Route::get('/signupform', [AuthController::class,'showSignup'])->name('login.showsignup');
    Route::post('/signup', [AuthController::class,'Signup'])->name('login.signup');
    Route::post('/login',[AuthController::class, 'Login'])->name('login');
    Route::post('/guestlogin', [AuthController::class, 'guest'])->name('guestLogin');

});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [RecipesController::class, 'index'])->name('home');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('/mypage', [RecipesController::class, 'mypage']);
    Route::get('/search', [RecipesController::class, 'search']);
});


