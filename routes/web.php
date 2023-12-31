<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
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
   return redirect('/todo-list');
});

Auth::routes();


Route::get('/todo-list/fetch-all', [App\Http\Controllers\ToDoController::class, 'fetchAll'])->name('fetchall');
Route::get("/todo-list/update-status/{id}", [App\Http\Controllers\ToDoController::class, 'updateStatus'])->name('markcompleted');
Route::put("/todo-list/{id}",  [App\Http\Controllers\ToDoController::class, 'update'])->name('update.resource');
Route::resource('todo-list', ToDoController::class);

