<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LoanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('loans', LoanController::class);
