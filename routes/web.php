<?php

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

Route::middleware('auth')->group(function(){
    
    Route::get('/', [TransactionsController::class, 'index'])->name('home');
    Route::get('/transaction/{id}', [TransactionsController::class, 'show'])->name('show');
    Route::post('/transaction/store', [TransactionsController::class, 'store'])->name('store');
    Route::delete('/transaction/{id}', [TransactionsController::class, 'destroy'])->name('destroy');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::prefix('category')->as('category.')->group(function(){
        Route::get('/{id}', [CategoriesController::class, 'transactions_by_id'])->name('show');
        Route::post('/store', [CategoriesController::class, 'store'])->name('store');
    });

    Route::prefix('config')->as('config.')->group(function(){
        Route::post('/date', [SessionController::class, 'date'])->name("date");
    });
    
});


Route::middleware('guest')->prefix('login')->as('login.')->group(function(){
    Route::get('/', [SessionController::class, 'create'])->name('create');
    Route::post('/', [SessionController::class, 'store'])->name('store');
});
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('destroy');

Route::middleware('guest')->prefix('register')->as('register.')->group(function(){
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
