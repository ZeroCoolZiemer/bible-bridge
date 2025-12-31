$(document).ready(function() {
    $('#saveNoteBtn').on('click', function() {
        var note = $('#note').val().trim();
        var book = $('#notesModal').data('book');
        var chapter = $('#notesModal').data('chapter');
        var user_id = $('#notesModal').data('user_id');

        if (!note) {
            $('#errorMessage').text('Note cannot be empty.').show();
            setTimeout(function() {
            	$('#errorMessage').fadeOut();
            }, 1000);

            return;
        }
        if (note.length > 500) {
            $('#errorMessage').text('Note must be 500 characters or less.').show();
            return;
        }

        $('#successMessage').hide();
        $('#errorMessage').hide();

        $.ajax({
            url: '/notes.php',
            type: 'POST',
            data: JSON.stringify({ note: note, book: book, chapter: chapter, user_id: user_id }),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#successMessage').text(response.message).show();
                    $('#targetNote').html(note);
                    $('#note').hide();
                    $('#targetNote').show();
                    $('#saveNoteBtn').prop('disabled', true);
                    $('#editNoteBtn').show();
                    $('#editNoteBtn').prop('disabled', false);

                    setTimeout(function() {
                        $('#successMessage').fadeOut();
                    }, 1000);
                } else {
                    $('#errorMessage').text(response.message || 'Unknown error').show();
                    setTimeout(function() {
                        $('#errorMessage').fadeOut();
                    }, 1000);
                }
            },
            error: function(xhr) {
                $('#errorMessage').text('An error occurred while saving the note.').show();
                setTimeout(function() {
                    $('#errorMessage').fadeOut();
                }, 1000);
            }
        });
    });

    $('#editNoteBtn').on('click', function() {
        var currentNote = $('#targetNote').html();
        $('#note').val(currentNote);
        $('#note').show();
        $('#saveNoteBtn').prop('disabled', false);
        $('#targetNote').hide();
        $('#successMessage').hide();
        $('#errorMessage').hide();
        $(this).prop('disabled', true);
    });

    $('#notesModal').on('show.bs.modal', function () {
        var $modal = $(this);
        var book = $modal.data('book');
        var chapter = $modal.data('chapter');
        var user_id = $modal.data('user_id');

        $.ajax({
            url: '/get_note.php',
            type: 'GET',
            data: { book, chapter, user_id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#targetNote').html(response.note || '');
                    $('#note').hide();
                    $('#targetNote').show();
                    $('#editNoteBtn').show();
                    $('#editNoteBtn').prop('disabled', false);
                } else {
                    $('#targetNote').html('No note found for this chapter');
                    $('#note').hide();
                    $('#targetNote').show();
                    $('#editNoteBtn').hide();
                }
            },
            error: function(xhr, status, error) {
                $('#targetNote').html('Error loading note');
                $('#note').hide();
                $('#targetNote').show();
                $('#editNoteBtn').hide();
            }
        });
    });

    $('.chapter-link').on('click', function() {
        var $modal = $('#notesModal');
        var book = $modal.data('book');
        var chapter = $modal.data('chapter');
        var user_id = $modal.data('user_id');

        $.ajax({
            url: '/get_note.php',
            type: 'GET',
            data: { book, chapter, user_id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#targetNote').html(response.note || '');
                    if (response.note) {
                        $('#note').hide();
                        $('#saveNoteBtn').prop('disabled', true);
                    } else {
                        $('#note').show();
                        $('#editNoteBtn').hide();
                    }
                    $modal.modal('show');
                } else {
                    $('#targetNote').html('No note found for this chapter');
                    $('#note').show();
                }
            },
            error: function(xhr, status, error) {
                $('#targetNote').html('Error loading note');
                $('#note').show();
            },
            complete: function() {
                $modal.modal('show');
            }
        });
    });
});