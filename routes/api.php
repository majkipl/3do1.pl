<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/quiz', [QuestionController::class, 'quiz'])->name('api.quiz');
Route::post('/quiz/correct', [QuestionController::class, 'correctness'])->name('api.quiz.correct');

Route::middleware(['api.keys'])->group(function () {
    Route::middleware(['api.auth'])->group(function () {
        Route::get('/applications', [ApplicationController::class, 'index'])->name('api.application');

        Route::get('/questions', [QuestionController::class, 'index'])->name('api.question');
        Route::post('/questions', [QuestionController::class, 'add'])->name('api.question.add');
        Route::put('/questions', [QuestionController::class, 'update'])->name('api.question.update');
        Route::delete('/questions/{question}', [QuestionController::class, 'delete'])->name('api.question.delete');
    });
});
