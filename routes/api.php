<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

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
Route::resource('{user}/customers', CustomerController::class)
    ->missing(function (Request $request) {
        return response()->json([
            'code' => 'Not Found',
            'message' => 'Customer not found.'
        ], 404);
    });


// Route::apiResources([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ]);
