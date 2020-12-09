<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'checkLogin']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'checkRegister']);

Route::get('logout', [AuthController::class, 'logout']);

Route::resource('posts',PostsController::class);
Route::get('my-posts', [PostsController::class, 'myPosts']);
Route::get('search', [PostsController::class, 'search']);
Route::resource('categories',CategoriesController::class);
Route::post('comments/{id}', [CommentsController::class, 'store']);
