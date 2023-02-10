<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('need.token')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
    //post
    Route::get('post', [PostController::class, 'getAllPost']);
    Route::post('post', [PostController::class, 'createPost']);
    Route::put('post/{post}', [PostController::class, 'updateController'])->middleware('can:postUpdate,post');
    Route::delete('post/{post}', [PostController::class, 'deletePost'])->middleware('can:postDelete,post');
    Route::post('logout', [AuthController::class, 'logout']);
    //product
    Route::group([
        'middleware' => 'user.role:Admin'
    ], function () {
        Route::post('product', [ProductController::class, 'createProduct']);
        Route::put('product/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('product/{id}', [ProductController::class, 'deleteProduct']);
    });
    //comment
    Route::group([
        'middleware' => 'user.role:User'
    ], function () {
        Route::post('product/{id}/comment', [CommentController::class, 'createComment']);
        Route::delete('product/comment/{id}', [CommentController::class, 'deleteComment']);
        Route::put('product/comment/{id}/like', [CommentController::class, 'like']);
    });
    //order
    Route::post('order', [OrderController::class, 'createOrder']);
    Route::get('orderUser', [OrderController::class, 'getOrderOfUser']);
    //file
    Route::post('multifile', [FileController::class, 'multiUploadFile']);
    Route::post('image', [FileController::class,'uploadImage']);
});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
//    Route::post('refresh', 'refresh');
});

//product
Route::get('product', [ProductController::class, 'getAllProduct']);
Route::get('product/search', [ProductController::class, 'search']);
Route::get('product/{id}', [ProductController::class, 'getProduct']);

//comment
Route::get('product/{id}/comment', [CommentController::class, 'getCommentInProduct']);

Route::get('clearCacheredis', function () {
    Redis::flushAll();
});
