@extends('layouts.app')

@section('content')
    <div class="container border">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <h4> Your Notes </h4> <span>
                @foreach($toDoList as $list)
                    <a href="{{ route('list', ['listId' => $list->id]) }}"> <button class="btn btn-outline-danger"> {{ $list->id }} </button> </a>
                @endforeach
                {{ $toDoList->links() }}
            </div>
        </div>
    </div>
@endsection
