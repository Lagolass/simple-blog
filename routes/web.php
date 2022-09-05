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

Route::get('/', \App\Http\Controllers\MainPageController::class)->name('home');

Route::get('/posts', \App\Http\Controllers\PostController::class . '@index')->name('posts');
Route::get('/post/{post?}', \App\Http\Controllers\PostController::class . '@show')->name('post.detail');

require __DIR__.'/auth.php';
