<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\UserController;

Route::any('/info', function(Request $request) {
    return response()->json([
        'app' => 'Payame API',
        'version' => 1,
    ]);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('users', UserController::class);

Route::group(['prefix'=> 'auth'], function() {
    Route::post('signin', [AuthController::class, 'signin']);
});

Route::resource('{user}/customers', CustomerController::class)
    ->missing(function (Request $request) {
        return response()->json([
            'code' => 'Not Found',
            'message' => 'Resource not found.'
        ], 404);
    });

Route::resource('{user}/loans', LoanController::class)
    ->missing(function (Request $request) {
        return response()->json([
            'code' => 'Not Found',
            'message' => 'Resource not found.'
        ], 404);
    });
