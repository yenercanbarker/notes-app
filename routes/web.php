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
Route::get('/to-do-lists', [App\Http\Controllers\HomeController::class, 'to_do_lists'])->name('to-do-lists')->middleware('auth');

Route::get('/list/{listId}', [\App\Http\Controllers\ListController::class, 'index'])->name('list');
Route::get('/list/show/{listId}', [\App\Http\Controllers\ListController::class, 'show'])->name('list_show');
Route::post('/list/edit', [\App\Http\Controllers\ListController::class, 'edit'])->name('edit_list');
Route::post('/list/create', [\App\Http\Controllers\ListController::class, 'create'])->name('create_list');
Route::post('/list/delete', [\App\Http\Controllers\ListController::class, 'delete'])->name('delete_list');

Route::get('/note/show/{noteId}/{iterationId}', [\App\Http\Controllers\NoteController::class, 'show'])->name('get_note');
Route::post('/note/edit', [\App\Http\Controllers\NoteController::class, 'edit'])->name('edit_note');
Route::post('/note/delete', [\App\Http\Controllers\NoteController::class, 'delete'])->name('delete_note');
Route::post('/note/change-status', [\App\Http\Controllers\NoteController::class, 'changeStatus'])->name('change_note_status');
Route::post('/list/{listId}/note/add', [\App\Http\Controllers\NoteController::class, 'create'])->name('add_note');
