<div class="container border">
    <input class="form-check-input" @if($note->status === 'DONE') checked @endif type="checkbox" value="" id="defaultCheck1" onclick="changeNoteStatus({{ $note->id }}, '{{ $note->status }}', {{ $iteration }})">

    <div id="noteDiv{{ $note->id }}" @if($note->status === 'DONE')  class="note-done-div" @endif>
        <h5 id="noteTitle{{ $note->id }}" @if($note->status === 'DONE')  class="note-done" @endif>{{ $note->title }}</h5>
        <div class="row">
            <div class="container">
                <!-- json_encode -->
                <p id="noteText{{ $note->id }}" @if($note->status === 'DONE')  class="note-done" @endif> {{ $note->note }} </p>
            </div>
        </div>
    </div>

</div>
<button class="btn btn-outline-success" onclick="openNoteEditModal({{ json_encode($note) }}, {{ $iteration }})"> Edit </button>
<button class="btn btn-outline-danger" onclick="deleteNote({{ $note->id }}, {{ $listId }})"> Delete </button>

