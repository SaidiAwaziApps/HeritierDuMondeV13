<form method="POST" action="{{ route('objection.save') }}" enctype="multipart/form-data" class="objection-form">
    <div class="form-content">
        <div class="objection-csrf-token">
            @csrf
        </div>
        <div class="objection-commentaire-id">
            <input type="hidden" name="commentaire_id" id="commentaire_id">
        </div>
        <div class="inputs-content">
            <div class="form-group">
                <textarea name="texte" id="reply_texte" cols="30" rows="1" class="form-control" placeholder="Taper votre reponse a ce commentaire ici ..." required></textarea>
            </div>
            <div class="form-group">
                <label class="reply-images">
                    <i class="fas fa-paperclip"></i>
                    <i class="reply-uploaded-files-length" style="color: white;">
                        <sup>
                            0
                        </sup>
                    </i>
                </label>
                <input type="file" name="images[]" id="images" class="reply-images" multiple style="display: none;">
            </div>                     
        </div>
        <div class="submit-bloc">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-sm btn-block" id="reply_submit_button">
                    <span>
                        <i class="fa fa-spinner"></i>
                        <i class="fa fa-paper-plane"></i>
                    </span>
                    
                </button>
            </div>
        </div>
    </div>
    <!-- fin form-content -->
    <div id="reply_files_content">
        <span id="reply_files_content_text">
            
        </span>
    </div>
    <!-- Bar de progression -->
    <div id="new_reply_files_progress">
        <div id="new_reply_files_progress_content">
            <div class="progress">
                <div class="progress-bar" id="new_reply_files_progressbar" role="progressbar">

                </div>
            </div>    
        </div>
    </div>
    <!-- fin bar de progression -->
</form>