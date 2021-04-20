<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckName;
use App\Http\Middleware\TerminableMiddleware;
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


// Auth::routes();
// Authentication Routes...
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register')->middleware('after');

// Password Reset Routes...
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('error/403', function(){
    return view('error.403');
});

//menggunakan middleware
#1. 1 middleware
Route::get('admin/profile', function () {
    return 'ini halaman profil admin';
})->middleware('auth');

#2. lebih dari 1 middleware
// Route::get('admin', function () {
//     return 'ini halaman admin';
// })->middleware('auth', 'check.name');

Route::get('admin/data', function () {
    return 'ini halaman data admin';
})->middleware(CheckName::class);

#menggunakan grup middleware
// Route::get('/', function () {
//     //
// })->middleware('web');

// Route::group(['middleware' => ['web']], function () {
//     //
// });

// Route::middleware(['web', 'subcribed'])->group(function () {
//     //
// });

Route::get('admin', function () {
    return 'ini halaman admin';
})->middleware('admin');

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin/group1', function () {
        return 'ini halaman admin 1';
    });
    Route::get('admin/group2', function () {
        return 'ini halaman admin 2';
    });
});

Route::middleware(['web', 'admin'])->group(function () {
    Route::get('admin/group3', function () {
        return 'ini halaman admin 3';
    });
    Route::get('admin/group4', function () {
        return 'ini halaman admin 5';
    });
});

// Route::put('/post/{id}', function ($id) {
//     //
// })->middleware('role:editor');

Route::get('/admin/important', function () {
    return "ini halaman penting untuk admin";
})->middleware('check.role:admin');

Route::get('/terminate/before', function () {
    return session()->has('res');
})->middleware(TerminableMiddleware::class);

Route::get('/terminate/after', function () {
    $res = session()->get('res');
    session()->forget('res');
    return $res;
});