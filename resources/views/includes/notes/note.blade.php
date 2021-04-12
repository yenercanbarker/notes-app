<div class="container">
    <div id="noteDiv{{ $note->id }}" @if($note->status === 'DONE')  class="note-done-div" @endif class="card mb-3 ml-3" style="position:relative;">
        <div id="noteTitle{{ $note->id }}" @if($note->status === 'DONE')  class="note-done" @endif class="card-header">
            <span class="text-break">
                {{ $note->title }} ASDASJHKDGASJDGASJDGASKJDGASHJDASGHDASDASJHKDGASJDGASJDGASKJDGASHJDASGHDASDASJHKDGASJDGASJDGASKasd
            </span>
            <span class="d-inline border float-right note-icons-div">
                <div class="d-flex flex-column pr-1 pl-1 note-icons">
                    <span class="note-done-icon" onclick="changeNoteStatus({{ $note->id }}, '{{ $note->status }}', {{ $iteration }})"><i class="fa fa-check-circle"></i></span>
                    <span class="note-edit-icon" onclick="openNoteEditModal({{ json_encode($note) }}, {{ $iteration }})"><i class="fa fa-edit"></i></span>
                    <span class="note-delete-icon" onclick="deleteNote({{ $note->id }}, {{ $listId }})"><i class="fa fa-trash"></i></span>
                </div>
            </span>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p id="noteText{{ $note->id }}" @if($note->status === 'DONE')  class="note-done" @endif> {{ $note->note }} </p>
                <footer class="blockquote-footer"> <cite title="Source Title">{{ $note->created_at }}</cite></footer>
            </blockquote>
        </div>
    </div>
</div>


