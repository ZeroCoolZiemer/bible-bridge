<div id="notesModal" data-book="{$row[$bookColumn]}" data-chapter="{$chapter}" data-user_id="{$smarty.session.user}" class="modal fade" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notesModalLabel">{$row[$bookColumn]} {$chapter} - Notes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="targetNote"></p>
                    <textarea id="note" class="form-control" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                <div id="successMessage" style="display: none; color: green;"></div>
		<div id="errorMessage" style="display: none; color: red;"></div>
                    <button type="button" id="editNoteBtn" class="btn btn-sm btn-primary">EDIT</button>
                    <button type="button" id="saveNoteBtn" class="btn btn-sm btn-dark">SAVE</button>
                </div>
            </div>
        </div>
    </div>