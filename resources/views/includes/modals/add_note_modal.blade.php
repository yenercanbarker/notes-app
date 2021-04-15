<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.add_note') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="listId" value="{{ $listId }}">
                <div id="noteTitleDiv">
                    <input type="text" id="noteTitle"  value="" class="form-control"/>
                </div>
                <div id="noteTextDiv">
                    <textarea id="noteText" cols="20" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.close') }}</button>
                <button type="button" class="btn btn-primary" onclick="addNote()">{{ __('main.add_note') }}</button>
            </div>
        </div>
    </div>
</div>
