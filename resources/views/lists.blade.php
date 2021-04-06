@extends('layouts.app')

@section('content')
    @include('includes.modals.add_list_modal')

    <div class="container border">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <h4> Your Lists </h4> <button class="btn btn-outline-info" onclick="openAddListModal()"> + NEW </button>
                @foreach($toDoList as $list)
                    <div class="d-flex">
                        <div class="container">
                            <a href="{{ route('list', ['listId' => $list->id]) }}"> <button class="btn btn-outline-danger"> {{ $list->id }} </button> </a>
                            <button class="btn btn-dark" onclick="deleteList({{$list->id}})"> Delete </button>
                        </div>
                    </div>
                @endforeach
                {{ $toDoList->links() }}
            </div>
        </div>
    </div>
@endsection
