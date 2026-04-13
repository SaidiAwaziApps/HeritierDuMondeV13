<div class="global-component">
    <!-- Dropdown (Selection model image) -->
    <div class="dropdown">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-bs-toggle="dropdown">
            <a title="Ajouter des images" data-bs-toggle="modal" data-bs-target="#evenement_image_popup">
                <i class="bi bi-image"></i>
            </a>
        </button>
        <!-- Menu (option) -->
        <ul class="dropdown-menu">
            <li>
                Options <i class="fa fa-angle-down"></i>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <button type="button" class="btn btn default btn-sm">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <button type="button" class="btn btn-default btn-sm">
                    <i class="fa fa-network"></i> Vignette
                </button>
            </li>
        </ul>
    </div>


    <!-- Context image -->
    <div class="img-context">
        <div class="upload-imgs">
            <div class="upload-content">
                @if(!isset($besoin) && !isset($article) && !isset($identite) && !isset($evenement))
                    @include('components.image.upload.register')
                @else
                    @include('components.image.upload.update')
                @endif
            </div>
            <!-- fin image_bloc -->
            <div id="upload-actions">
                <!-- Progression -->
                <div class="progress" id="images_progress">
                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar">
                </div>
                <!-- Groupe button -->
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
            </div>
            <!-- fin bloc upload-action -->
            <div class="upload-input">
                <input type="file" accept="image/*,video/*" name="images[]" id="images" multiple style="display: none;">
            </div>    
            <!-- fin upload-input -->
        </div>
        <!-- Fin bloc upload-imgs -->
        <div class="vignette-imgs">
             
        </div>
    </div>
</div>