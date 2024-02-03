<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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

// Route::get('/{slug?}', function () {
//     return view('welcome');
// });
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
