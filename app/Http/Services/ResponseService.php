<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;

class ResponseService
{
    public static function jsonSuccess($successMessage = "") {
        return Response::json(array('success' => true, 'message' => $successMessage));
    }

    public static function jsonSuccessWithData($successMessage ="", $data = []) {
        return Response::json(array('success' => true, 'message' => $successMessage, 'data' => $data));
    }

    public static function jsonError($erorMessage = "") {
        return Response::json(array('success' => false, 'message' => $erorMessage));
    }

    public static function jsonValidationError(Validator $validator) {
        return Response::json(array(
            'success' => false,
            'errors' => $validator->getMessageBag()->toArray()
        ));
    }

    public static function noteView($note, $noteIteration, $listId) {
        return view('includes.notes.note')->with(['note' => $note, 'iteration' => $noteIteration, 'listId' => $listId]);
    }
}
