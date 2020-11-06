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

    function addNote(Request $request){
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $noteData = $request->only(['title', 'body']);
        $note = Note::create($noteData);
        if($note){
            return redirect()->route('notes')->with('success', 'Note created successfully');
        }else{
            return back()->with('error', 'Error occured while adding note. please try again');
        }
         
    }

}
