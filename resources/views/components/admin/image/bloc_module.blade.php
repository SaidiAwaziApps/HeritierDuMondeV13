<div class="component_content">
    <div id="image_bloc">
        <div id="open_button_bloc">
            <a title="Ajouter des images" data-bs-toggle="modal" data-bs-target="#evenement_image_popup">
                <i class="bi bi-image"></i>
            </a>
        </div>  
        <div id="pop_up_bloc">
            @if(!isset($besoin) && !isset($article) && !isset($identite) && !isset($evenement))
               @include('components.image.register')
            @else
               @include('components.image.update')
            @endif
        </div>
    </div>
    <!-- fin image_bloc -->
    <div id="action_image_buttons">
        <!-- Progression -->
        <div class="progress" id="images_progress">
            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar">
        </div>
    </div>  
    <!-- Fin progress -->
    <div class="btn-group">
        <button type="button" class="btn btn-danger btn-sm" id="remove_btn">
            <i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-primary btn-sm" style="cursor: auto;">
            <label for="images" style="cursor: pointer;">
                <i class="fa fa-upload"></i>
            </label>
        </button>
    </div>
    <input type="file" accept="image/*,video/*" name="images[]" id="images" multiple style="display: none;">
</div> 
