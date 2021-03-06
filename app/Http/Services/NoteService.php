<?php


namespace App\Http\Services;

use App\Models\Note;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NoteService
{
    public static function validateAddNote(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|max:255',
            'note' => 'required'
        ]);
    }

    public static function validateEditNote(Request $request)
    {
        return Validator::make($request->all(), [
            'id' => 'required|int',
            'title' => 'required|max:255',
            'note' => 'required'
        ]);
    }

    public static function validateDeleteNote(Request $request)
    {
        return Validator::make($request->all(), [
            'noteId' => 'required|int',
            'listId' => 'required|int'
        ]);
    }

    public static function validateChangeStatusNote(Request $request)
    {
        return Validator::make($request->all(), [
            'id' => 'required|int',
            'status' => 'required'
        ]);
    }

    public static function createNote($note, $listId)
    {
        $list = ToDoList::find($listId);
        $noteId = Note::create($note)->id;
        $list->notes()->attach($noteId);
        if ($list->notes->contains($noteId)) {
            return true;
        } else
            return false;
    }

    public static function editNote($note)
    {
        return Note::where('id', $note['id'])->update($note);
    }

    public static function deleteNote($note)
    {
        $list = ToDoList::find($note['listId'])->first();
        $list->notes()->detach($note['noteId']);
        return Note::find($note['noteId'])->delete();
    }

    public static function getNote($noteId)
    {
        return Note::where('id', $noteId)->first();
    }

    public static function changeStatusNote($note)
    {
        return Note::where('id', $note['id'])->update(['status' => $note['status']]);
    }
}
