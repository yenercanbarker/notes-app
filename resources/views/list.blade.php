@extends('layouts.app')

@section('content')
    @include('includes.modals.add_note_modal', ['listId' => $list->id])
    @include('includes.modals.edit_note_modal')
    @include('includes.modals.edit_list_modal')

    <div class="container-fluid hero-background"></div>

    <div class="container center-content notes-div">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="">
                    <a href="{{ URL::previous() }}">
                        <button class="btn btn-primary">Go Back</button>
                    </a>
                </div>

                <div class="container border">
                    <div id="listDiv">
                        @include('includes.lists.list', ['list' => $list])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

