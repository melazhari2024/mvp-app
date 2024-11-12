<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('register', [\App\Http\Controllers\Auth\UserController::class, 'register']);
Route::post('get-user-token', [\App\Http\Controllers\Auth\UserController::class, 'getUserToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('loans', [LoanController::class, 'store']);
    Route::get('loans', [LoanController::class, 'index']);
    Route::get('loans/{id}', [LoanController::class, 'show']);
    Route::put('loans/{id}', [LoanController::class, 'update']);
    Route::delete('loans/{id}', [LoanController::class, 'destroy']);
});
