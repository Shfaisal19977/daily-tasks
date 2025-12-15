<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
route::get('book',[BookController::class ,'get']);
route::get('book{book}',[BookController::class ,'post']);
route::put('book',[BookController::class ,'update']);
route::delete('book{book}',[BookController::class ,'delete']);