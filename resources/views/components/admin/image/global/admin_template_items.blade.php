@php
    $model = null;
    if(isset($article) && !empty($article)) {
        $model = $article;  
    } 
    else if(isset($besoin) && !empty($besoin)) {
        $model = $besoin;   
    }
    else if(isset($evenement) && !empty($evenement)) {
        $model = $evenement;
    }
    else if(isset($identite) && !empty($identite)) {
        $model = $identite;
    }
    else {
        $model = null;
    }
@endphp

@if($model->images && count($model->images) > 0)
    <div class="media-images">
        <div class="media-images-content">
            
            @php
                // Images uploadées (chargées depuis le périphérique utilisateur)
                $upload_images = array_filter($model->images->toArray(), function ($item) {
                    return $item['img_source'] === 'upload';
                });

                // Images provenant d'une plateforme (vignette / iframe)
                $platform_images = array_filter($model->images->toArray(), function ($item) {
                    return $item['img_source'] === 'vignette';
                });
            @endphp

            <!-- Upload images -->
            @if($upload_images && count($upload_images) > 0)
                <!-- Existance des instances images -->
                <div class="upload-images">
                    <h6>
                        <i class="fa fa-images"></i> Upload
                    </h6>
                    <div class="upload-images-content">
                        @foreach($upload_images as $image)
                            <div class="img-item">
                                @if(isVideo($image['path']))
                                    <video class="rounded-thumbnail cover" alt="Image media" style="width: 100%;height: 100%;" controls>
                                        <source src="{{ Storage::url($image['path']) }}">
                                    </video>
                                @else
                                    <a href="{{ Storage::url($image['path']) }}" title="Afficher image d'entete">
                                        <img src="{{ Storage::url($image['path']) }}" class="rounded-thumbnail cover" alt="Image" style="width: 100%;height: 100%;">
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif    

            <!-- Images depuis une platforme (vignettes) -->
            @if($platform_images && count($platform_images) > 0)
                <div class="platform-images">
                    <h6>
                        <i class="fa fa-globe"></i> Platform
                    </h6>
                    <div class="platform-images-content">
                        @foreach($platform_images as $image)
                           <div class="vgn-item">
                               {!! $image['iframe'] !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif   

        </div>
    </div>
    <!-- fin media-images -->
@endif
