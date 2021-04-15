$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function openAddListModal() {
    $("#addListModal").modal();
}

function openAddNoteModal() {
    $("#addNoteModal").modal();
}

function openNoteEditModal(note, noteIteration) {
    clearValidationErrors();
    $("#editNoteModal").modal();
    $("#noteTextDiv #editNoteText").val(note.note);
    $("#noteTitleDiv #editNoteTitle").val(note.title);
    $("#noteListId").val(note.title);
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
                    url: "/list/show/" + $("#listId").val(),
                    type: "get",
                    success: function (response) {
                        $("#listDiv").empty();
                        $("#listDiv").html(
                            response
                        );
                        $("#addNoteModal").modal('hide');
                        $("#noteText").val("");
                        $("#noteTitle").val("");
                        alert("New note added");
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
            'note': $("#editNoteText").val(),
            'title': $("#editNoteTitle").val()
        }, success: function (response) {
            if (response.success) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/note/show/" + id + "/" + iteration,
                    type: "get",
                    success: function (response) {
                        $("#note" + iteration).empty();
                        $("#note" + iteration).html(
                            response
                        );
                        $("#editNoteModal").modal('hide');
                        $("#editNoteText").val("");
                        $("#editNoteTitle").val("");
                        alert("Note edited added");
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

function addList() {
    clearValidationErrors();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/list/create",
        type: "post",
        data: {
            'title': $("#listTitle").val()
        }, success: function (response) {
            if(response.success) {
                window.location.href = response.data.url;
            } else {
                if (response.errors.title) {
                    $("#listTitle").addClass('is-invalid');
                    $("#listTitle").after('<span id="noteTitleSpan" class="invalid-feedback" role="alert"> <strong>' + response.errors.title + '</strong> </span>')
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

                        $("#editListModal").modal('hide');
                        $("#listTitle").val("");
                        alert("List edited");
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

function deleteList(listId) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/list/delete",
        type: "post",
        data: {
            'id': listId
        }, success: function (response) {
            if (response.success) {
                window.location.href = "/to-do-lists";
            } else {
                alert("Something went wrong");
            }
        },
    });
}

function deleteNote(noteId, listId) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/note/delete",
        type: "post",
        data: {
            'listId': listId,
            'noteId': noteId
        }, success: function (response) {
            if (response.success) {
                $("#noteDiv" + noteId).remove();
                alert("Note deleted");
            } else {
                alert("Something went wrong");
            }
        },
    });
}

function changeNoteStatus(noteId, noteStatus, noteIteration) {
    var isNoteDone;
    if(noteStatus === 'NEW') {
        noteStatus = 'DONE';
        isNoteDone = 1;
    } else {
        noteStatus = 'NEW';
        isNoteDone = 0;
    }

    if(isNoteDone === 1) {
        $("#noteDiv" + noteId).addClass("note-done-div");
        $("#noteTitle" + noteId).addClass("note-done");
        $("#noteText" + noteId).addClass("note-done");
        alert("Well done, great job");
    } else {
        $("#noteDiv" + noteId).removeClass("note-done-div");
        $("#noteTitle" + noteId).removeClass("note-done");
        $("#noteText" + noteId).removeClass("note-done");
        alert("You'll do this, there is no doubt");
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/note/change-status",
        type: "post",
        data: {
            'id': noteId,
            'status': noteStatus,
        }, success: function (response) {
            if (response.success) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/note/show/" + noteId + "/" + noteIteration,
                    type: "get",
                    success: function (response) {
                        $("#note" + noteIteration).empty();
                        $("#note" + noteIteration).html(
                            response
                        );
                    }
                });
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
