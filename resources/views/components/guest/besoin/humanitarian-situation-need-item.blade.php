<div class="global-component">

    <div class="humanitarian-situation-need-item">

        <!----------------------------------------------------
            Partie Image
            Contenant le carousel
        ------------------------------------------------------>
        <div class="item-img">

            @if($besoin->images && $besoin->images->count() > 0)

                <div
                    id="humanitarian-situation-need-item-carousel-{{ $besoin->id }}"
                    class="carousel slide"
                    data-bs-ride="carousel"
                >

                    <!------------------------------------------------
                        Contenu du carousel
                    ------------------------------------------------->
                    <div class="carousel-inner">

                        @foreach($besoin->images as $index => $image)

                            <div
                                class="carousel-item @if($index === 0) active @endif"
                            >

                                {{-- Image provenant d'une source externe --}}
                                @if(strtolower($image->img_source) !== 'upload')

                                    {!! $image->iframe !!}


                                {{-- Image uploadée --}}
                                @elseif(!$image->is_video)

                                    <img
                                        src="{{ Storage::url($image->path) }}"
                                        class="d-block w-100 cover"
                                        alt="{{ $image->titre ?? $besoin->intitule }}"
                                    >


                                {{-- Vidéo uploadée --}}
                                @else

                                    <video
                                        autoplay
                                        muted
                                        loop
                                        playsinline
                                        width="100%"
                                        height="100%"
                                    >
                                        <source
                                            src="{{ Storage::url($image->path) }}"
                                        >

                                        Votre navigateur ne supporte pas
                                        la lecture des vidéos.
                                    </video>

                                @endif

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>

        <div class="item-stat">
            <div class="pourcent"><p>0%</p></div>
            <div class="progress">
                <div class="progress-bar" id="progressbar-{{ $besoin->id }}" role="progressbar"></div>
            </div>
        </div>

        <div class="item-content">

            <h4 class="d-none d-md-block">
                {{ \Illuminate\Support\Str::limit($besoin->intitule, 50, '...') }}
            </h4>

            <h4 class="d-block d-md-none">
                {{ \Illuminate\Support\Str::limit($besoin->intitule, 30, '...') }}
            </h4>

            <div class="item-description"><p>{{ $besoin->contenu }}</p></div>

            <div class="item-actions">
                <a href="/" class="btn btn-success" title="Cliquer pour effectuer un don">Faire un don</a>
                <a href="/" class="btn btn-info" title="Cliquer pour plus de details">Détails</a>
            </div>
            
        </div>

    </div>
    
</div>