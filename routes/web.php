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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notes', 'NoteController@getAllNotes')->name('note.all');
Route::post('/notes', 'NoteController@addNote')->name('note.add');
Route::put('/notes', 'NoteController@updateNote')->name('note.update');
Route::delete('/notes', 'NoteController@deleteNote')->name('note.delete');
