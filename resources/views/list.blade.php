@extends('layouts.app')

@section('content')
    @include('includes.modals.add_note_modal', ['listId' => $list->id])
    @include('includes.modals.edit_note_modal')
    @include('includes.modals.edit_list_modal')

    <div class="container border">
        <div class="row justify-content-center">
            <a href="{{ URL::previous() }}">
                <button class="btn btn-primary">Go Back</button>
            </a>
            <button class="btn btn-success" onclick="openAddNoteModal()">Add Note</button>
        </div>
        <div class="container-fluid">
            <div id="listDiv">
                @include('includes.lists.list', ['list' => $list])
            </div>
        </div>
    </div>
@endsection

