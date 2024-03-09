<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return view('dashboard', ['type_menu' => 'home']);
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);
});

