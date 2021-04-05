$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function openAddNoteModal() {
    $("#addNoteModal").modal();
}

function openNoteEditModal(note, noteIteration) {
    clearValidationErrors();
    $("#editNoteModal").modal();
    $("#noteText").val(note.note);
    $("#noteTitle").val(note.title);
    $("#noteId").val(note.id);
    $("#noteDivId").val(noteIteration);
}

function openListEditModal(list) {
    clearValidationErrors();
    $("#editListModal").modal();
    $("#listId").val(list.id);
    $("#listTitle").val(list.title);
}

function addNote() {
    clearValidationErrors();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/list/" + $("#listId").val() + "/note/add",
        type: "post",
        data: {
            'note': $("#noteText").val(),
            'title': $("#noteTitle").val()
        }, success: function (response) {
            if (response.success) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/list/show/" + id,
                    type: "get",
                    success: function (response) {
                        alert("okey");
                    }
                });
            } else {
                if (response.errors.title) {
                    $("#noteTitle").addClass('is-invalid');
                    $("#noteTitle").after('<span id="noteTitleSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.title + '</strong> </span>')
                }

                if (response.errors.note) {
                    $("#noteText").addClass('is-invalid');
                    $("#noteText").after('<span id="noteTextSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.note + '</strong> </span>')
                }
            }
        },
    });
}

function editNote() {
    clearValidationErrors();
    var id = $("#noteId").val();
    var iteration = $("#noteDivId").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/note/edit",
        type: "post",
        data: {
            'id': id,
            'note': $("#noteText").val(),
            'title': $("#noteTitle").val()
        }, success: function (response) {
            if (response.success) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/note/show/" + id + "/" + iteration,
                    type: "get",
                    success: function (response) {
                        $("#note" + $("#noteDivId").val()).empty();
                        $("#note" + $("#noteDivId").val()).html(
                            response
                        );
                    }
                });
            } else {
                if (response.errors.title) {
                    $("#noteTitle").addClass('is-invalid');
                    $("#noteTitle").after('<span id="noteTitleSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.title + '</strong> </span>')
                }

                if (response.errors.note) {
                    $("#noteText").addClass('is-invalid');
                    $("#noteText").after('<span id="noteTextSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.note + '</strong> </span>')
                }
            }
        },
    });
}

function editList() {
    clearValidationErrors();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/list/edit",
        type: "post",
        data: {
            'id': $("#listId").val(),
            'title': $("#listTitle").val()
        }, success: function (response) {
            if (response.success) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/list/show/" + $("#listId").val(),
                    type: "get",
                    success: function (response) {
                        $("#listDiv").empty();
                        $("#listDiv").html(response);
                    }
                });
            } else {
                if (response.errors.title) {
                    $("#listTitle").addClass('is-invalid');
                    $("#listTitleDiv").append('<span id="listTitleSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.title + '</strong> </span>')
                }
            }
        },
    });
}


function clearValidationErrors() {
    $("#noteTitle").removeClass('is-invalid');
    $("#noteText").removeClass('is-invalid');
    $("#listTitle").removeClass('is-invalid');
    $("#listTitleSpan").remove();
    $("#noteTitleSpan").remove();
    $("#noteTextSpan").remove();
}
