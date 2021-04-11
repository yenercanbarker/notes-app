<?php


namespace App\Http\Services;

use App\Models\Note;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ToDoListService
{
    public static function validateList(Request $request) {
        return Validator::make($request->all(), [
            'title' => 'required|max:255'
        ]);
    }

    public static function validateEditList(Request $request) {
        return Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255'
        ]);
    }

    public static function validateDeleteList(Request $request) {
        return Validator::make($request->all(), [
            'id' => 'required'
        ]);
    }

    public static function getList($listId) {
        return ToDoList::where('id', $listId)->first();
    }

    public static function createList($list) {
        $listId = ToDoList::create($list)->id;
        User::find(Auth::id())->to_do_lists()->attach($listId);
        return $listId;
    }

    public static function editList($list) {
        return ToDoList::where('id', $list['id'])->update($list);
    }

    public static function deleteList($listId) {
        ToDoListService::deleteNotesBelongsToList(ToDoList::find($listId)->first());
        return ToDoList::destroy($listId);
    }

    public static function deleteNotesBelongsToList($list) {
        $notes = $list->notes()->get();
        foreach ($notes as $note) {
            Note::destroy($note->id);
        }
        $list->notes()->sync([]);
    }
}
