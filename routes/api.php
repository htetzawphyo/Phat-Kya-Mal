<?php

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\DiscordNotification;
use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/book_request', [DiscordNotification::class, 'notification']);

Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(AuthorController::class)->group(function() {
    Route::get('/authors', 'index');
    Route::get('/authors/{author}', 'show');
});

Route::controller(FileController::class)->group(function() {
    Route::get('/files', 'index');
    // Route::get('/files/scroll_book', 'scrollBook');
    Route::get('/files/most_download_books', 'mostDownloadedBooks');
    Route::get('/files/{file}', 'show');
    Route::get('/files/download/{file}', 'download');
});


Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
   
    Route::controller(AuthorController::class)->group(function() {
        // Route::get('/authors/search', 'search');
        Route::post('/authors', 'store');
        Route::put('/authors/{author}', 'update');
        Route::delete('/authors/{author}', 'destroy');
    });

    Route::controller(FileController::class)->group(function() {        
        Route::post('/files', 'upload');
        Route::put('/files/{file}', 'update');
        Route::delete('/files/{file}', 'destroy');
    });
});