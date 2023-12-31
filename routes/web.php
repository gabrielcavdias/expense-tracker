<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [TransactionsController::class, 'index'])->name('home');
    Route::get('/transaction/{id}', [TransactionsController::class, 'show'])->name('show');
    Route::post('/transaction/store', [TransactionsController::class, 'store'])->name('store');
    Route::delete('/transaction/{id}', [TransactionsController::class, 'destroy'])->name('destroy');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::prefix('category')->as('category.')->group(function () {
        Route::get('/{id}', [CategoriesController::class, 'transactions_by_id'])->name('show');
        Route::post('/store', [CategoriesController::class, 'store'])->name('store');
    });
});

Route::middleware('auth')->prefix('config')->as('config.')->group(function () {
    Route::post('/date', [SessionController::class, 'date'])->name("date");
});

Route::middleware('auth')->prefix('verify')->as('verification.')->group(function () {
    Route::get('/', [AccountController::class, 'verifyEmailNotice'])->name('notice');
    Route::get('/{id}/{hash}', [AccountController::class, 'verifyEmail'])->name('verify');
    Route::post('/send', [AccountController::class, 'sendVerifyEmail'])->name('send');
});

Route::middleware('guest')->as('password.')->group(function () {
    Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('request');
    Route::post('/forgot-password', [AccountController::class, 'forgotPasswordEmail'])->name('email');
    Route::get('/reset-password', [AccountController::class, 'resetPasswordForm'])->name('reset');
});


Route::middleware('guest')->prefix('login')->as('login.')->group(function () {
    Route::get('/', [SessionController::class, 'create'])->name('create');
    Route::post('/', [SessionController::class, 'store'])->name('store');
});
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('destroy');

Route::middleware('guest')->prefix('register')->as('register.')->group(function () {
    Route::get('/', [RegisterController::class, 'create'])->name('create');
    Route::post('/', [RegisterController::class, 'store'])->name('store');
});

/*
 Route::prefix('api')->group(function(){
     Route::prefix("transactions")->group(function(){
         Route::get('/', [TransactionsController::class, 'transactions'])->name('transactions');
         Route::get('/show/{id}', [TransactionsController::class, 'single'])->name('single');
         Route::post('/store', [TransactionsController::class, 'store'])->name('store');
         Route::put('/update/{id}', [TransactionsController::class, 'update'])->name('update');

     });
     Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
 });
 */
