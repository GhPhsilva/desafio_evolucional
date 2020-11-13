<?php

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
    return view('auth.login');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/db', [App\Http\Controllers\HomeController::class, 'db'])->name('db');
    Route::post('/relatorio', [App\Http\Controllers\HomeController::class, 'relatorio'])->name('relatorio');
    Route::get('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download');
});
