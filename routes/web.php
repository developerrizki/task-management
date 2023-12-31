<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/project', \App\Http\Controllers\ProjectController::class);
Route::resource('/task', \App\Http\Controllers\TaskController::class);
Route::post('/task/update-position', [\App\Http\Controllers\TaskController::class, 'updatePosition'])
    ->name('task.update.position');
