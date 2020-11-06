<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    function getAllNotes(){
        $notes = Note::latest();
        return view('note.notes', ['notes'=>$notes]);
    }

    
}
