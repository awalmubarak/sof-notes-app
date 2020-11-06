<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notes', 'Api\NoteController@getAllNotes')->name('api.notes.all');
Route::post('/notes-new', 'Api\NoteController@addNote')->name('api.notes.add');
Route::put('/notes/{id}', 'Api\NoteController@updateNote')->name('api.notes.update');
Route::delete('/notes/{id}', 'Api\NoteController@deleteNote')->name('api.notes.delete');

