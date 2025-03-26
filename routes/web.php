<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/inicio', [WebController::class,'index']);
Route::get('/loading', [WebController::class,'load']);
Route::get('/final', [WebController::class,'endLine']);
Route::post('/upload-file', [WebController::class, 'uploadFile']);
Route::get('/download-result', [WebController::class,'download']);
    