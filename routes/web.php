<?php

use Illuminate\Support\Facades\Route;
use App\Note;
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
Route::get('/notes', 'NoteController@getAllNotes')->name('notes.all');
Route::post('/notes-new', 'NoteController@addNote')->name('notes.add');
Route::get('/notes-new', function(){
    return view('note.add');
})->name('notes.add');
Route::put('/notes/{id}', 'NoteController@updateNote')->name('notes.update');
Route::get('/notes/{note}', function(Note $note){
    return view('note.update', ['note'=>$note]);
})->name('notes.update');
Route::delete('/notes/{id}', 'NoteController@deleteNote')->name('notes.delete');
