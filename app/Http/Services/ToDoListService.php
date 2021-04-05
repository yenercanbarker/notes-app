<?php


namespace App\Http\Services;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToDoListService
{
    public static function validateList(Request $request) {
        return Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255'
        ]);
    }

    public static function editList($list) {
        return ToDoList::where('id', $list['id'])->update($list);
    }

    public static function getList($listId) {
        return ToDoList::where('id', $listId)->first();
    }
}
