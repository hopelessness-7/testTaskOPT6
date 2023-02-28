<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Produect Route
    Route::get('products',[ProductController::class, 'index'])->name('products');
    Route::get('products/create',[ProductController::class, 'create'])->name('products.create');
    Route::get('products/show/{id}',[ProductController::class, 'show'])->name('products.show');
    Route::get('products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');

    Route::post('products/store',[ProductController::class, 'store'])->name('products.store');
    Route::patch('products/update/{id}',[ProductController::class, 'update'])->name('products.update');
    Route::delete('products/delete/{id}',[ProductController::class, 'destroy'])->name('products.destroy');

    //Order Route
    Route::get('orders',[OrderController::class, 'index'])->name('orders');
    Route::get('orders/create',[OrderController::class, 'create'])->name('orders.create');
    Route::get('orders/show/{id}',[OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/edit/{id}',[OrderController::class, 'edit'])->name('orders.edit');

    Route::post('orders/store',[OrderController::class, 'store'])->name('orders.store');
    Route::patch('orders/update/{id}',[OrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/delete/{id}',[OrderController::class, 'destroy'])->name('orders.destroy');
});


require __DIR__.'/auth.php';
