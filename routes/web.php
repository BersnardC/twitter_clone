<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
	return redirect('home');
});

Route::get('/login', function() {
	return view('auth.login');
})->middleware('guest')->name('login');

Route::get('/register', function() {
	return view('auth.register');
})->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'do_login'])->name('do_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', Home::class)->middleware('auth')->name('home');
Route::post('/home', [Home::class, 'save_post']);

# Practicando Form validator request
# https://learn2torials.com/a/laravel8-form-validation
Route::get('/contact', [ContactController::class, 'create'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'store'])->name('contact-us');
# https://learn2torials.com/a/laravel-form-validation
Route::get('/contact2', [ContactController::class, 'create2'])->name('contact-us2');
Route::post('/contact2', [ContactController::class, 'store2'])->name('contact-us2');