<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/* FRONTEND */

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/formularz', [ApplicationController::class, 'form'])->name('front.application.form');
Route::post('/formularz/zapisz', [ApplicationController::class, 'store'])->name('front.application.save');
Route::get('/formularz/podziekowania', [ThxController::class, 'form'])->name('front.thx.form');
Route::get('/potwierdzam/{application}/{token}', [ConfirmController::class, 'application'])->name('front.confirm.application');
Route::post('/kontakt/wyslij', [ContactController::class, 'send'])->name('front.contact.send');

/* BACKEND */

Route::middleware(['auth', 'verified', 'jwt.access'])->group(function () {
    Route::get('/panel', [\App\Http\Controllers\Panel\HomeController::class, 'index'])->name('back.home');

    Route::middleware(['can:isAdmin'])->group(function () {
        Route::get('/panel/zgloszenie', [\App\Http\Controllers\Panel\ApplicationController::class, 'index'])->name('back.application');
        Route::get('/panel/zgloszenie/{application}', [\App\Http\Controllers\Panel\ApplicationController::class, 'show'])->name('back.application.show');
    });
});
