<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('borrows',BorrowController::class);
Route::resource('book', BookController::class);
Route::resource('reader', ReaderController::class);