<div class="notes position-relative container-fluid">
    <div class="d-flex list-icons pl-1 pr-1">
        <span class="list-edit-icon" onclick="openListEditModal({{ json_encode($list) }})"><i class="fa fa-edit"></i></span>
        <span class="list-delete-icon" onclick="deleteList({{ $list['id'] }})"><i class="fa fa-trash"></i></span>
    </div>
    <div class="position-relative">
        <a href="{{ route('to-do-lists') }}" class="p-0 m-0 back-button">
            <button class="btn"><i class="fa fa-arrow-left text-white" style="font-size: 18px"></i></button>
        </a>
        <h4 class="page-header col-12 text-break text-lowercase mt-5 ml-1 mr-1"> {{ $list['title'] }} </h4>
    </div>

    <div class="container-fluid mt-4 mb-4 text-center">
        <span class="create-button" onclick="openAddNoteModal()">{{ __('main.create_note_button') }}</span>
    </div>
    @foreach($list['notes'] as $note)
        <div id="note{{ $loop->iteration }}">
        @include('includes.notes.note', ['note' => $note, 'iteration' => $loop->iteration, 'listId' => $list['id']])
        <!-- todo loop iteration ve button değiştirileck -->
        </div>
    @endforeach
</div>
