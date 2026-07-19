<!DOCTYPE html>
<html lang="en">
<head>

    @php
        $headTitle = '';
        
        // Dashboard 
        if(Route::is('admin.dashboard.*')) {
            $headTitle = 'Dashboard';
        }

        // Parametre
        if(Route::is('admin.identite.*') || Route::is('admin.questionnement.*') || Route::is('admin.payment_setting.*') || Route::is('admin.regulation.*')) {
            $headTitle = 'Parametres';
        }

        // Utilisateurs
        if(Route::is('admin.user.*')) {
            $headTitle = 'Utilisateurs';
        }
        // Access Ressources (privileges)
        if(Route::is('admin.article.*')) {
            $headTitle = 'Blog';
        }
        // Benevoles
        if(Route::is('admin.benevole.*')) {
            $headTitle = 'Benevoles';
        }
        // Besoins
        if(Route::is('admin.besoin.*')) {
            $headTitle = 'Besoins';
        }
        // Contact
        if(Route::is('admin.contact.*')) {
            $headTitle = 'Contact';
        }
        // Donateurs
        if(Route::is('admin.donateur.*')) {
            $headTitle = 'Donateurs';
        }
        // Offres Emploies
        if(Route::is('admin.offre_emploie.*')) {
            $headTitle = 'Offres Emploies';
        }
        // Dons
        if(Route::is('admin.don.*')) {
            $headTitle = 'Dons';
        }
        // Evenements
        if(Route::is('admin.evenement.*')) {
            $headTitle = 'Evenements';
        }
    @endphp
    

    <title>{{ $headTitle }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('style/layouts/admin.css') }}">

    <script src="{{ asset('dependance/jquery/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('dependance/dataTable/dataTables.js') }}"></script>
    <script src="{{ asset('dependance/dataTable/dataTables.bootstrap5.js') }}"></script>

    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dependance/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('dependance/axios/axios.min.js') }}"></script>
    <script src="{{ asset('dependance/sweetalert2/swal.js') }}"></script>

    <!-- Styles dashboard -->
    @include('layouts.template.admin.dashboard.admin.head.styles')

    <!-- Styles user -->
    @include('layouts.template.admin.user.head.styles')

    <!-- Styles access_ressource -->
    @include('layouts.template.admin.access_ressource.head.styles')

    <!-- Styles identite -->
    @include('layouts.template.admin.identite.head.styles')

    <!-- Styles questionnement -->
    @include('layouts.template.admin.questionnement.head.styles')

    <!-- Styles payment_setting -->
    @include('layouts.template.admin.payment_setting.head.styles')

    <!-- Styles contact -->
    @include('layouts.template.admin.contact.head.styles')

    <!-- Styles && scripts pour article (blog) -->
    @include('layouts.template.admin.blog.article.head.styles')  <!-- // Ensemble de script styles destines a partie head -->
    @include('layouts.template.admin.blog.article.head.scripts') <!-- // Ensemble de script scripts destines a partie head -->

    <!-- Styles && scripts pour regulation -->
    @include('layouts.template.admin.regulation.head.styles')  <!-- // Ensemble de script styles destines a partie head -->
    @include('layouts.template.admin.regulation.head.scripts') <!-- // Ensemble de script scripts destines a partie head -->

    <!-- Styles pour benevole -->
    @include('layouts.template.admin.benevole.head.styles')

    <!-- Styles pour besoin -->
    @include('layouts.template.admin.besoin.head.styles')

    <!-- Styles pour donateur -->
    @include('layouts.template.admin.donateur.head.styles')

    <!-- Styles pour don -->
    @include('layouts.template.admin.don.head.styles')

     <!-- Styles pour evenement -->
    @include('layouts.template.admin.evenement.head.styles')

    <!-- Ensemble de Styles && scripts destines offre  -->
    @include('layouts.template.admin.offre_emploie.head.styles') <!-- // Ensemble de script styles destines a partie head -->
    @include('layouts.template.admin.offre_emploie.head.scripts') <!-- // Ensemble de script styles destines a partie head -->

    <!-- Script dashboard -->
    @include('layouts.template.admin.dashboard.admin.head.scripts')

    <!-- Scripts externes (vite) -->
    @vite('resources/js/app.js')

    <style>
        body { padding: 0px; margin: 0px; }
        /* === TON CSS RESTE STRICTEMENT INCHANGÉ === */
    </style>
</head>

<body>

@php
    $user = auth()->user();
@endphp

<div id="navigation">
    <div id="navbar">

        <div id="navbar_logo_collapse_button">
            <div id="navbar_logo">
                <img src="{{ $identite->logo ? Storage::url($identite->logo) : '' }}" style="width: 100%;height: 100%;">
            </div>
            <div id="navbar_text">
                <span>{{ $identite->nom }}</span>
            </div>
            <div id="navbar_collapse">
                <button type="button" class="btn btn-default btn-sm" id="collapse_button">
                    <span class="bi bi-list"></span>
                </button>
            </div>    
        </div> 

        <div id="navbar_social_menu">
            <ul>
                <li><a href="{{ $identite->sociaux?->facebook }}"><i class="bi bi-facebook" style="color: blue;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->twitter }}"><i class="bi bi-twitter" style="color: #00acee;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->google }}"><i class="bi bi-google" style="color: #db4a39;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->instagram }}"><i class="bi bi-instagram" style="color: #C32AA3;"></i></a></li>
            </ul>
        </div> 

        <div id="navbar_user_menu">
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
                                <a href="{{ route('admin.user.my_profil') }}" class="btn btn-default btn-sm" title="Aller sur mon profil">
                                    <i class="bi bi-person-fill-gear" style="opacity: 0.5;"></i> My Profil
                                </a>
                            </div>
                        </li>
                       @endif 
                        <!-- <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="#"><i class="bi bi-lock-fill" style="opacity: 0.5;"></i> Password</a>
                        </li> -->
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <form method="POST" action="{{ route('authentication.logout_handler') }}">
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

    </div>

    <div id="sidebar">
        <div id="sidebar_logo_dismiss">
            <div id="sidebar_logo_title">
                <img src="{{ $identite->logo ? Storage::url($identite->logo) : '' }}">
                <span>
                    <i>{{ $identite->nom }}</i>
                </span>
            </div>
            <div id="sidebar_dismiss">
                <button type="button" class="btn btn-default btn-sm active" id="dismiss_button">
                    <span class="bi bi-x-lg"></span>
                </button>
            </div>
        </div>

        <div id="sidebar_admin">
            <div class="card">
                <div class="card-body">
                    <div id="profil_img">
                        <img src="{{ $admin->photo ? Storage::url($admin->photo) : '' }}" class="rounded-circle">
                    </div>
                    <div id="profil_nom">
                        <span>{{ $admin->nom }}</span>
                    </div>
                </div>
            </div>               
            <div id="profil_qualification">
                <span><i class="bi bi-person-fill-gear"></i> Admin</span>
            </div>
        </div>

        <div id="sidebar_menu">

            @if($user?->hasRole('admin')) 
            <li>
                <a href="{{ route('admin.dashboard.admin') }}" id="dashboard_menu_link" 
                    @if(Route::is('admin.dashboard.admin'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-signal"></i> Dashboard
                </a>
            </li>

            <li class="parameter-menu">
                <a href="#" id="parameter_menu_link"
                    @if(Route::is('admin.identite.*') || Route::is('admin.questionnement.*') || Route::is('admin.paymentSetting.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-cog"></i> Parametres <i class="fa fa-angle-down" style="float: right;"></i>
                </a>
                <ul class="sous-menu" id="parameter_sous_menu">
                    <li>
                        <a href="{{ route('admin.identite.update_page',['id'=>$identite->id]) }}" id="identite_sub_menu_link"
                            @if(Route::is('admin.identite.*'))
                                style="opacity: 0.9;background-color: #f0f8f8; color: cadetblue;"
                            @endif>
                            <i class="fa fa-globe"></i> Identite
                        </a>
                    </li>
                    <li>    
                        <a href="{{ route('admin.questionnement.list') }}" id="questionnement_sub_menu_link"
                            @if(Route::is('admin.questionnement.*'))
                                style="opacity: 0.9;background-color: #f0f8f8; color: cadetblue;"
                            @endif>
                            <i class="fas fa-question-circle"></i> Questionnement
                        </a>
                    </li>
                    <!-- Admin principale -->
                    @if(auth()->id() === 1)
                    <li>   
                        <a href="{{ $paymentSetting ? route('admin.paymentSetting.update_page',['id' => $paymentSetting->id]) : route('admin.paymentSetting.register_page') }}" id="payment_setting_sub_menu_link"
                            @if(Route::is('admin.paymentSetting.*'))
                                style="opacity: 0.9;background-color: #f0f8f8; color: cadetblue;"
                            @endif>
                            <i class="fa fa-credit-card"></i> Payment
                        </a>
                    </li>
                    @endif
                    <!-- Moderation de commentaire -->
                    <li>    
                        <a href="{{ $regulation ? route('admin.regulation.update_page', ['id' => $regulation->id]) : route('admin.regulation.register_page') }}" id="questionnement_sub_menu_link"
                            @if(Route::is('admin.regulation.*'))
                                style="opacity: 0.9;background-color: #f0f8f8; color: cadetblue;"
                            @endif>
                            <i class="fas fa-envelope"></i> Commentaire
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.user.list') }}" id="user_menu_link"
                    @if(Route::is('admin.user.*') || Route::is('admin.access_ressource.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-users"></i> Utilisateurs
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('admin.article.list') }}" id="blog_menu_link"
                    @if(Route::is('admin.article.*') || Route::is('admin.regulation.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-blog"></i> Blog
                </a>
            </li>
            <li>
                <a href="{{ route('admin.benevole.list') }}" id="benevole_menu_link"
                    @if(Route::is('admin.benevole.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fas fa-hands-helping"></i> Benevoles
                </a>
            </li>
            <li>
                <a href="{{ route('admin.besoin.list') }}"
                    @if(Route::is('admin.besoin.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fas fa-clipboard-list"></i> Besoins
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contact.index') }}"
                    @if(Route::is('admin.contact.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-envelope"></i> Contact
                </a>
            </li>

            <li>
                <a href="{{ route('admin.donateur.list') }}" id="donateur_menu_link"
                    @if(Route::is('admin.donateur.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fas fa-hand-holding-heart"></i> Donateurs
                </a>
            </li>

            <li>
                <a href="{{ route('admin.offre_emploie.list') }}"
                    @if(Route::is('admin.offre_emploie.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-tasks"></i> Offres Travails
                </a>
            </li>
            <li>
                <a href="{{ route('admin.don.list') }}"
                    @if(Route::is('admin.don.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fas fa-donate"></i> Dons
                </a>
            </li>
            <li>
                <a href="{{ route('admin.evenement.list') }}"
                    @if(Route::is('admin.evenement.*'))
                       style="background-color: cadetblue; color: white;"
                    @endif>
                    <i class="fa fa-calendar"></i> Evenements
                </a>
            </li>
        </div>
    </div>
</div>

<div id="content_wrapper">
    @yield('content') 
</div>

<!-- Script interne -->
<script type="text/javascript">
    window.user = @json(Auth::user());
    window.STORAGE_PATH_URL = @json(env('STORAGE_PATH_URL'));
    window.currentRouteName = @json(Route::currentRouteName());
    window.paymentSetting = @json($paymentSetting);
</script>

<!-- Script externe -->
<script src="{{ asset('script/layouts/admin.js') }}"></script>

</body>
</html>