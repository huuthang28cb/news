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

Route::prefix('posts')->group(function() {
    Route::get('/', [
        'as' => 'posts.index',
        'uses' => 'PostsController@index',
    ]);
    Route::get('/create', [
        'as' => 'posts.create',
        'uses' => 'PostsController@create',
    ]);
});
