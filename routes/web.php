<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/inicio', [WebController::class,'index']);
Route::get('/loading', [WebController::class,'load']);
Route::post('/upload-file', [WebController::class, 'uploadFile']);