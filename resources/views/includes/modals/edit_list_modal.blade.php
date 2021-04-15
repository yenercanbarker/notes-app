<div class="modal fade" id="editListModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.edit_list') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="listId" value="">
                <div id="listTitleDiv">
                    <input type="text" id="listTitle"  value="" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.close') }}</button>
                <button type="button" class="btn btn-primary" onclick="editList()">{{ __('main.edit_list') }}</button>
            </div>
        </div>
    </div>
</div>
