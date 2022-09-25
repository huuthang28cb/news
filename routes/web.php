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

// Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::resource('admin', "AdminController@loginAdmin");
//Route::post('/admin', "AdminController@postloginAdmin");

Route::get('/home', function () {
    return view('home');
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
});
