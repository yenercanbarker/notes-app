<div class="container border">
    <h5>{{ $note->title }}</h5>
    <div class="row">
        <div class="container">
            <!-- json_encode -->
            <p> {{ $note->note }} </p>
        </div>
    </div>
</div>
<button class="btn btn-outline-success" onclick="openNoteEditModal({{ json_encode($note) }}, {{ $iteration }})"> Edit </button>
<button class="btn btn-outline-danger" onclick="deleteNote({{ $note->id }}, {{ $listId }})"> Delete </button>

