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

Route::get('admin', "App\Http\Controllers\AuthController@login");

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/news', function () {
    return view('news');
});

Route::prefix('admin')->group(function () {

    // CATEGORIES ROUTE
    Route::prefix('categories')->group(function () {
    });

    // TOPICS ROUTE
    Route::prefix('topics')->group(function () {
    });

    // POSTS ROUTE
    Route::prefix('posts')->group(function () {
    });

    // NEWS ROUTE
    Route::prefix('news')->group(function () {
    });

    // HOME ROUTE
    Route::prefix('home')->group(function () {
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
