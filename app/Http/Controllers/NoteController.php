<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    function getAllNotes(Request $request){
        $notes = Note::orderBy('created_at', 'desc')->get();
        if ($request->wantsJson()) {
            return response()->json($notes, 200);
        }
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
            if($request->wantsJson()) {
                return response()->json($note, 201);
            }
            return redirect()->route('notes.all')->with('success', 'Note created successfully');
        }else{
            if ($request->wantsJson()) {
                return response()->json(['error'=>'failed to add note'], 400);
            }
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
            if ($request->wantsJson()) {
                return response()->json($note, 201);
            }
            return redirect()->route('notes.all')->with('success', 'Note updated successfully');
        }else{
            if ($request->wantsJson()) {
                return response()->json(['error'=>'failed to update note'], 400);
            }
            return back()->with('error', 'Error occured while updating note. please try again');
        }
        
         
    }

    function DeleteNote(Request $request, $id){

        $note = Note::find($id);
        if($note->delete()){
            if ($request->wantsJson()) {
                return response()->json($note, 200);
            }
            return redirect()->route('notes.all')->with('success', 'Note deleted successfully');
        }else{
            if ($request->wantsJson()) {
                return response()->json(['error'=>'failed to delete note'], 400);
            }
            return back()->with('error', 'Error occured while deleting note. please try again');
        }
        
         
    }
}
