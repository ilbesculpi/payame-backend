<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AssociateController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\UserController;

Route::any('/info', function(Request $request) {
    return response()->json([
        'app' => 'Payame API',
        'version' => 1,
    ]);
});

Route::resource('users', UserController::class);

Route::group(['prefix'=> 'auth'], function() {
    Route::post('signin', [AuthController::class, 'signin']);
});

Route::middleware('auth:sanctum')
    ->group(function() {

        Route::resource('customers', CustomerController::class)
            ->missing(function (Request $request) {
                return response()->json([
                    'code' => 'Not Found',
                    'message' => 'Resource not found.'
                ], 404);
            });

        Route::resource('{customer}/loans', LoanController::class);

        Route::resource('associates', AssociateController::class);

        Route::resource('loans', LoanController::class)
            ->missing(function (Request $request) {
                return response()->json([
                    'code' => 'Not Found',
                    'message' => 'Resource not found.'
                ], 404);
            });

    });



