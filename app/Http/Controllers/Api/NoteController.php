<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    function getAllNotes(Request $request){
        $notes = Note::orderBy('created_at', 'desc')->get();
        return response()->json($notes, 200);
    }

    function addNote(Request $request){
        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required'
        ]);

        $noteData = $request->only(['title', 'body']);
        $note = Note::create($noteData);
        if($note){
            return response()->json($note, 201);
        }else{
            return response()->json(['error'=>'failed to add note'], 400);
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
            return response()->json($note, 201);
        }else{
            return response()->json(['error'=>'failed to update note'], 400);
        }
        
         
    }

    function DeleteNote(Request $request, $id){

        $note = Note::find($id);
        if($note->delete()){
            return response()->json($note, 200);
        }else{
            return response()->json(['error'=>'failed to delete note'], 400);
        }
        
         
    }
}
