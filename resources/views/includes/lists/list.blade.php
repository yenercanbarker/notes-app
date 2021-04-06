<div class="container-fluid">
    <h4> Your List is {{ $list['title'] }} </h4><button class="btn btn-danger" onclick="deleteList({{ $list['id'] }})">Delete List </button> <button class="btn btn-outline-primary" onclick="openListEditModal({{ json_encode($list) }})">Edit </button>
    @foreach($list['notes'] as $note)
        <div id="note{{ $loop->iteration }}">
        @include('includes.notes.note', ['note' => $note, 'iteration' => $loop->iteration, 'listId' => $list['id']])
        <!-- todo loop iteration ve button değiştirileck -->
        </div>
    @endforeach
</div>
