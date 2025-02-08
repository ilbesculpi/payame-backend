<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LoanController;
use App\Http\Middleware\SetLocale;

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-z]{2}']], function () {
    Route::get('/', function () {
        return view('home');
    });
})->middleware(SetLocale::class);

// Route for the root URL (redirect to Spanish home by default if no locale is provided)
Route::get('/', function () {
    return redirect('/es');
});

Route::resource('loans', LoanController::class);
