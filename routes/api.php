<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('need.token')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('refresh', 'refresh');
});
Route::middleware('jwt.verify')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
//product
Route::get('product', [ProductController::class, 'getAllProduct']);
Route::get('product/search', [ProductController::class, 'search']);
Route::get('product/{id}', [ProductController::class, 'getProduct']);
Route::post('product', [ProductController::class, 'createProduct']);
Route::put('product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('product/{id}', [ProductController::class, 'deleteProduct']);

//comment
Route::get('product/{id}/comment', [CommentController::class, 'getCommentInProduct']);
Route::post('product/{id}/comment', [CommentController::class, 'createComment']);
Route::delete('product/comment/{id}', [CommentController::class, 'deleteComment']);
Route::put('product/comment/{id}/like', [CommentController::class, 'like']);

Route::get('clearCacheredis', function () {
    Redis::flushAll();
});
