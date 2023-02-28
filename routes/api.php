<?php

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[ RegisterController::class, 'register']);
Route::post('/login',[ LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/orders',[OrderController::class, 'index']);
    Route::get('/orders/show/{id}',[OrderController::class, 'show']);

    Route::post('/orders/store',[OrderController::class, 'store']);
    Route::patch('/orders/update/{id}',[OrderController::class, 'update']);
    Route::delete('/orders/delete/{id}',[OrderController::class, 'delete']);
});



