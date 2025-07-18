<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\FlagQuizController;
use App\Http\Controllers\HangController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Log;

// Route di login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [QuizController::class, 'home'])->name('home');
Route::get('/quiz', [QuizController::class, 'quiz'])->name('quiz.show');
Route::post('/quiz/check', [QuizController::class, 'checkAnswer'])->name('quiz.check');
Route::get('/quiz/end', [QuizController::class, 'end'])->name('quiz.end');
Route::get('/flag-quiz', [FlagQuizController::class, 'quiz'])->name('flag.quiz');
Route::post('/flag-quiz', [FlagQuizController::class, 'checkAnswer'])->name('flag.check');
Route::get('/flag-quiz/end', [FlagQuizController::class, 'end'])->name('flag.end');

// Rotte per il gioco dell'impiccato
Route::get('/hangman', [HangController::class, 'hang'])->name('hangman');
Route::post('/hangman/guess', [HangController::class, 'guess'])->name('hangman.guess');
Route::get('/hangman/win', [HangController::class, 'win'])->name('hangman.win');
Route::get('/hangman/lose', [HangController::class, 'lose'])->name('hangman.lose');
Route::get('/hangman/restart', [HangController::class, 'restart'])->name('hangman.restart');

Route::get('/hang', [HangController::class, 'hang'])->name('hang.show');
Route::get('/study', [StudyController::class, 'index'])->name('study.index');
Route::post('/study/navigate', [StudyController::class, 'navigate'])->name('study.navigate');

Route::get('/clear-study-session', function() {
    session()->forget(['study_history', 'study_current_index']);
    return 'Sessione study pulita!';
});
