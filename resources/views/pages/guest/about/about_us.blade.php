
@extends('layouts.guest')

@section('content')

<div class="page-content">
   
    <!-- =====================================================
        Bloc Titre de la page
    ====================================================== -->
    <div class="page-title">
        <h1>
            A propos de nous
        </h1>
    </div>



    <!-- =====================================================
        Bloc besoins && comment nous aider
    ====================================================== -->
    <div class="needs-how-to-helps-us">

        <div class="needs-how-to-helps-us-content">

            <!-- =====================================================
                1. Bloc besoins (needs)
            ====================================================== -->
            @if($besoins)
            <div class="needs">
            
                <div class="carousel" id="needs-carousel" data-bs-ride="carousel"  data-bs-interval="5000">

                    <div class="carousel-indicators">
                        @foreach($besoins as $index => $besoin)
                        <button type="button" data-bs-target="#needs-carousel" data-bs-slide-to="{{ $index }}" aria-current="@if($index == 0) true @else false @endif" aria-label="Slide {{ $index + 1 }}" class="@if($index == 0) active @endif"></button>
                        @endforeach
                    </div> 

                    <div class="carousel-inner"> 

                        <!----------------------------------------------------
                            Partie Image
                            Contenant le carousel
                        ------------------------------------------------------>
                        
                        @foreach($besoins as $index => $besoin) 
                        <div class="carousel-item @if($index == 0) active @endif"> 
                        
                            @if($besoin->images && $besoin->images->count() > 0)
                            <div class="item-imgs"> 

                                <div class="img">

                                    @php
                                        $image = $besoin->images[0];
                                    @endphp

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

                            </div> <!-- Fin bloc (div) .item-imgs -->    
                            @endif


                            <div class="item-stat">
   
                                @php
                 
                                    $receivedAmountPourcent = oneBesoinDonateStat($besoin)['receivedAmountPourcent'];

                                @endphp
           
                                <div class="pourcent" style="background-color: @if($receivedAmountPourcent >= 75) green ; @elseif($receivedAmountPourcent < 50) brown; @else #0D6EFD;  @endif">
                                    <p> {{ $receivedAmountPourcent }}%</p>
                                </div>

                                <div class="progression">

                                    <div class="progress">
                                         <div class="progress-bar" id="progressbar-{{ $besoin->id }}" role="progressbar" style="width: {{ $receivedAmountPourcent }}%;"></div>
                                    </div>

                                </div>
            
                            </div> <!-- fin div .item-stat -->


                            <div class="item-content"> 

                                <h4 class="d-none d-md-block">
                                    {{ \Illuminate\Support\Str::limit($besoin->intitule, 50, '...') }}
                                </h4>

                                <h4 class="d-block d-md-none">
                                    {{ \Illuminate\Support\Str::limit($besoin->intitule, 30, '...') }}
                                </h4>

                                <div class="item-description">
                                    <p>{{ $besoin->contenu }}</p>
                                </div>

                                <div class="item-actions">

                                    <a  href="/" class="btn btn-success"
                                        data-bs-toggle="popover"
                                        data-bs-placement="bottom"
                                        data-bs-html="true"
                                        data-bs-content="Cliquer pour effectuer un don"
                                    >
                                        Faire un don
                                    </a>

                                    <a  href="/" class="btn btn-info" 
                                        data-bs-toggle="popover"
                                        data-bs-placement="bottom"
                                        data-bs-html="true"
                                        data-bs-content="Cliquer pour plus de details"
                                    >
                                        Détails
                                    </a>

                                </div>

                            </div> <!-- Fin bloc .item-content -->  
                            

                        </div>
                        @endforeach


                    </div>
                     
                </div> <!-- Fin bloc .carousel -->

            </div> <!-- Fin bloc .needs -->
            @endif  

            
            <!-- =====================================================
                2. Bloc comment nous aider (how-to-help-us)
            ====================================================== -->

            <div class="how-to-help-us"> 
            
                <h4>
                    Comment nous aider ?
                </h4>

                <div class="how-to-help-us-content">

                    <!-- Faire un don -->
                    <div class="make-donation">

                        <div class="make-donation-img">

                            <img
                                src="{{ asset('image/make-donation-image.png') }}"
                                alt="Faire un don"
                            >

                        </div>

                        <div class="make-donation-description">

                            <h6>
                                Faire un don
                            </h6>

                            <p>
                                Votre don sauve des vies.
                            </p>

                        </div>

                    </div>


                    <!-- Devenir bénévole -->
                    <div class="become-volunteer">

                        <div class="become-volunteer-img">

                            <img
                                src="{{ asset('image/become-volunteer-image.png') }}"
                                alt="Devenir bénévole"
                            >

                        </div>

                        <div class="become-volunteer-description">

                            <h6>
                                Devenir bénévole
                            </h6>

                            <p>
                                Une bonne occasion pour donner du sourire aux autres.
                            </p>

                        </div>

                    </div>

                    <!-- Partager les informations -->
                    <div class="share-informations">

                        <div class="share-informations-img">

                            <img
                                src="{{ asset('image/share-informations-image.png') }}"
                                alt="Partager les informations"
                            >

                        </div>

                        <div class="share-informations-description">

                            <h6>
                                Partager les infos
                            </h6>

                            <p>
                                Brisez le silence, informez les autres et dénoncez les abus.
                            </p>

                        </div>

                    </div>

                </div> 

            </div> <!-- Fin bloc .how-to-help-us -->

        </div>

    </div>    



    
    <!-- =====================================================
        Bloc statistique
    ====================================================== -->

    <div class="statistique">

        <div class="total-donors">
            <div class="total-donors-img">
                <img src="{{ asset('image/donateur-image.png') }}" class="rounded-thumbnail" alt="Total donateur">
            </div>
            <div class="total-donors-description">
                <p>
                    <span>
                        {{ $donateurs->count() }}
                    </span><br>
                    Donateur total
                </p>
            </div>    
        </div>

        <div class="total-subscribe-dons">
            <div class="total-subscribe-dons-img">
                <img src="{{ asset('image/don-souscrit-image.png') }}" class="rounded-thumbnail" alt="Total donateur">
            </div>
            <div class="total-subscribe-dons-description">
                <p>
                    <span>
                        {{ $dons->whereNull('reception')->count() }}
                    </span><br>
                    Dons Souscrits
                </p>
            </div>    
        </div>

        <div class="total-volunteer">
            <div class="total-volunteer-img">
                <img src="{{ asset('image/benevoles-image.png') }}" class="rounded-thumbnail" alt="Total benevoles">
            </div>
            <div class="total-volunteer-description">
                <p>
                    <span>
                        {{ $benevoles->count() }}
                    </span><br>
                    Benevoles
                </p>
            </div>    
        </div>

         <div class="total-received-dons">
            <div class="total-received-dons-img">
                <img src="{{ asset('image/don-recu-image.png') }}" class="rounded-thumbnail" alt="Total donateur">
            </div>
            <div class="total-received-dons-description">
                <p>
                    <span>
                        {{ $dons->whereNotNull('reception')->count() }}
                    </span><br>
                    Dons recus
                </p>
            </div>    
        </div>

    </div> <!-- Fin bloc .statistique -->




    <!-- =====================================================
        Bloc questionnements && evenements
    ====================================================== -->

    <div class="questions-events">
         
        <!-- =================================
            Questions
        ====================================== -->

        <div class="questions">
        
            <h4>
                Questions fréquement posées
            </h4>

            <div class="questions-content">
            
                
                <div class="accordion" id="questionsAccordion" style="border: none;">
 
                    @foreach($questionnements as $index => $questionnement)
                    <div class="accordion-item">

                        <h2 class="accordion-header">
                            <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $index }}"
                                aria-expanded="true"
                                aria-controls="collapse-{{ $index }}"
                                data-bs-toggle="popover"
                                data-bs-trigger="hover focus"
                                data-bs-placement="top"
                                data-bs-content="Plus d'informations"
                            >
                                {{ strtoupper($questionnement->question) }}
                            </button>
                        </h2>

                        <div
                            id="collapse-{{ $index }}"
                            class="accordion-collapse collapse"
                            data-bs-parent="#questionsAccordion"
                        >
                            <div class="accordion-body">
                                {{ $questionnement->reponse }}
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div> <!-- Fin .accordion  -->


            </div>

        </div> <!-- Fin bloc questions -->



        <!-- =================================
            Events (Evenements)
        ====================================== -->

        <div class="events">

            <h4>
                Nous avons plus de 24 événements chaque année
            </h4>

            <div class="events-content">

                @foreach($evenements as $evenement)
                <div class="events-content-item">

                    @if(isset($evenement->images))
                    <div class="events-content-item-imgs">

                        <div id="events-content-item-imgs-carousel-{{ $evenement->id }}" class="carousel slide all-events-content-item-imgs-carousel"
                            data-bs-ride="carousel"
                            data-bs-interval="4000"
                        >

                            <!-- Indicateurs -->
                            <!-- <div class="carousel-indicators">
                                @foreach($evenement->images as $index => $image)
                                    <button type="button" data-bs-target="#all-events-content-item-imgs-carousel-{{ $evenement->id }}" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></button>
                                @endforeach
                            </div> -->

                            <div class="carousel-inner">

                                @foreach($evenement->images as $index => $image)
                                <div class="carousel-item @if($index == 0) active @endif">

                                    @if (strtolower($image['img_source']) != 'upload')
                                        {!! $image['iframe'] !!}
                                    @elseif (isVideo($image['path']))
                                        <video autoplay muted loop playsinline width="100%" height="100%">
                                            <source src="{{ Storage::url($image['path']) }}">
                                        </video>
                                    @else
                                        <img
                                            width="100%"
                                            height="100%"
                                            src="{{ Storage::url($image['path']) }}"
                                            alt="{{ $image['titre'] }}"
                                        >
                                    @endif
                                    
                                </div>
                                @endforeach

                            </div>

                        </div>    

                    </div>
                    @endif

                    <div class="events-content-item-description">
                    
                        <h4 class="d-none d-md-block"> {{ \Illuminate\Support\Str::limit($evenement->titre, 50, '...') }} </h4>
                        <h4 class="d-block d-md-none"> {{ \Illuminate\Support\Str::limit($evenement->titre, 30, '...') }} </h4>

                        <div class="events-item-description-content">
                        
                            <div class="events-item-description-content-infos">

                                <ul class="list-group">

                                    <li> <i class="fa fa-map-marker-alt"></i> {{ $evenement->lieu }} </li>

                                    <li> <i class="fas fa-calendar"></i> @if(strtolower($evenement->type) == 'journalier') {{ \Carbon\Carbon::parse($evenement->date_du_jour)->format('d/m/Y') }} @else {{ \Carbon\Carbon::parse($evenement->periode_date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($evenement->periode_date_fin)->format('d/m/Y') }} @endif <li>

                                    <li> <i class="fas fa-clock"></i> @if(strtolower($evenement->type) == 'journalier') {{ \Carbon\Carbon::parse($evenement->date_du_jour)->format('H:i') }} @else {{ \Carbon\Carbon::parse($evenement->periode_date_debut)->format('H:i') }} a {{ \Carbon\Carbon::parse($evenement->periode_date_fin)->format('H:i') }} @endif <li>

                                </ul>

                            </div>

                            <div class="events-item-description-content-details">
                                    
                                <a  href="" class="btn btn-info btn-sm"
                                    data-bs-toggle="popover"
                                    data-bs-placement="top"
                                    data-bs-html="true"
                                    data-bs-content="Cliquer pour plus de details"
                                >
                                    Details
                                </a>

                            </div>  

                        </div>
                        
                    </div> <!-- Fin bloc events-content-item-description -->

                </div>
                @endforeach


                @if($evenements->count() > 4)
                <div class="events-more-items-actions">

                    <a  href="#" class="btn btn-default btn-sm"
                        data-bs-toggle="popover"
                        data-bs-placement="top"
                        data-bs-html="true"
                        data-bs-content="Cliquer pour consulter plus de besoins"
                    >
                        <i class="fa fa-plus"></i> Afficher plus
                    </a>

                </div>
                @endif
                 
            </div> <!-- fin bloc events-content -->

        </div> <!-- Fin bloc events (evenements) -->
        
    </div> <!-- fin bloc questions-events (Questionnements && evenements) -->


    <!-- Script externe -->
    <script src="{{ asset('script/pages/guest/about/about_us.js') }}"></script> 

</div>    

@endsection    