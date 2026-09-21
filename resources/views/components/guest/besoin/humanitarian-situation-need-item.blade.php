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
                        Indicateurs du carousel
                    ------------------------------------------------->
                    <div class="carousel-indicators">

                        @foreach($besoin->images as $index => $image)

                            <button
                                type="button"
                                data-bs-target="#humanitarian-situation-need-item-carousel-{{ $besoin->id }}"
                                data-bs-slide-to="{{ $index }}"
                                class="@if($index === 0) active @endif"
                                aria-current="@if($index === 0) true @else false @endif"
                                aria-label="Slide {{ $index + 1 }}"
                            ></button>

                        @endforeach

                    </div>


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


                    <!------------------------------------------------
                        Bouton précédent
                    ------------------------------------------------->
                    @if($besoin->images->count() > 1)

                        <button
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#humanitarian-situation-need-item-carousel-{{ $besoin->id }}"
                            data-bs-slide="prev"
                        >
                            <span
                                class="carousel-control-prev-icon"
                                aria-hidden="true"
                            ></span>

                            <span class="visually-hidden">
                                Précédent
                            </span>
                        </button>


                        <!------------------------------------------------
                            Bouton suivant
                        ------------------------------------------------->
                        <button
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#humanitarian-situation-need-item-carousel-{{ $besoin->id }}"
                            data-bs-slide="next"
                        >
                            <span
                                class="carousel-control-next-icon"
                                aria-hidden="true"
                            ></span>

                            <span class="visually-hidden">
                                Suivant
                            </span>
                        </button>

                    @endif

                </div>

            @endif

        </div>


        <!----------------------------------------------------
            Partie Statistique
        ------------------------------------------------------>
        <div class="item-stat">

            <div class="stat-pourcent">
                0%
            </div>

            <div class="progress">

                <div
                    class="progress-bar"
                    id="progressbar-{{ $besoin->id }}"
                    role="progressbar"
                    style="width: 0%;"
                    aria-valuenow="0"
                    aria-valuemin="0"
                    aria-valuemax="100"
                ></div>

            </div>

        </div>


        <!----------------------------------------------------
            Partie Contenu
        ------------------------------------------------------>
        <div class="item-content">

            <h4>
                {{ $besoin->intitule }}
            </h4>


            <div class="item-description">

                <p>
                    {{ $besoin->description }}
                </p>

            </div>


            <div class="item-actions">

                <a
                    href="/"
                    class="btn btn-success"
                >
                    Faire un don
                </a>

                <a
                    href="/"
                    class="btn btn-info"
                >
                    Détails
                </a>

            </div>

        </div>

    </div>

</div>
