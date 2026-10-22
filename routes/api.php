<?php

use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/chapters', [ChapterController::class, 'index']);
    Route::get('/questions', [QuestionController::class, 'index']);
});
