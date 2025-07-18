<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FlagQuizController;
use App\Http\Controllers\HangController;
use Illuminate\Support\Facades\Log;

Route::get('/', [QuizController::class, 'home'])->name('home');
Route::get('/quiz', [QuizController::class, 'quiz'])->name('quiz.show');
Route::post('/quiz/check', [QuizController::class, 'checkAnswer'])->name('quiz.check');
Route::get('/quiz/end', [QuizController::class, 'end'])->name('quiz.end');
Route::get('/flag-quiz', [FlagQuizController::class, 'quiz'])->name('flag.quiz');
Route::post('/flag-quiz', [FlagQuizController::class, 'checkAnswer'])->name('flag.check');
Route::get('/flag-quiz/end', [FlagQuizController::class, 'end'])->name('flag.end');
Route::get('/hang', [HangController::class, 'hang'])->name('hang.show');

Route::get('/log-test', function () {
    Log::debug('TEST DEBUG LOG');
    Log::error('TEST ERRORE LOG');
    return 'Log scritto';
});
