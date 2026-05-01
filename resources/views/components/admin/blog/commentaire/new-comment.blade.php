<form id="comment_form" method="POST" action="{{ route('commentaire.save') }}" enctype="multipart/form-data"  class="comment-form">
    <div class="form-content">
        <div class="comment-csrf-token">
            @csrf
        </div>
        <div class="comment-article-id">
            <input type="hidden" name="article_id" value="{{ $article->id }}">
        </div>
        <div class="inputs-content">
            <div class="form-group">
                <textarea name="texte" id="comment_texte" cols="30" rows="1" class="form-control" placeholder="Taper votre commentaire ici ..." required></textarea>
            </div>
            <div class="form-group">
                <label  class="comment-images">
                    <i class="fas fa-paperclip"></i>
                    <i class="comment-uploaded-files-length">
                        <sup>
                            2
                        </sup>
                    </i>
                </label>
                <input type="file" accept="image/*,video/*" name="images[]" id="images" class="comment-images" multiple style="display: none;">
            </div>                     
        </div>
        <div class="submit-bloc">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-sm btn-block" id="comment_submit_button">
                    <span>
                        <i class="fa fa-spinner"></i>
                        <i class="fa fa-paper-plane"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <!-- fin form-content -->
    <div id="comment_files_content">
        <span id="comment_files_content_text">

        </span>
    </div>
    <!-- Bar de progression -->
    <div id="new_comment_files_progress">
        <div id="new_comment_files_progress_content">
            <div class="progress">
                <div class="progress-bar" id="new_comment_files_progressbar" role="progressbar">

                </div>
            </div>    
        </div>
    </div>
    <!-- fin comments-file-content --->
    <div id="comment_feedback_form">
        <span id="comment_feedback_form_text">

        </span>
    </div>
    <!-- fin comments-feedback-form -->
</form>