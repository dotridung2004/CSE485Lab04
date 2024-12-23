<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', [
    HomeController::class, 'index'
]);
Route::resource('book', BooksController::class);
Route::resource('reader', ReaderController::class);
