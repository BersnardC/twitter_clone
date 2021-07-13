<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\AuthController;

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