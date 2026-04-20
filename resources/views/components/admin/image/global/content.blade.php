<div class="global-component">
    <div class="img-bloc-module">
        <!-- {{ !isset($article) ? 'Not Exist' : 'Exist' }} -->
        <div class="upload-content">
            @if(!isset($besoin) && !isset($article) && !isset($evenement) && Route::currentRouteName() != 'identite.update_page')
                @include('components.admin.image.upload.register')
            @else
                @include('components.admin.image.upload.update')
            @endif
        </div>

        <div class="vignette-content">
            @if(!isset($besoin) && !isset($article) && !isset($evenement) && Route::currentRouteName() != 'identite.update_page')
                @include('components.admin.image.vignette.register')
            @else
                @include('components.admin.image.vignette.update')
            @endif    
        </div>
    </div>
</div>