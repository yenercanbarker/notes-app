@extends('layouts.app')

@section('content')
    @include('includes.modals.add_list_modal')

    <div class="container-fluid hero-background"></div>

    <div class="container center-content lists-div p-0">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <h4 class="page-header"> your lists. </h4>
                <div class="container-fluid mt-4 mb-4 text-center">
                   <span class="create-button" onclick="openAddListModal()"> create a new one </span>
                </div>

                <div class="row to-do-lists mt-3 mb-3">
                    @php($a = 0)
                    @foreach($toDoList as $list)
                        @php($a++)
                        <div class="container col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="position-relative">
                                <a href="{{ route('list', ['listId' => $list->id]) }}" class="text-decoration-none text-white">
                                <div class="card">
                                    <div class="card-body p-0 to-do-list-mini">
                                        <div class="pt-4 pl-4 pr-4 pb-2 to-do-list-header">
                                            {{ $list->title }}
                                        </div>
                                        <div class="text-right p-2">{{ $list->created_at }}</div>
                                    </div>
                                </div>
                                </a>
                                <button class="delete-button text-center" onclick="deleteList({{$list->id}})">X</button>
                            </div>
                        </div>
                        @if($a % 3 == 0)
                            <div class="col-12 mt-md-3 mt-mb-3"></div>
                        @endif
                    @endforeach
                </div>

                <div class="container-fluid pagination-div">
                    {{ $toDoList->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
