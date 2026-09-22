@extends('layouts.guest')

@section('content')

<div class="page-content">

    <!-- =====================================================
         Bloc besoins animées
    ====================================================== -->
    <div class="animate-needs">

        <h6>

            <span>
                Nous apportons de l'aide depuis 2018
            </span>

            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Explicabo iure, natus pariatur, porro eaque maxime consequuntur
            facilis ex numquam alias atque dolor sunt suscipit nulla itaque
            cumque dignissimos! Ut, laboriosam.

        </h6>

        <div class="animate-needs-actions">

            <a
                href="/"
                class="btn btn-success"
            >
                <span>
                    Faire un don
                </span>
            </a>

            <a
                href="/"
                class="btn btn-info"
            >
                <span>
                    Contactez-nous
                </span>
            </a>

        </div>

    </div>


    <!-- =====================================================
         Bloc comment nous aider
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

    </div>


    <!-- =====================================================
         Bloc Situations-Besoins humanitaires
    ====================================================== -->
    <div class="humanitarian-situations-needs">

        <!-- Titre -->
        <h4>
            Situations-Besoins humanitaires
        </h4>

        <!-- Texte -->
        <p>
            Déplacement massif de la population de Sake vers le camp
            de Mugunga suite aux dernières attaques des rebelles,
            il y a urgence.
        </p>

        <!-- Contenu -->
        <div class="humanitarian-situations-needs-content">

            <div class="humanitarian-situations-needs-items">

                @forelse($besoins as $item)

                    <x-guest.besoin.humanitarian-situation-need-item
                        :besoin="$item"
                    />

                @empty

                    <p>
                        Aucun besoin humanitaire disponible pour le moment.
                    </p>

                @endforelse

            </div>

        </div>

    </div>


    <!-- =====================================================
        Bloc statistique
    ====================================================== -->
    <div class="statistique">

        <div class="total-donors">
            <div class="total-donors-img">
                <img src="{{ asset('image/donateur-image.png') }}" alt="Total donateur">
            </div>
            <div class="total-donors-description">
                <p>
                    <span></span><br>
                    Donateur total
                </p>
            </div>    
        </div>

        <div class="total-subscribe-dons">
            <div class="total-subscribe-dons-img">
                <img src="{{ asset('image/don-souscrit-image.png') }}" alt="Total donateur">
            </div>
            <div class="total-subscribe-dons-description">
                <p>
                    <span></span><br>
                    Dons Souscrits
                </p>
            </div>    
        </div>

        <div class="total-volunteer">
            <div class="total-volunteer-img">
                <img src="{{ asset('image/benevoles-image.png') }}" alt="Total donateur">
            </div>
            <div class="total-volunteer-description">
                <p>
                    <span></span><br>
                    Benevoles
                </p>
            </div>    
        </div>

         <div class="total-received-dons">
            <div class="total-received-dons-img">
                <img src="{{ asset('image/don-recu-image.png') }}" alt="Total donateur">
            </div>
            <div class="total-received-dons-description">
                <p>
                    <span></span><br>
                    Benevoles
                </p>
            </div>    
        </div>

    </div>




    <!-- =====================================================
        Bloc Evenements
    ====================================================== -->
    <div class="events">
       
        <!---------------------------------------------------
            Evenements a venir 
        ----------------------------------------------------->
        <div class="upcoming-events">

            <h6> Evenements a venir </h6>

            <div class="upcoming-events-content">

                <div id="upcoming-events-carousel" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicateurs -->
                    <div class="carousel-indicators">
                        @foreach($evenements as $index => $evenement)
                            <button type="button" data-bs-target="#upcoming-events-carousel" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></button>
                        @endforeach
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner">

                        @foreach($evenements as $index => $evenement)
                        <div class="carousel-item @if($index == 0) active @endif">

                            @if($evenement->images)
                            <div class="carousel-item-imgs">
                            
                                @php
                                    $image = $evenement->images[0];
                                @endphp

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
                            @endif

                            <div class="carousel-item-description">
                                <h5>{{ $evenement->titre }}</h5>
                                <p>{{ $evenement->contenu }}</p>
                            </div>
                        </div>
                        @endforeach    

                    </div>

                    <!-- Précédent -->
                    <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#upcoming-events-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>

                    <!-- Suivant -->
                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#upcoming-events-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>

                </div>
                
            </div>

        </div>


        <!--------------------------------------------------------- 
            Tous les evenements (annees) 
        ----------------------------------------------------------->

        <div class="all-events">

            <h6> Nous avons plus de 24 événements chaque année </h6>

            <div class="all-events-content">

                @foreach($evenements as $evenement)
                <div class="all-events-content-item">

                    @if(isset($evenement->images))
                    <div class="all-events-content-item-imgs">

                        @php
                            $image = $evenement->images[0];
                        @endphp

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
                    @endif

                    <div class="all-events-content-item-description">
                        <h6> {{ $evenement->titre }} </h6>
                        <p> {{ $evenement->contenu }} </p>
                    </div>

                </div>
                @endforeach

            </div>
           
        </div> 
       
    </div>




    <!-- =====================================================
        Bloc Benevoles
    ====================================================== -->

    <div class="volunters">

        <h6> rencontrer nos bénévoles </h6>

        <p>
            Entrez en contanct avec les bénévoles qui nous accompagnent tous les jours dans nos interventions. Ils vous donnerons d'amples informations concernant la manière dont vos aides sont accueillis par les bénéficiaires, surtout par les plus vulnérables.
        </p>

        <div class="volunters-content">

            @forelse($benevoles as $benevole)

            <div class="volunters-content-item">
                 
                <!------------------------------------------
                    Image profil 
                 ------------------------------------------->
                <div class="volunters-content-item-img">
                    <img src="{{ asset(Storage::url($benevole->photo)) }}" alt="Profil {{ $benevole->nom }}" class="rounded-thumbnail" style="width: 100%; height: 100%;">
                </div>

                <!------------------------------------------
                    Identite 
                 ------------------------------------------->
                <div class="volunters-content-item-identity">
                    
                </div> 

                <!------------------------------------------
                    Contact 
                 ------------------------------------------->
                <div class="volunters-content-item-contact">
                
                    <ul>
                        <li>
                            <a href="{{ $benevole->sociaux['facebook'] }}" target="_blank">
                                <i class="fa fa-facebook" style="#1877F2"></i>
                            </a>   
                        </li>
                        <li>
                            <a href="{{ $benevole->sociaux['linkedIn'] }}" target="_blank">
                                <i class="fab fa-linkedin" style="#0A66C2"></i>
                            </a>   
                        </li>
                        <li>
                            <a href="{{ $benevole->sociaux['whatsap'] }}" target="_blank">
                                <i class="fa fa-whatsapp" style="#25D366"></i>
                            </a>   
                        </li>
                        <li>
                            <a href="{{ $benevole->sociaux['twitter'] }}" target="_blank">
                                <i class="fa fa-twitter" style="#1DA1F2"></i>
                            </a>   
                        </li>
                    </ul>

                </div>  

            </div>

            @empty

            <div class="volunters-empty-content">
                Aucun benevole a present !!!
            </div>

            @endforelse

        </div>

    </div>





    <!-- =====================================================
        Que disent nos donateurs
    ====================================================== -->

    @if($dons)
    <div class="how-donors-talks">
        <div class="how-donors-talks-explain">
            <h4>Professionnalisme et Dynamisme, nos atouts fars sur terrain.</h4>
            <h6>
                Que disent les donateurs, les benevoles et les beneficiaires
            </h6>
            <p>
                A chaque intervention sur le terrain, nous restons en contact permanent avec nos donateurs; et a ce terme, nous evaluons ensemble l'execution globale de 
                de l'intervention concernee. Nos donateurs s'exprime par notre strategie operatoire,
            </p>
        </div>

        <div class="how-donors-talks-content">
            <div id="how-donors-talks-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($dons as $index => $don)
                    <button type="button" data-bs-target="#how-donors-talks-carousel" data-bs-slide-to="{{ $index }}"
                        class="@if($index == 0) active @endif" aria-current="@if($index == 0) true @else false @endif" aria-label="Slide {{ $index + 1 }}">
                    </button>
                    @endforeach
                </div>

                <div class="carousel-inner">

                    @foreach($dons as $index => $don)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <div class="donor-informations">
                            <div class="donor-profil">
                                <a href="{{ Storage::url($don->donateur->photo) }}" title="Profil {{ $don->donateur->nom }}">
                                    <img src="{{ Storage::url($don->donateur->photo) }}" alt="Profil {{ $don->donateur->nom }}" class="rounded-circle" style="width: 40px; height: 40px;"> 
                                </a>
                            </div>
                            <div class="donor-description">
                                <p>
                                    <span> {{ $don->donateur->nom }} {{ $don->donateur->prenom }} </span>
                                    {{ $don->donateur->qualification }}
                                </p>
                            </div>
                        </div>
                        <div class="donor-talk-text">
                            {{ $don->texte }}
                        </div>
                    </div>
                    @endforeach

                    
                </div>

                <button class="carousel-control-prev" type="button"
                    data-bs-target="#how-donors-talks-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>

                <button class="carousel-control-next" type="button"
                    data-bs-target="#how-donors-talks-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Suivant</span>
               </button>
            </div>

        </div>
    </div>
    @endif



    <!-- =====================================================
        Notre Blog
    ====================================================== -->
    <div class="ours-blog">

        <div class="ours-blog-description">
            <h4>
                Notre Blog
            </h4>

            <p>
                Nous nous proposons d'élargir les objectifs de notre organisation suite à l'évolution et la dégradation permanente de la situation humanitaire du jour au lendemain dans notre pays. Dans le secteur de l'éducation par exemple, plus les années passent, plus un nombre important d'enfants croissent en dehors du circuit éducatif classique. Nous nous proposons de créer plus de centres de formation pour résorber, tant soit peu, cette masse d'enfants en manque d'éducation, socle du développement durable d'une communauté, d'un pays. C'est ici notre lieu d'échange par excellence.
            </p>
        </div>
        
        <div class="ours-blog-content">

            <div class="ours-blog-categories">

                @if ($categories->isNotEmpty())
                <ul>

                    @if($categories->count() > 2)
                    <li>
                        <a href="#">
                            Tout
                        </a>
                    </li>
                    @endif

                    @foreach ($categories->take(3) as $categorie)
                    <li>
                        <a href="#">
                            {{ $categorie->ctg_name }}
                        </a>
                    </li>
                    @endforeach

                    @if($categories->count() > 3)
                    <li>
                        <a href="#">
                            Autres
                        </a>
                    </li>
                    @endif

                </ul>
                @endif

            </div>


            <div class="ours-blog-imgs">
                @foreach($categories as $categorie)
                    @foreach($categorie->articles as $article)
                    <div class="article-item">
                        @foreach($article->images as $image)
                        <div class="article-item-img">
                            @if(strtolower($image->img_source) != 'upload')
                                {!! $image->iframe !!}
                            @elseif(isVideo($image->path))
                            <video autoplay muted loop playsinline width="100%" height="100%">
                                <source src="{{ Storage::url($image->path) }}">
                            </video> 
                            @else
                            <img width="100%" height="100%"
                                src="{{ Storage::url($image->path) }}"
                                alt="{{ $image->titre }}"
                            > 
                            @endif   
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                @endforeach
            </div>


        </div>
    </div>


    <!-- =====================================================
        Nos partenaires
    ====================================================== -->
    <div class="ours-partners">

        <h4>
            Nos partenaires
        </h4>

        <div class="ours-partners-content">
            <div class="ours-partners-item">
                <a href="">
                    
                </a>
            </div>
        </div>
    </div>




</div>

@endsection
