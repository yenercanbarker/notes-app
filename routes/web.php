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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list/{listId}', [\App\Http\Controllers\ListController::class, 'index'])->name('list');
Route::get('/list/show/{listId}', [\App\Http\Controllers\ListController::class, 'show'])->name('list_show');
Route::post('/list/edit', [\App\Http\Controllers\ListController::class, 'edit'])->name('edit_list');

Route::get('/note/show/{noteId}/{iterationId}', [\App\Http\Controllers\NoteController::class, 'show'])->name('get_note');
Route::post('/note/edit', [\App\Http\Controllers\NoteController::class, 'edit'])->name('edit_note');
Route::post('/list/{listId}/note/add', [\App\Http\Controllers\NoteController::class, 'create'])->name('add_note');
