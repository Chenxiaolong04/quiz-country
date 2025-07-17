<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'home']);
Route::get('/quiz', [QuizController::class, 'quiz']);
Route::post('/quiz/check', [QuizController::class, 'checkAnswer'])->name('quiz.check');
