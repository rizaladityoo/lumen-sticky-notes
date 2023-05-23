<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function getNote(Request $req){
        $pageSize = $req->page_size ?? 10;
        $note = Note::paginate($pageSize);
        return response()->json($note);
    }
    public function createNote(Request $req){
        $note = new Note();
        $note->title = $req->title;
        $note->description = $req->description;
        $note->save();
        return response()->json("note created");
    }
    public function updateNote(Request $req, $id){
        $note = Note::find($id);

        $note->title = $req->title;
        $note->description = $req->description;
        $note->save();
        return response()->json("note updated");
    }
    public function deleteNote($id){
        $note = Note::find($id);
        $note->delete();
        return response()->json("note deleted");
    }
}
