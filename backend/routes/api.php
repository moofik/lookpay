<?php

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/payment-register', [\App\Http\Controllers\PaymentController::class, 'payAndRegister']);
Route::post('/payment-anonymous', [\App\Http\Controllers\PaymentController::class, 'payWithoutRegistration']);
Route::post('/payment', [\App\Http\Controllers\PaymentController::class, 'pay'])
    ->middleware('auth:sanctum');
Route::get('/payment-list', [\App\Http\Controllers\PaymentController::class, 'list'])
    ->middleware('auth:sanctum');

Route::get('/convert', [\App\Http\Controllers\CurrencyController::class, 'convert']);
Route::get('/mail', [\App\Http\Controllers\MailController::class, 'mail']);
