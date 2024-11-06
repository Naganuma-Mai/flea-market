<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;

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

Route::get('/', [ItemController::class, 'index']);
Route::get('/items/search', [ItemController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::middleware('auth:web')->group(function () {
    Route::get('/sell', [ItemController::class, 'add']);
    Route::post('/sell', [ItemController::class, 'store']);
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'index']);
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store']);
    Route::get('/purchase/success/{item_id}', [PurchaseController::class, 'success']);
    Route::get('/purchase/cancel/{item_id}', [PurchaseController::class, 'cancel']);
    Route::post('/like', [LikeController::class, 'store']);
    Route::post('/unlike', [LikeController::class, 'destroy']);
    Route::get('/purchase/address/{item_id}', [ProfileController::class, 'editAddress']);
    Route::post('/purchase/address/{item_id}', [ProfileController::class, 'storeAddress']);
    Route::get('/purchase/payment/{item_id}', [PaymentController::class, 'edit']);
    Route::post('/purchase/payment/{item_id}', [PaymentController::class, 'update']);
    Route::get('/mypage', [UserController::class, 'index']);
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::post('/mypage/profile', [ProfileController::class, 'store']);
    Route::get('/comment/{item_id}', [CommentController::class, 'index']);
    Route::post('/comment/{item_id}', [CommentController::class, 'store']);
});

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'store']);

    Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'store']);

    Route::post('/logout', [AdminLoginController::class, 'destroy']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::post('/user/delete', [UserController::class, 'destroy']);
    });
});
