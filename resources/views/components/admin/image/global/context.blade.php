<div class="global-component">
    <!-- Dropdown (Selection model image) -->
    <div class="dropdown" id="img-menu">
        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" title="Appuyer inserer des images" id="open_popup_btn">
            <i class="bi bi-image"></i>
        </button>
        <!-- Menu (option) -->
        <ul class="dropdown-menu">
            <li>
                Options <i class="fa fa-angle-down"></i>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <div class="d-grid">
                    <button type="button" class="btn btn default btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#evenement_image_popup"  title="Cliquer pour uploader les images">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </div>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <div class="d-grid">
                    <button type="button" class="btn btn-default btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#vignette_image_popup" title="Cliquer pour inserer des images depuis une plateforme">
                        <i class="fa fa-globe"></i> Platform
                    </button>
                </div>
            </li>
        </ul>
    </div>


    <!-- Context image -->
    <div class="img-context">
        <div class="upload-inputs">
            <input type="file" accept="image/*,video/*" name="images[]" id="images" multiple style="display: none;">
        </div>  
        <div class="vignette-inputs">
                
        </div>   
    </div>
</div>