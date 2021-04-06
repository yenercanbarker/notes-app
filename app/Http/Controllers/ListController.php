<?php

namespace App\Http\Controllers;

use App\Http\Services\ResponseService;
use App\Http\Services\ToDoListService;
use App\Models\ToDoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creates a list.
     * @param Request $request
     *
     * @throws ValidationException
     */
    public function create(Request $request) {
        $validateList = ToDoListService::validateList($request);
        if($validateList->fails()) {
            return ResponseService::jsonValidationError($validateList);
        } else {
            $listId = ToDoListService::createList($validateList->validated());
            if(null !== $listId) {
                return ResponseService::jsonSuccessWithData('eklendi', ['url' => route('list', $listId)]);
            }
        }
        return null;
    }

    /**
     * Returns the list.
     * @param int $listId
     * @return \Illuminate\Contracts\View\View
     */
    public function index($listId) {
        $list = ToDoList::getList($listId);
        return view('list')->with(['list' => $list]);
    }

    /**
     * Returns the list.
     * @param int $listId
     * @return \Illuminate\Contracts\View\View
     */
    public function show($listId) {
        $list = ToDoList::getList($listId);
        return view('includes.lists.list')->with(['list' => $list]);
    }

    /**
     * Updates the list.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function edit(Request $request) {
        $validateList = ToDoListService::validateEditList($request);
        if($validateList->fails()) {
            return ResponseService::jsonValidationError($validateList);
        }

        if(ToDoListService::editList($validateList->validated())){
            return ResponseService::jsonSuccess('liste düzenlendi');
        }
        return ResponseService::jsonError('liste düzenlenirken hata oluştu');
    }

    /**
     * Deletes the list.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function delete(Request $request) {
        $validateList = ToDoListService::validateDeleteList($request);
        if($validateList->fails()) {
            return ResponseService::jsonValidationError($validateList);
        }

        if(ToDoListService::deleteList($validateList->validated())) {
            return ResponseService::jsonSuccess('liste silindi');
        }
        return ResponseService::jsonError('liste düzenlenirken hata oluştu');
    }
}
