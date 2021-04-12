<div class="col-12 notes">
    <h4 class="page-header col-12 text-break text-lowercase"> {{ $list['title'] }}. </h4><button class="btn btn-danger" onclick="deleteList({{ $list['id'] }})">Delete List </button> <button class="btn btn-outline-primary" onclick="openListEditModal({{ json_encode($list) }})">Edit </button>
    <div class="container-fluid mt-4 mb-4 text-center">
        <button class="btn create-button" onclick="openAddNoteModal()">create a note</button>
    </div>
    @foreach($list['notes'] as $note)
        <div id="note{{ $loop->iteration }}">
        @include('includes.notes.note', ['note' => $note, 'iteration' => $loop->iteration, 'listId' => $list['id']])
        <!-- todo loop iteration ve button değiştirileck -->
        </div>
    @endforeach
</div>
