<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class,'index']);
Route::get('/loading', [WebController::class,'load']);
Route::get('/final', [WebController::class,'endLine']);
Route::post('/upload-file', [WebController::class, 'uploadFile']);
Route::get('/download-result', [WebController::class,'download']);
Route::get('/delete',[WebController::class,'deleteFile']);

Route::get('/teste', [WebController::class,'modal']);
    