<?php

namespace App\Http\Controllers;

use App\Http\Services\NoteService;
use App\Http\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creates a note.
     * @param Request $request
     *
     * @param $listId
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request, $listId) {
        $validateAddNote = NoteService::validateAddNote($request);
        if($validateAddNote->fails()) {
            return ResponseService::jsonValidationError($validateAddNote);
        }

        if(NoteService::createNote($validateAddNote->validated(), $listId)) {
            return ResponseService::jsonSuccess('mesaj eklendi');
        }
        return ResponseService::jsonError('hata oluştu');
    }

    /**
     * Returns the note.
     * @param int $noteId
     * @param int $noteIteration
     * @return Application|Factory|View
     */
    public function show($noteId, $noteIteration) {
        $list = DB::table("note_to_do_list")->where('note_id', $noteId)->first();
        return ResponseService::noteView(NoteService::getNote($noteId), $noteIteration, $list->to_do_list_id);
    }

    /**
     * Edits the note.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function edit(Request $request) {
        $validateNote = NoteService::validateEditNote($request);
        if ($validateNote->fails()) {
            return ResponseService::jsonValidationError($validateNote);
        }

        if(NoteService::editNote($validateNote->validated())){
            return ResponseService::jsonSuccess('mesaj düzenlendi');
        }
        return ResponseService::jsonError('mesaj düzenlenirken hata oluştu');
    }

    /**
     * Deletes the note.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function delete(Request $request) {
        $validateNote = NoteService::validateDeleteNote($request);
        if ($validateNote->fails()) {
            return ResponseService::jsonValidationError($validateNote);
        }

        if(NoteService::deleteNote($validateNote->validated())){
            return ResponseService::jsonSuccess('mesaj silindi');
        }
        return ResponseService::jsonError('mesaj silinirken hata oluştu');
    }

    /**
     * Deletes the note.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function changeStatus(Request $request) {
        $validateNote = NoteService::validateChangeStatusNote($request);
        if ($validateNote->fails()) {
            return ResponseService::jsonValidationError($validateNote);
        }

        if(NoteService::changeStatusNote($validateNote->validated())){
            return ResponseService::jsonSuccess('mesaj statü değiştirildi');
        }
        return ResponseService::jsonError('mesaj statü değiştirilirken hata oluştu');
    }
}
