<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/magic-link-logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('magic-link-logout');

Route::get('/validate-token', [App\Http\Controllers\AuthController::class, 'validateUser'])->name('token-validate');


Route::group(['middleware' => ['custom_auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'showUsers'])->name('show');
});

