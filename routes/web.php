<?php

use App\Http\Controllers\Admin\BidController;
use App\Http\Controllers\User\BidController as UserBid;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin', 'middleware' => ['manager']], function () {
    Route::get('/', [BidController::class, 'index'])->name('admin');
    Route::get('/{bid}/approve', [BidController::class, 'approve'])->name('bid.approve');
});
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('/', [UserBid::class, 'index'])->name('user');
    Route::post('/bid', [UserBid::class, 'store'])->name('save.bid');
});


