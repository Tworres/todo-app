<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
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

Route::get('/', [HomeController::class, "index"])->name('home.name');

Route::get('/todo', [TodoController::class, "get"])->name('todo.store');
Route::post('/todo', [TodoController::class, "store"])->name('todo.store');
Route::put('/todo/{todo}', [TodoController::class, "update"])->name('todo.update');
Route::delete('/todo/{todo}', [TodoController::class, "destroy"])->name('todo.destroy');
