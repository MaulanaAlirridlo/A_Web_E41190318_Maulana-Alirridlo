<?php

use App\Http\Middleware\CheckAge;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//menggunakan middleware
#1. 1 middleware
Route::get('admin/profile', function () {
    //
})->middleware('auth');

#2. lebih dari 1 middleware
Route::get('/', function () {
    //
})->middleware('first', 'second');

Route::get('admin/profile', function () {
    //
})->middleware(CheckAge::class);

//menggunakan grup middleware
Route::get('/', function () {
    //
})->middleware('web');

Route::group(['middleware' => ['web']], function () {
    //
});

Route::middleware(['web', 'subcribed'])->group(function () {
    //
});

Route::put('/post/{id}', function ($id) {
    //
})->middleware('role:editor');