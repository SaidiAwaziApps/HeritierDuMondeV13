<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">
    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dependance/highcharts/highcharts.js') }}"></script>

    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('style/pages/admin/home/admin.css') }}">
</head>

@php
    $user = auth()->user();
@endphp

<body>
    <!-- Bar de navigation -->
    <nav class="navbar">
        <!-- Logo du site -->
        <div class="logo">
            <img src="{{ Storage::url($identite->logo) }}" alt="Logo de l'organisation">
            <span>{{ $identite->nom }}</span>
        </div>

        <!-- Icons reseaux sociaux -->
        <div class="social-icons">
            <ul>
                <li>
                    <a href="{{ $identite->sociaux?->facebook }}" title="Aller sur facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $identite->sociaux?->twitter }}" title="Aller sur twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $identite->sociaux?->google }}" title="Aller sur google">
                        <i class="bi bi-google"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $identite->sociaux?->instagram }}" title="Aller sur instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </li>
            </ul>    
        </div>
        
        <!-- Infos pour le compte (utilisateur) -->
        <div class="user-infos">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ $user->photo ? Storage::url($user->photo) : '' }}" class="rounded-circle" style="width: 40px;height: 40px;">
                        <span> {{ $user->nom }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <img src="{{ $user->photo ? Storage::url($user->photo) : '' }}" class="rounded-circle" style="width: 24px;height: 24px;">
                            Options <i class="bi bi-chevron-down"></i>
                        </li>
                        <!-- Admistrateur du site -->
                        @if($user?->hasRole('admin'))
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <div class="d-grid">
                                <a href="#" class="btn btn-default btn-sm" title="Mon profil">
                                    <i class="bi bi-person-fill-gear" style="opacity: 0.5;"></i> My Profil
                                </a>
                            </div>
                        </li>
                       @endif 
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <form method="POST" action="#">
                                @csrf
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning btn-sm btn-block" title="Se deconnecter">
                                        <i class="bi bi-box-arrow-right" style="opacity: 0.6;"></i> Logout
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Section contenu (images && menus) -->
    <section class="content">
        <div class="global-content">
            <div class="home-title">
                <h4>
                    <i class="fa fa-home" style="opacity: 0.6;"></i> Accueil
                </h4>
            </div>
            <!-- Images du site -->
            <div class="img-site">
                <div id="carousel_imgs" class="carousel slide" data-bs-ride="carousel">
                    <!-- Les pointillés -->
                    <div class="carousel-indicators">
                        @foreach($identite->images as $index => $image)
                        <button type="button" data-bs-target="#carousel_imgs" data-bs-slide-to="{{ $index }}" 
                            class="@if($index == 1) active  @endif" 
                            aria-current="{{ $index == 1 }}" aria-label="Slide {{ $index }}">
                        </button>
                        @endforeach
                    </div>
                    <!-- Les slides -->
                    <div class="carousel-inner">
                        @foreach($identite->images as $index => $image)
                        <div class="carousel-item @if($index == 1) active  @endif">
                            @if(strtolower($image['img_source']) == 'upload')
                                <img src="{{ Storage::url($image['path']) }}" class="cover" style="width: 100%; height: 100%;" alt="Image">
                            @else
                                {!! $image['iframe'] !!}
                            @endif    
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Menu (options) -->   
            <div class="options">
                <div class="options-text">
                    <span>
                        <i class="fa fa-list"></i> Options menus
                    </span>    
                </div>
                <div class="options-content">
                    
                    <!-- Menu dashboard && utilisateurs (users) -->
                    <div class="dashboard-users-menu">
                        <div class="dashboard-users-menu-content"> 
                            <a href="{{ route('admin.dashboard.admin') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-signal">

                                            </i><br>
                                            Dashboard
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('admin.user.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-users">

                                            </i><br>
                                            Utilisateurs
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>              
                    </div>
                    <!-- Menu Parametres -->
                    <div class="parameters-menu">
                        <h6>
                            <i class="fa fa-cog"> </i> Parametres
                        </h6>
                        <div class="parameters-menu-content">
                            <!-- Identite -->
                            <a href="{{ route('admin.identite.update_page', ['id' => $identite->id]) }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-globe">

                                            </i><br>
                                            Identite
                                        </span>
                                    </div>
                                </div>
                            </a>  
                            <!-- Questionnement -->
                            <a href="{{ route('admin.questionnement.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fas fa-question-circle">

                                            </i><br>
                                            Questionnement
                                        </span>
                                    </div>
                                </div>
                            </a>  
                            <!-- Payment --> 
                            <a href="{{ $paymentSetting ? route('admin.paymentSetting.update_page',['id' => $paymentSetting->id]) : route('admin.paymentSetting.register_page') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-credit-card">

                                            </i><br>
                                            Payment
                                        </span>
                                    </div>
                                </div>
                            </a>  
                            <!-- Commentaire (Regulation) --> 
                            <a href="{{ $regulation ? route('admin.regulation.update_page', ['id' => $regulation->id]) : route('admin.regulation.register_page') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-envelope">

                                            </i><br>
                                            Commentaire
                                        </span>
                                    </div>
                                </div>
                            </a>  
                        </div>
                    </div> 
                    <!-- Autres menu -->
                    <div class="benevole-donation-menu">
                        <h6>
                            <i class="fa fa-plus"></i> Donation & Benevole
                        </h6>
                        <div class="benevole-donation-content">
                            <!-- Benevole --> 
                            <a href="{{ route('admin.benevole.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-users">

                                            </i><br>
                                            Benevoles
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Besoin -->
                            <a href="{{ route('admin.besoin.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-blog">

                                            </i><br>
                                            Besoins
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Donateurs -->
                            <a href="{{ route('admin.donateur.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-support">

                                            </i><br>
                                            Donateurs
                                        </span>
                                    </div>
                                </div>
                            </a>   
                            <!-- Dons -->
                            <a  href="{{ route('admin.don.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-support">

                                            </i><br>
                                            Dons
                                        </span>
                                   </div>
                                </div>
                            </a>   
                        </div>
                    </div> 
                    <!-- Others menu -->
                    <div class="others-menu">
                        <h6>
                            <i class="fa fa-plus"></i> Autres
                        </h6>
                        <div class="others-menu-content">
                            <!-- Blog -->
                            <a  href="{{ route('admin.article.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-blog">

                                            </i><br>
                                            Blog
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <!-- Contact -->
                            <a href="{{ route('admin.contact.index') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-envelope">

                                            </i><br>
                                            Contact
                                        </span>
                                    </div>
                                </div>
                            </a>  
                            <!-- Evenement -->
                            <a href="{{ route('admin.evenement.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-calendar">

                                            </i><br>
                                            Evenements
                                        </span>
                                    </div>
                                </div>
                            </a> 
                            <!-- Offre Emploies --> 
                            <a class="content-item" href="{{ route('admin.offre_emploie.list') }}" title="Cliquer pour acceder au menu">
                                <div class="card">
                                    <div class="card-body">
                                        <span>
                                            <i class="fa fa-tasks">

                                            </i><br>
                                            Offres emploies
                                        </span>
                                    </div>
                                </div>
                            </a> 
                        </div>
                    </div> 
                    
                </div>
                <!-- Fin options-content -->
            </div>
        </div>
    </section>

    <!-- Script externe -->
    <!-- <script src="{{ asset('script/layout/admin.js') }}"> </script> -->
</body>
</html>