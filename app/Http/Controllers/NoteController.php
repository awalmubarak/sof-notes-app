<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    function getAllNotes(){
        $notes = Note::orderBy('created_at', 'desc')->get();
        return view('note.notes', ['notes'=>$notes]);
    }

    function addNote(Request $request){
        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required'
        ]);

        $noteData = $request->only(['title', 'body']);
        $note = Note::create($noteData);
        if($note){
            return redirect()->route('notes.all')->with('success', 'Note created successfully');
        }else{
            return back()->with('error', 'Error occured while adding note. please try again');
        }
         
    }

    function updateNote(Request $request, $id){
        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required'
        ]);
        $note = Note::find($id);
        if($note){
            $noteData = $request->only(['title', 'body']);
            $note->update($noteData);
            return redirect()->route('notes.all')->with('success', 'Note updated successfully');
        }else{
            return back()->with('error', 'Error occured while updating note. please try again');
        }
        
         
    }

    function DeleteNote($id){

        $note = Note::find($id);
        if($note->delete()){
            return redirect()->route('notes.all')->with('success', 'Note deleted successfully');
        }else{
            return back()->with('error', 'Error occured while deleting note. please try again');
        }
        
         
    }
}
