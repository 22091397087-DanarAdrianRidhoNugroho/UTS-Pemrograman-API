<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ContactController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get', [UserController::class, 'get']);
    Route::put('/update', [UserController::class, 'update']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/contacts/{idContact}/addresses', [AddressController::class, 'store']);
    Route::get('/contacts/{idContact}/addresses', [AddressController::class, 'index']);
    Route::get('/contacts/{idContact}/addresses/{idAddress}', [AddressController::class, 'show']);
    Route::put('/contacts/{idContact}/addresses/{idAddress}', [AddressController::class, 'update']);
    Route::delete('/contacts/{idContact}/addresses/{idAddress}', [AddressController::class, 'destroy']);

    Route::post('/contacts/store', [ContactController::class, 'store']);
    Route::get('/contacts/index', [ContactController::class, 'index']);
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
});

